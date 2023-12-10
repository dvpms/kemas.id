<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{
    public function getProvinsi()
    {
        $response = Http::withOptions(['verify' => false])->get('https://api.binderbyte.com/wilayah/provinsi', [
            'api_key' => '7f48ea088bdff205419549c88f93d211651e74f643a77fff2d9f56f33d5b2909'
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Tidak dapat mengambil data dari API'], 500);
        }
    }
}
