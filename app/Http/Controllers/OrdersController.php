<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
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
    public function index(Request $request)
    {
        $orders = \App\Http\Resources\Order::collection(Order::orderBy("id",'desc')->paginate(2));
        return $orders;
    }

    public function show()
    {
        return view('admin');
    }

    public function checkIt($id, Request $request)
    {
        $type = $request->post('type','0');
        $order = Order::find($id)?:null;
        $order->status = $type;
        $order->save();

//        TODO: 发送邮件

        if ($order){
            return $order;
        }else{
            return [
                'code'=>0
            ];
        }
    }
}
