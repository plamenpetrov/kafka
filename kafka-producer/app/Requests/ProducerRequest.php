<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProducerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required required.',
            'email.email' => 'Invalid email.',
            'name.required' => 'Name is required.'
        ];
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

    public function getName(): string
    {
        return $this->get('name');
    }
}