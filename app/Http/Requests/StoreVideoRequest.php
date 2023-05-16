<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'videos.*.title' => ['max:80', 'required'],
            'videos.*.description' => ['max:255'],
            'videos.*.made_for' => ['max:255', 'required'],
            'videos.*.project_number' => ['max:255', 'required'],
            'videos.*.key_words' => ['max:255', 'required'],
        ];
    }
}
