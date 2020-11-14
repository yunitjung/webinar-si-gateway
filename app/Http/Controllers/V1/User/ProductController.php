<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Http;


class ProductController extends Controller
{
    use JsonResponse;

    public function __construct()
    {
        $this->url = env('SI_API');
    }

    public function list(){
        try {
            $data = json_decode(Http::get($this->url.'api/v1/product/list')->body());
        } catch (\Throwable $th) {
            throw $th;
        }
        return $this->responseWithCondition($data->data, 'Successfully retrieve product list', $data->message);
    }

    public function find(Request $request){
        try {
            $data = json_decode(Http::post($this->url.'api/v1/product/find', $request->all())->body());
        } catch (\Throwable $th) {
            throw $th;
        }
        return $this->responseWithCondition($data->data, 'Successfully retrieve product', $data->message);
    }
}
