<?php

namespace App\Repositories\Classes;

use App\Models\Permission;
use App\Repositories\Interfaces\IMainRepository;

class PermissionRepository extends BasicRepository implements IMainRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Permission::class;
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
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

    public function findBy($request)
    {
        return $this->all();
    }

    /**
     * @param $data
     */
    public function store($data)
    {
        $role = $this->create(['name' => $data['name']]);
        $role->permissions()->attach($data['permissions']);
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
     */
    public function update($request, $id = null)
    {
        $role = $this->save(['name' => $request['name']], $id);
        $role->permissions()->sync($request['permissions']);
    }

    /**
     * @param $id
     * @return bool|mixed|null
     */
    public function destroy($id){
        return $this->delete($id);
    }
}
