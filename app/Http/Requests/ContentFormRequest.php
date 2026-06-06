<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContentFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
             'name'=> 'required|string|min:3',
        'email'=> 'required|email',
        'subject'=> 'required',
        'message'=> 'required'
        ];
    }

    public function messages(): array
    {
        return [
         'name.required'=>'Filling in name and surname is mandatory',
        'name.string'=>'The first and last name should consist of characters.',
        'name.min'=>'First and last name must be at least 3 characters long.',
        'email.required'=>'Filling email is mandatory.',
        'email.email'=>'Invalid email addresses.',
        'subject.required'=>'Subject space cannot be null.',
        'message.required'=>'Message space cannot be null',
        ];
    }
}
