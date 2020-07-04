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

        $validate['user_id'] = auth()->id();

        $res = Order::forceCreate($validate);
        if ($res){
            return view('submit_success');
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
