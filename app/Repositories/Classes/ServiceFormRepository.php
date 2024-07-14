<?php

namespace App\Repositories\Classes;

use App\Models\ServiceForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ServiceFormRepository extends BasicRepository
{
    /**
     * @var array
     */

    protected array $fieldSearchable = [
        'id', 'name', 'type'
    ];

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return ServiceForm::class;
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
    }

    public function translationKey()
    {
        return $this->model->translationKey();
    }

    public function findBy(Request $request, $andsFilters = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->all(orderBy:$request->order, andsFilters: $andsFilters);
    }

    /**
     * @param $data
     */
    public function store($inputs)
    {
        foreach($inputs as $input){
            $this->create($input);
        }
    }


    public function list()
    {
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function show($id)
    {
        return $this->find($id);
    }

    /**
     * @param      $request
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($request, $id = null)
    {
        return $this->save($request, $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id): mixed
    {
        return $this->delete($id);
    }
}
