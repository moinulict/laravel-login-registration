<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {

        if ($this->expectsJson()) {
            $response = new JsonResponse([
                'status' => false,
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);

            throw new HttpResponseException($response);
        }

        parent::failedValidation($validator);
    }
}
