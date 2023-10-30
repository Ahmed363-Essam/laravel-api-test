<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Helpers\ApiResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            $response = ApiResponse::sendResponse(422, $validator->messages()->all(), 'Validation Errors');
            throw new ValidationException($validator, $response);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'    => 'required|unique:ads',
            'slug'   => 'required',
            'text'   => 'required',
            'phone' => 'required',
            'domain_id' => 'required'
        ];
    }
}
