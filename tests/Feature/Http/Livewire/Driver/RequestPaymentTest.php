<?php

use App\Livewire\Driver\RequestPayment;
use App\Models\Wallet;
use App\Services\PaymentGateway\Asaas\Enums\PixKeyTypeEnum;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use function Pest\Laravel\postJson;

beforeEach(function (){
    $this->payload = [
        "id" => "evt_e633de3138cfbe837b624a32f8b242a7&8974992",
        "event" => "TRANSFER_CREATED",
        "dateCreated" => "2025-04-14 14:25:04",
        "transfer" => [
            "object" => "transfer",
            "id" => "80ccb02f-0e29-4ab0-821f-ecac9f1c5c13",
            "value" => 10,
            "netValue" => 10,
            "transferFee" => 0,
            "dateCreated" => "2025-04-14",
            "status" => "PENDING",
            "effectiveDate" => null,
            "confirmedDate" => null,
            "endToEndIdentifier" => null,
            "transactionReceiptUrl" => null,
            "operationType" => "PIX",
            "failReason" => null,
            "walletId" => null,
            "description" => null,
            "canBeCancelled" => true,
            "externalReference" => "Wallet_id: 01963f93-63b4-7269-8ccb-f838ebde71fe",
            "authorized" => true,
            "scheduleDate" => "2025-04-14",
            "type" => "BANK_ACCOUNT",
            "bankAccount" => [
                "bank" => [
                    "code" => "208",
                    "name" => "BANCO BTG PACTUAL S.A.",
                    "ispb" => "30306294"
                ],
                "accountName" => null,
                "ownerName" => "Joe Doe",
                "cpfCnpj" => "***.556.540-**",
                "type" => "CHECKING_ACCOUNT",
                "agency" => "00",
                "agencyDigit" => null,
                "account" => "000000",
                "accountDigit" => "0",
                "pixAddressKey" => "joe@doe.com"
            ],
            "recurring" => null
        ]
    ];
});

it('should be able to request a Payment',function (){
    Http::fake([
       'https://api-sandbox.asaas.com/v3/transfers' => Http::response($this->payload)
   ]);

    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    Wallet::factory()->create([
        'amount' => 1000,
        'driver_id' => $driver->id
    ]);
    $livewire = Livewire::actingAs($driver)
        ->test(RequestPayment::class)
        ->set('key', 'joe@doe.com')
        ->assertSet('key', 'joe@doe.com')
        ->set('amount', 10)
        ->assertSet('amount', 10)
        ->set('type', PixKeyTypeEnum::EMAIl)
        ->call('requestPayment')
        ->assertHasNoErrors();

    $livewire->assertRedirect('/dashboard');
});
test('after a payment was requested the webhook should send the information, and then create a transaction', function () {
    $driver = \App\Models\User::factory()->create(['user_type' => \App\Enums\UserType::DRIVER]);
    $wallet = Wallet::factory()->create([
        'id' => "01963f93-63b4-7269-8ccb-f838ebde71fe",
        'amount' => 1000,
        'driver_id' => $driver->id
    ]);

    $response = postJson(route('webhook.asaas'),$this->payload);
    $response->assertOk();

    \Pest\Laravel\assertDatabaseHas(\App\Models\Transaction::class, [
        'amount' => 10.00,
        'wallet_id' => $driver->wallet->id,
        'external_id' => "80ccb02f-0e29-4ab0-821f-ecac9f1c5c13",
        'status' => "PENDING"
    ]);
});

