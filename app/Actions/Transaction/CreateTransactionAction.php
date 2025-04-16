<?php

namespace App\Actions\Transaction;

use App\DataTransferObjects\Transaction\TransactionDTO;
use App\Models\Transaction;

class CreateTransactionAction
{
    public static function execute(TransactionDTO $transactionDTO):void
    {
      Transaction::query()->create([
                'external_id' => $transactionDTO->id,
                'amount'      => $transactionDTO->amount,
                'status'      => $transactionDTO->status,
                'wallet_id'   => $transactionDTO->wallet_id,
      ]);
    }
}
