<?php

namespace App\Services\Payments;

class CashPayment implements PaymentStrategy
{
    public function pay(int $amount): array
    {
        return [
            'method' => 'cash',
            'paid' => $amount,
            'status' => 'success'
        ];
    }
}
