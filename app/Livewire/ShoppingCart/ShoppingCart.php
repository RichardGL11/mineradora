<?php

namespace App\Livewire\ShoppingCart;

use App\Console\Commands\GeneratePaymentCommand;
use App\Models\Order;
use App\Models\Product;
use App\Services\PaymentGateway\Facades\AbacatePayFacade;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ShoppingCart extends Component
{
    public bool $show = false;
    public array $shoppingCart = [];
    public ?string $message = null;

    public function mount():void
    {

       if(request()->getRequestUri() == '/shopping-cart'){
            $this->show = true;
       }
        $this->shoppingCart = Session::get('shoppingCart_'. Auth::id(),[]);
    }
    #[On('addToCart')]
    public function addToCart(Product $product)
    {
       if(Arr::has($this->shoppingCart,$product->id)){
           $this->shoppingCart[$product->id]['quantity']+= 1;
       } else{
           $this->shoppingCart[$product->id] = [
               'id' => $product->id,
               'name' => $product->name,
               'price' => $product->price,
               'photo' => $product->image,
               'description' => $product->description,
               'quantity' => 1
           ];
       }

        session()->put('shoppingCart_' . Auth::id(), $this->shoppingCart);

        session()->save();
    }
    public function removeFromCart(int|Product $product):void
    {
        if(Arr::has($this->shoppingCart, $product)){
            Arr::forget($this->shoppingCart, $product);
            session()->put('shoppingCart_'. Auth::id(), $this->shoppingCart);
        }
        $this->render();
    }
    public function calculateTotal(): mixed
    {
        if(!empty($this->shoppingCart)){
            return collect($this->shoppingCart)->sum(function ($item){
                return (float)$item['price'] * (int)$item['quantity'];
            });
        }
        return 0;
    }

    public function createOrder()
    {
        $response = Gate::inspect('create',Order::class);
        if ($response->allowed()) {
            $products =  collect($this->shoppingCart)->map(function ($item){
                return new Product([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'photo' => $item['photo'],
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                ]);
            });

            app(GeneratePaymentCommand::class)->handle($products);
        } else {
            $this->message = $response->message();
            return $response->message();
        }

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.shopping-cart.shopping-cart',[
            'shoppingCart' => $this->shoppingCart,
            'total' => $this->calculateTotal()
        ]);
    }
}
