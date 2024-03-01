<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_id' => ['nullable', Rule::exists('types', 'id')],
            'title' => ['required', 'string', 'min:3', 'max:80', Rule::unique('projects')],
            'description' => ['nullable', 'string', 'max:300'],
            'cover_image' =>  ['nullable', 'image', 'max:1024'],
            'github_link' => ['nullable', 'string', 'max:255', Rule::unique('projects')],
            'website_link' => ['nullable', 'string', 'max:255', Rule::unique('projects')]
        ];
    }
}
