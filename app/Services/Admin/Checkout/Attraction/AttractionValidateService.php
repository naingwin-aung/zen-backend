<?php

namespace App\Services\Admin\Checkout\Attraction;

use App\Services\Admin\Checkout\ValidationInterface;

class AttractionValidateService implements ValidationInterface
{
    /**
     * Apply the validation rules and custom messages.
     *
     * @param  array<string, string>  $rules
     * @param  array<string, string>  $messages
     */
    public function handle(int|string $key, array &$rules, array &$messages) : void
    {
        $this->rules($key, $rules);
        $this->messages($key, $messages);
    }

    /**
     * Add validation rules for attraction products.
     *
     * @param  array<string, string>  $rules
     */
    private function rules(int|string $key, array &$rules) : void
    {
        $rules["products.$key.product_id"] = 'required|integer';
        $rules["products.$key.package_id"] = 'required|integer';
        $rules["products.$key.date"] = 'required|date|after_or_equal:today';
        $rules["products.$key.quantities"] = 'required|array';
        $rules["products.$key.quantities.*.id"] = 'required|integer';
        $rules["products.$key.quantities.*.quantity"] = 'required|integer|min:1';
    }

    /**
     * Add validation custom messages for attraction products.
     *
     * @param  array<string, string>  $messages
     */
    private function messages(int|string $key, array &$messages) : void
    {
        $messages["products.$key.product_id.required"] = 'Product ID is required.';
        $messages["products.$key.product_id.integer"] = 'Product ID must be an integer.';
        $messages["products.$key.package_id.required"] = 'Package ID is required.';
        $messages["products.$key.package_id.integer"] = 'Package ID must be an integer.';
        $messages["products.$key.date.required"] = 'Please select the date';
        $messages["products.$key.date.date"] = 'Date must be a valid date.';
        $messages["products.$key.date.after_or_equal"] = 'Date must be after or equal to today.';
        $messages["products.$key.quantities.required"] = 'Quantities is required.';
        $messages["products.$key.quantities.array"] = 'Quantities must be an array.';
        $messages["products.$key.quantities.*.id.required"] = 'ID is required.';
        $messages["products.$key.quantities.*.id.integer"] = 'ID must be an integer.';
        $messages["products.$key.quantities.*.quantity.required"] = 'Quantity is required.';
        $messages["products.$key.quantities.*.quantity.integer"] = 'Quantity must be an integer.';
        $messages["products.$key.quantities.*.quantity.min"] = 'Quantity must be at least 1.';
    }
}
