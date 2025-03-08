<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\PaymentGateway\Facades\AbacatePayFacade;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use function Pest\Laravel\json;

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
          $url = $http['data']['url'];
          return redirect((string)$url);
      }

    }
}
