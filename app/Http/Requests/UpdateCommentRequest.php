<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // 認可のロジックに合わせて適切な値を返すように修正してください
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'nullable|image',
            'manufacturer' => 'nullable|string',
            'event' => 'nullable|in:0,1',
            'dominant_hand' => 'nullable|in:0,1',
            'model' => 'nullable|string',
            'available' => 'nullable|in:0,1',
            'sale' => 'nullable|in:0,1',
            'similar_products' => 'nullable|string',
            'store' => 'nullable|string',
            'recommends' => 'nullable|integer|min:1|max:5',
            'free_review' => 'nullable|string',
        ];
    }
}
