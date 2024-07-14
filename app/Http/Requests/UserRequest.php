<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:50', 'min:2'],
            'last_name' => ['required', 'string', 'max:50', 'min:2'],
            'email' => ['required', 'string', 'max:125', 'min:9', "email:rfc,dns", Rule::unique('users')->ignore($this->id)],
            'phone' => ['required','digits_between:9,11',  Rule::unique('users')->ignore($this->id)],
            'image' => ['nullable', 'mimes:jpeg,png,jpg,gif' . 'svg|max:4096'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'active'   => ['nullable', 'in:active,pending'],
            'categories'    => ['nullable', 'array', 'min:1'],

        ];
    }

    /**
     * @return \string[][]
     * Set rules validation on updating
     */
    protected function update(): array
    {

        return [
            'first_name' => ['required', 'string', 'max:50', 'min:2'],
            'last_name' => ['required', 'string', 'max:50', 'min:2'],
            'email' => ['required', 'string', 'max:125', 'min:9', "email:rfc,dns", Rule::unique('users')->ignore($this->id)],
            'phone' => ['required','digits_between:9,11',  Rule::unique('users')->ignore($this->id)],
            'image' => ['nullable', 'mimes:jpeg,png,jpg,gif' . 'svg|max:4096'],
            'password' => ['nullable', 'string', 'min:8', 'max:255', 'confirmed'],
            'active'   => ['nullable', 'in:active,pending'],
            'categories'    => ['nullable', 'array', 'min:1'],



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
