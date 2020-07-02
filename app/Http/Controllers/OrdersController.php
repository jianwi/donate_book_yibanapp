<?php

namespace App\Http\Controllers;

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
    }
    public function index()
    {

    }
    public function check()
    {

    }
}
