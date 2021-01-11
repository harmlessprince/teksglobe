<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\Gate;
class UpdateRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return auth()->user()->can('update role', $this->route('role'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles,name,'.$this->route('role')->id,
            'permissions' => 'required|array',
            'permissions.*' => 'required|numeric|exists:permissions,id',
        ];
    }
}
