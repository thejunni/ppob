<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DigiFlazzService;

class DigiflazzController extends Controller
{
    protected $digiflazz;

    public function __construct(DigiFlazzService $digiflazz)
    {
        $this->digiflazz = $digiflazz;
    }

    public function cekSaldo()
    {
        return response()->json($this->digiflazz->cekSaldo());
    }

    public function priceList()
    {
        return response()->json($this->digiflazz->getPriceList());
    }

    public function beliPulsa(Request $request)
    {
        $request->validate([
            'customer_no' => 'required',
            'buyer_sku_code' => 'required',
            'ref_id' => 'required',
        ]);

        $response = $this->digiflazz->orderPulsa(
            $request->customer_no,
            $request->buyer_sku_code,
            $request->ref_id
        );

        return response()->json($response);
    }
}
