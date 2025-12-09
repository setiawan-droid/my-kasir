<?php

namespace App\Services\Payments;

interface PaymentStrategy
{
    public function pay(int $amount): array;
}
