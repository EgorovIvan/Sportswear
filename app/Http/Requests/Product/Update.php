<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:200'],
            'chapter' => ['required', 'string', 'min:2', 'max:4'],
            'type' => ['required', 'string', 'min:2', 'max:50'],
            'code' => ['required', 'string', 'min:5', 'max:5'],
            'price' => ['required', 'string', 'min:1', 'max:12'],
            'color' => ['required', 'string', 'min:2', 'max:7'],
            'size' => ['required', 'string', 'min:2', 'max:3'],
            'description' => ['nullable', 'string', 'min:0', 'max:200'],
            'specifications' => ['required', 'json'],
            'images' => ['required', 'json'],
            'rating' => ['required', 'string', 'min:1', 'max:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => "Необходимо заполнить поле :attribute",
        ];
    }

    public function attributes()
    {
        return  [
            'title' => 'Наименование'
        ];
    }
}
