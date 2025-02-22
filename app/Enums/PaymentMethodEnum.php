<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case QRIS = 'qris';
    case BANK_TRANSFER = 'bank_transfer';
    case EMONEY = 'e_money';

    public function label(): string
    {
        return match ($this) {
            self::QRIS => 'Qris',
            self::BANK_TRANSFER => 'Bank Transfer',
            self::EMONEY => 'E-Money',
        };
    }
}