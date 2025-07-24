<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class DigiFlazzService
{
    protected $username;
    protected $apiKey;

    public function __construct()
    {
        $this->username = config('services.digiflazz.username');
        $this->apiKey = config('services.digiflazz.api_key');
    }

    protected function generateSignature($ref_id = '')
    {
        return md5($this->username . $this->apiKey . $ref_id);
    }

    public function cekSaldo()
    {
        $signature = $this->generateSignature();

        $response = Http::post('https://api.digiflazz.com/v1/cek-saldo', [
            'cmd' => 'deposit',
            'username' => $this->username,
            'sign' => $signature,
        ]);

        return $response->json();
    }

    public function getPriceList()
    {
        $signature = $this->generateSignature();

        $response = Http::post('https://api.digiflazz.com/v1/price-list', [
            'cmd' => 'prepaid',
            'username' => $this->username,
            'sign' => $signature,
        ]);

        return $response->json();
    }

    public function orderPulsa($customer_number, $buyer_sku_code, $ref_id)
    {
        $signature = $this->generateSignature($ref_id);

        $response = Http::post('https://api.digiflazz.com/v1/transaction', [
            'username' => $this->username,
            'buyer_sku_code' => $buyer_sku_code,
            'customer_no' => $customer_number,
            'ref_id' => $ref_id,
            'sign' => $signature,
        ]);

        return $response->json();
    }
}
