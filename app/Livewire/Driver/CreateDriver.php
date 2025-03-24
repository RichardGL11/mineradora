<?php

namespace App\Livewire\Driver;

use App\Actions\Driver\CreateDriverAction;
use App\Models\User;
use App\Rules\ValidCPF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateDriver extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone = '';
    public string $cpf = '';

    protected function rules():array
    {
       return [
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
           'cpf' => ['required', 'numeric', 'string', 'min_digits:11','max_digits:11', 'unique:users,cpf', new ValidCPF()],
           'phone' => ['required', 'string', 'numeric', 'min_digits:11','max_digits:11', 'unique:users,phone'],
           'password' => ['required', 'string', 'confirmed', Password::defaults()],
       ];
    }
    public function register():Redirector
    {
        $this->validate();

         $driver =   CreateDriverAction::execute(
            name: $this->name,
            email: $this->email,
            password: $this->password,
            phone: $this->phone,
            cpf: $this->cpf);

        Auth::login($driver);

        return response()->redirectTo('/dashboard');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.driver.create-driver');
    }
}
