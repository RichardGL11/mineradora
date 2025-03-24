<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Product;
use App\Models\User;
use App\Services\Fretes\Facades\MelhorEnvioFacade;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class GenerateFreteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:frete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Collection|Product $products,User $user):Collection
    {
      $addres =  Address::query()->where('user_id', $user->id)->first();
      $http = MelhorEnvioFacade::setProduct($products)
                ->setPostalCodes('09581420', $addres->CEP)
                ->generateFrete();

     return collect($http)->filter(function ($http) {
         return !Arr::has($http, 'error');
     });
    }
}
