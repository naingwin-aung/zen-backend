<?php

namespace App\Http\Requests\Admin\Attraction;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'star_rating' => 'nullable|numeric|min:0|max:5',
            'is_active' => 'nullable|boolean',
            'countries' => 'required|array',
            'countries.*' => 'required|integer',
            'cities' => 'required|array',
            'cities.*' => 'required|integer',
            // a clone reuses the source images, so uploads are only required otherwise
            'clone_from' => 'nullable|integer|exists:products,id',
            'images' => 'required_without:clone_from|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
            'old_images' => 'nullable|array',
            'old_images.*' => 'integer',
            'categories' => 'required|array',
            'categories.*' => 'required|integer|exists:categories,id',
            'what_to_expect' => 'required',
            'good_to_know' => 'nullable',
            'highlights' => 'nullable',
            'search_keywords' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'closing_type' => 'nullable|string|in:closing_days,closing_dates',
            'closing_dates' => 'required_if:closing_type,closing_dates|array',
            'closing_days' => 'required_if:closing_type,closing_days|array',
            'packages' => 'required|array',
            'packages.*.name' => 'required_with:packages',
            'packages.*.description' => 'nullable',
            'packages.*.prices' => 'required_with:packages|array',
            'packages.*.prices.*.age_group_id' => 'required_with:packages.*.prices|integer|exists:age_groups,id',
            'packages.*.prices.*.price' => 'required_with:packages.*.prices|numeric|min:0',
        ];
    }
}
