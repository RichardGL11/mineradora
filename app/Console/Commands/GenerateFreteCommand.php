<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\Fretes\Facades\MelhorEnvioFacade;
use Illuminate\Console\Command;
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
    public function handle(Collection|Product $products)
    {
      $http =   MelhorEnvioFacade::setProduct($products)
                ->setPostalCodes('09270470','09581420')
                ->generateFrete();
        dd($http);
    }
}
