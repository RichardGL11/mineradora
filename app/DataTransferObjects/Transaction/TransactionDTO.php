<?php

namespace App\DataTransferObjects\Transaction;

final readonly class TransactionDTO
{
     public function __construct(public string $id,public float $amount, public  string $status, public string $wallet_id)
     {}
    public static function fromArray(string $id,float $amount, string $status, string $wallet_id): TransactionDTO
    {
       return new self(
           id:  $id,
           amount:$amount,
           status:$status,
           wallet_id: $wallet_id
       );
    }
}
