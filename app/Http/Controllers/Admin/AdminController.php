<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home.index');
    }

    public function profile()
    {
        return view('admin.home.profile');
    }

    public function order()
    {
        $records = Order::Select('users.name as username','users.id as userId',
            'orders.id','orders.status','orders.total','orders.created_at')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('orders.id','DESC')
            ->get();

        return view('admin.orders' , compact('records'));
    }

    public function orderStatusUpdate(Request $request)
    {
        if(isset($request->order_id) && isset($request->order_status)){
            //save order status
            $uptStatus = Order::where('id',$request->order_id)
                ->update(['status' => $request->order_status]);

            if($uptStatus){
                echo "Order " . $request->order_status;
            }
            else{
                echo "error";
            }
        }
    }
}
