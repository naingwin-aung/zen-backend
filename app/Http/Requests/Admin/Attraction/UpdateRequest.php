<?php

namespace App\Http\Requests\Admin\Attraction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'name' => 'required|string|max:255',
            'star_rating' => 'nullable|numeric|min:0|max:5',
            'is_active' => 'nullable|boolean',
            'countries' => 'required|array',
            'countries.*' => 'required|integer',
            'cities' => 'required|array',
            'cities.*' => 'required|integer',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:2048',
            'old_images' => 'nullable|array',
            'old_images.*' => 'nullable|integer',
            'categories' => 'required|array',
            'categories.*' => 'required|integer|exists:categories,id',
            'search_keywords' => 'nullable|string',
            'what_to_expect' => 'required|string',
            'good_to_know' => 'nullable|string',
            'highlights' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'closing_type' => 'nullable|string|in:closing_days,closing_dates',
            'closing_dates' => 'required_if:closing_type,closing_dates|array',
            'closing_days' => 'required_if:closing_type,closing_days|array',
            'packages' => 'required|array',
            'packages.*.id' => 'nullable|integer',
            'packages.*.name' => 'required_with:packages|string|max:255',
            'packages.*.description' => 'nullable|string',
            'packages.*.prices' => 'required_with:packages|array',
            'packages.*.prices.*.id' => 'nullable|integer',
            'packages.*.prices.*.age_group_id' => 'required_with:packages.*.prices|integer|exists:age_groups,id',
            'packages.*.prices.*.price' => 'required_with:packages.*.prices|numeric|min:0',
        ];
    }
}
