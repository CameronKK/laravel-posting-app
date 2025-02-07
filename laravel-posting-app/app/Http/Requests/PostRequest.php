<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|max:40',
            'content' => 'required|string|max:200'
        ];
    }

    /*バリデーション*/
    public function messages(): array
    {
        return[
            'title.required' => 'タイトルは必須です。',
            'title.max' => 'タイトルは最大40字までです。',
            'content.required' => '本文は必須です。',
            'content.max' => '本文は最大200字までです。'
        ];
    }
}
