<?php

namespace App\Services\Admin\Checkout;

interface ValidationInterface
{
    /**
     * Apply the validation rules and custom messages.
     *
     * @param  array<string, string>  $rules
     * @param  array<string, string>  $messages
     */
    public function handle(int|string $key, array &$rules, array &$messages): void;
}
