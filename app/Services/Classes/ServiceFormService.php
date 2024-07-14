<?php

namespace App\Services\Classes\Tenant;

use App\Repositories\Classes\ServiceFormRepository;
use Illuminate\Support\Str;

class ServiceFormService
{
    public $serviceFormRepository;
    public function __construct(ServiceFormRepository $serviceFormRepository)
    {
        $this->serviceFormRepository = $serviceFormRepository;
    }
    public function store($inputs, $serviceId)
    {
        $data = [];
        foreach ($inputs as $index => $input) {
            $data[$index]['name'] = $input['name'];
            $data[$index]['slug'] = Str::slug($input['name'], '_');
            $data[$index]['type'] = $input['type'];
            $data[$index]['required'] = (isset($input['required']) && $input['required'][0] == "On") ?  true : false;
            $data[$index]['price'] = $input['price'];
            $data[$index]['service_id'] = $serviceId;
        }
        $this->serviceFormRepository->store($data);
    }

    public function update($inputs, $service)
    {
        $oldInputs = $service->serviceForms()->pluck('id')->toArray();
        $newInputIds = collect($inputs)->pluck('id')->toArray();
        $deletedInputs = array_diff($oldInputs, $newInputIds);
        foreach ($inputs as $input) {
            // Store new inpusts 
            if ($input['id'] == null) {
                $this->store([$input], $service->id);
            }
            // Update exists inputs
            if (in_array($input['id'], $oldInputs)) {
                $this->serviceFormRepository->update($input, $input['id']);
            }
            // Delete dosnt exists inputs
            if(count($deletedInputs) > 0){
                foreach($deletedInputs as $deletedInput){
                    $this->serviceFormRepository->delete($deletedInput);
                }
            }
        }
    }
}
