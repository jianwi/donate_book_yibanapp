<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function store(Request $request)
    {
        $validate = $this->validate($request,[
            "email" => 'required|email',
            "name" => 'required',
            "count" => 'required|numeric'
        ]);
        $validate['user_id'] = 1;

        $res = Order::forceCreate($validate);
        if ($res){
            return [
                'code'=>200
            ];
        }
    }
    public function index()
    {
        $uid = auth()->id();
        dd($uid);
    }
    public function check()
    {

    }
}
