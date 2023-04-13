<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::latest()->where('user_id', auth()->user()->id)->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ad = Ad::find($id);
        return view('orders.create', compact('ad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = request()->validate([
            'address' => ['required', 'max:255'],
            'urlmap' => ['required', 'url'],
            'date' => ['required', 'date', 'after_or_equal:today'],
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['ad_user_id'] = Ad::find($id)->user_id;
        $data['ad_id'] = $id;
        // return $id;
        Order::create($data);
        return redirect('/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    // public function show(Order $order)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    // public function edit(Order $order)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, $id)
    {
        $order = Order::find($id);
        $data = request()->validate([
            'status' => 'required'
        ]);
        // if ($data['status'] !== 3) return back();
        if ($data['status'] == 3 && auth()->user()->id == $order->user_id)
        {
            $order->update($data);
            return back();
        }else {
            return back();
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function requests(){


        $orders = auth()->user()->requests()->latest()->get();
        return view('dashboard.requests', compact('orders'));
    }
    public function status(Request $request, Order $order, $id){
        $order = Order::find($id);
        $data = request()->validate([
            'status' => 'required'
        ]);
        if ($data['status'] != 3 && auth()->user()->id == $order->ad_user_id) {
            $order->update($data);
            return back();
        } else {
            return back();
        }

    }
}
