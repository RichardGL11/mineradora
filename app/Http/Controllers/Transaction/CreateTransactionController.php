<?php

namespace App\Http\Controllers\Transaction;

use App\Actions\Transaction\CreateTransactionAction;
use App\DataTransferObjects\Transaction\TransactionDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request):void
    {
        $array = json_decode($request->getContent(),true);
        $transactionDTO = TransactionDTO::fromArray(id:$array['transfer']['id'],amount:$array['transfer']['value'],status: $array['transfer']['status'],wallet_id: Str::after($array['transfer']['externalReference'],"Wallet_id: ") );
        CreateTransactionAction::execute($transactionDTO);
    }
}
