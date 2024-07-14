<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return \string[][]
     * Set rules validation on creating
     */
    protected function store(): array
    {
        return [
            'name'     => ['required', 'string', 'max:50', 'min:5'],
            'email'    => ['required', 'string', 'max:125', 'min:9', "email:rfc,dns", 'unique:admins'],
            'phone'    => ['required','digits_between:9,11', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'status'   => ['nullable', 'in:active,pending'],
            'roles'    => ['required', 'array', 'min:1'],
        ];
    }

    /**
     * @return \string[][]
     * Set rules validation on updating
     */
    protected function update(): array
    {

        return [
            'name'     => ['required', 'string', 'max:50', 'min:5'],
            'email'    => ['required', 'string', 'max:125', 'min:9', "email:rfc,dns", 'unique:admins,email,' . $this->id],
            'phone'    => ['required', 'digits_between:9,11','unique:admins,phone,' . $this->id],
            'password' => ['nullable', 'string', 'min:8', 'max:255', 'confirmed'],
            'status'   => ['nullable', 'in:active,pending'],
            'roles'    => ['nullable', 'array', 'min:1'],
        ];
    }

    /**
     * @return \string[][]
     */
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->update() : $this->store();
    }
}
