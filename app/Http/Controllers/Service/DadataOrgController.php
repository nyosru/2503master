<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DadataOrgController extends Controller
{
    public function findByInn(Request $request)
    {
        $request->validate([
            'inn' => 'required|string',
        ]);

        $token = env('DADATA_KEY');
        $secret = env('DADATA_SECRET_KEY');
        $dadata = new \Dadata\DadataClient($token, $secret);
//        dd($dadata);
//        $response = $dadata->findById("party", "7707083893");
        $response = $dadata->findById("party", $request->input('inn'), 5);
        dd($response);
//        $response = DaData2::findParty($request->input('inn'));

        if (empty($response['suggestions'])) {
            return response()->json(['error' => 'Организация не найдена'], 404);
        }

        return response()->json($response['suggestions'][0]['data']);
    }
}
