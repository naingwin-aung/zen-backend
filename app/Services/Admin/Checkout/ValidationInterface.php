<?php
namespace App\Services\Admin\Checkout;

interface ValidationInterface
{
    public function rules(int|string $key, array &$rules);

    public function messages(int|string $key, array &$messages);
}