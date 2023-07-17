<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        if (request()->input('password')) {
            $rules['password'] = ['required', 'min:6'];
        }
        $rules =  [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'required',
                'unique:users,phone,' . request()->route('user')->id,
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];

        return $rules;
    }
}
