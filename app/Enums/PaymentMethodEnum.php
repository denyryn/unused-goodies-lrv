<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case QRIS = 'qris';
    case BANK_TRANSFER = 'bank_transfer';
    case EMONEY = 'e_money';
    /* to be added */
}