<?php

namespace App\Console\Commands;

use App\Jobs\CreateOrderJob;
use App\Models\Product;
use App\Services\PaymentGateway\Facades\AbacatePayFacade;
use Illuminate\Console\Command;

class GeneratePaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-payment-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(\Illuminate\Support\Collection|Product $products)
    {
      $http = AbacatePayFacade::setProduct($products)
            ->generatePix();

      if($http->json('error') === null){
          CreateOrderJob::dispatch($products, $http['data']['amount'], $http['data']['id']);
          $url = $http['data']['url'];
          return redirect((string)$url);
      }

    }
}
