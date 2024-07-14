<?php

namespace App\Repositories\Classes;

use App\Models\Setting;
use Illuminate\Http\Request;


class SettingRepository extends BasicRepository
{
    /**
     * @var array
     */

    protected array $fieldSearchable = [
        'id', 'key', 'value'
    ];

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Setting::class;
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
        return $this->all(orderBy: $request->order, andsFilters: $andsFilters);
    }


    /**
     * @param      $request
     * @param null $id
     */

    public function update($key, $value)
    {

        $setting = $this->model->where('key', $key)->first();
        if ($setting) {

            if ($setting->type == 'image') {
                if (!is_null($setting->value)) {
                    $imageName =  storeImage('Settings', $value);
                    deleteImage('Settings', $setting->value);
                    $setting->value_en = $imageName;
                    $setting->value_ar = $imageName;
                    $setting->save();
                }
            } else {
                $setting->value_en = $value['en'];
                $setting->value_ar = $value['ar'];
                $setting->save();
            }
        }
    }
}
