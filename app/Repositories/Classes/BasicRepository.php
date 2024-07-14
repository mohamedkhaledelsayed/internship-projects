<?php


namespace App\Repositories\Classes;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

abstract class BasicRepository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * Configure the Model
     *
     * @return string
     */

    abstract public function model();

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Make Model instance
     *
     * @return Model
     * @throws \Exception
     *
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    abstract public function getFieldsRelationShipSearchable();

    abstract public function translationKey();

    /**
     * Display a listing of the resource.
     * column is array with we select it from table
     */

    function all($orsFilters = [], $andsFilters = [], $relations = [], $searchingColumns = null, $withTrashed = false, $orderBy = ['column' => 'id', 'order' => 'desc'], $group = null, $Between = [], $subRelation = [])
    {
        $columns = $searchingColumns ?? $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        $relationsWithColumns = $this->getRelationWithColumns($relations); // this fn takes [ brand => [ id , name ] ] then returns : brand:id,name to use it in with clause
        $translatedAttributes = $this->model->translatedAttributes;
        /** Get the request parameters **/
        $params = request()->all();
        /** Set the current page **/
        $page = $params['page'] ?? 1;

        /** Set the number of items per page **/
        $perPage = $params['per_page'] ?? 10;

        // set passed filters from controller if exist
        if (!$withTrashed)
            $this->model = $this->model->query()->with($relationsWithColumns);
        else
            $this->model = $this->model->query()->onlyTrashed()->with($relationsWithColumns);


        /** Get the count before search **/
        $itemsBeforeSearch = $this->model->count();

        // general search
        if (isset($params['search']['value'])) {

            if (str_starts_with($params['search']['value'], '0'))
                $params['search']['value'] = substr($params['search']['value'], 1);

            /** search in the original table **/
            foreach ($columns as $column)
                array_push($orsFilters, [$column, 'LIKE', "%" . $params['search']['value'] . "%"]);
        }

        // filter search
        if ($itemsBeforeSearch == $this->model->count() && $params) {

            $searchingKeys = collect($params['columns'])->transform(function ($entry) {
                return $entry['search']['value'] != null && $entry['search']['value'] != 'all' ? Arr::only($entry, ['data', 'name', 'search']) : null; // return just columns which have search values
            })->whereNotNull()->values();

            /** if request has filters like status **/
            if ($searchingKeys->count() > 0) {
                /** search in the original table **/
                foreach ($searchingKeys as $column) {
                    if (!($column['name'] == 'created_at' or $column['name'] == 'date'))
                        array_push($andsFilters, [$column['name'], '=', $column['search']['value']]);
                    else {
                        if (!str_contains($column['search']['value'], ' - ')) // if date isn't range ( single date )
                            $this->model->orWhereDate($column['name'], $column['search']['value']);
                        else
                            $this->model->orWhereBetween($column['name'], $this->getDateRangeArray($column['search']['value']));
                    }
                }
            }
        } else {
            return $this->model->get();
        }

        $this->model = $this->model->where(function ($query) use ($orsFilters, $translatedAttributes) {
            foreach ($orsFilters as $filter) $query->orWhere([$filter]);
            if ($translatedAttributes) {
                foreach ($translatedAttributes as $column) {
                    $query->orWhereHas('translations', function ($subquery) use ($column) {
                        $subquery->where($column, 'LIKE', "%" . request()['search']['value'] . "%");
                    });
                }
            }
        });
        if ($andsFilters)
            $this->model->where($andsFilters);
        if ($Between && $Between[1] != null && $Between[2] != null) {

            $this->model->WhereBetween($Between[0], [$Between[1], $Between[2]]);
        } elseif ($Between && $Between[1] != null) {
            $this->model->whereDate($Between[0], '>=', $Between[1]);
        } elseif ($Between && $Between[2] != null) {
            $this->model->whereDate($Between[0], '<=', $Between[2]);
        }

        if ($group) {
            $this->model->groupBy($group);
        }
        if ($subRelation) {
            $this->model->with($group);
        }

        // if (!empty($orderBy)) {
        //     $this->model->orderBy($orderBy['column'], $orderBy['order']);
        // }

        if (!empty($orderBy) && count($orderBy) > 0 && !empty(request()['order'])) {
            $columnName = request()['columns'][(int) request()['order'][0]['column']]['data'];
            if ($columnName) {
                $this->model->orderBy($columnName, $orderBy[0]['dir']);
            }
        }


        $response = [
            "recordsTotal" => $this->model->count(),
            "recordsFiltered" => $this->model->count(),
            'data' => $this->model->skip(($page - 1) * $perPage)->take($perPage)->get()
        ];
        return $response;
    }

    function getRelationWithColumns($relations): array
    {
        $relationsWithColumns = [];
        foreach ($relations as $relation => $columns) {
            array_push($relationsWithColumns, $relation . ":" . implode(",", $columns));
        }
        return $relationsWithColumns;
    }

    function getDateRangeArray($dateRange): array
    {
        $dateRange = explode(' - ', $dateRange);
        return [$dateRange[0] . ' 00:00:00', $dateRange[1] . ' 23:59:59'];
    }

    /**
     * @param          $id
     * @param string[] $column
     * @param array    $withRelations
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $column = ['*'], $withRelations = [])
    {
        $query = $this->model->newQuery();
        if (!empty($withRelations)) {
            $query->with($withRelations);
        }
        return $query->find($id, $column);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->model->create($request);
    }

    /**
     * @param      $request
     * @param null $id
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function save($request, $id = null)
    {
        $data = $this->find($id);
        $data->update($request);
        return $this->find($id);
    }

    /**
     * @param $id
     * @param $key
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function updateValue($id, $key)
    {
        return $this->change($this->find($id), $key);
    }

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $data = $this->find($id, ['*'], [], true);
        return $data ? $data->delete() : false;
    }
}
