<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->apiURL = 'https://api.packt.com/api/v1/products';
        $this->token = env('API_TOKEN','zYCzX0xRJ2Ew9NcsCpV79vRIcVBodS42IMHOFAQs');
    }
    public function index(Request $request)
    {
        $allParameters = $request->all();
        $page = $allParameters['page'];
        $limit=10;
        
        $api = $this->apiURL.'?token='.$this->token.'&page='.$page.'&limit='.$limit;
        $response = Http::get($api);

        if($response->ok()){
            $products = $response->json()['products'];
            return response()->json(['success'=> 'Product List','data'=>$products]);
        }
    }

    public function getURL(Request $request){
        $allParameters = $request->all();
        $id = $allParameters['id'];

        $api = $this->apiURL.'/'.$id.'/?token='.$this->token;
        $response = Http::get($api);
        dd($response);
    }
}
