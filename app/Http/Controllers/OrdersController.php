<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $orders = \App\Http\Resources\Order::collection(Order::orderBy("id",'desc')->paginate(10));
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

        if ($type == "1"){
            //       发送邮件
            $order->sendEmail();
        }

        if ($order){
            return $order;
        }else{
            return [
                'code'=>0
            ];
        }
    }

    public function certificate($id)
    {
        $order = Order::find($id);
        return view("certificate",compact('order'));
    }

}
