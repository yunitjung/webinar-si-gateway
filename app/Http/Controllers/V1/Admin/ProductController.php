<?php

namespace App\Http\Controllers\V1\Admin;

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

    public function store(Request $request){
        try {
            $store = json_decode(Http::post($this->url.'api/v1/product/store', $request->all())->body());
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->responseWithCondition($store->data, 'Successfully storing product', $store->message);
    }

    public function update(Request $request){
        try {
            $store = json_decode(Http::put($this->url.'api/v1/product/update', $request->all())->body());
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->responseWithCondition($store->data, 'Successfully updating product', $store->message);
    }

    public function delete(Request $request){
        try {
            $status = json_decode(Http::delete($this->url.'api/v1/product/remove', $request->all())->body());
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->responseWithCondition($status->data, 'Successfully removing product', $status->message);
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
