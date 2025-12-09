<?php

namespace App\Services\Payments;

class QrisPayment implements PaymentStrategy
{
    public function pay(int $amount): array
    {
        return [
            'method' => 'qris',
            'paid' => $amount,
            'qr_code_url' => 'https://example.com/qrcode/' . uniqid(),
            'status' => 'success'
        ];
    }
}
