<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use App\Models\Profile;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(auth()->user()->role=="member"){
            $lokasi=$request->get('order');
            if($lokasi){
                // dd($lokasi);
                $data= Profile::where('lokasi', $lokasi)->pluck('user_id')->toArray();
                $w= Barang::whereIn('user_id', $data)->get();
                // dd($w);
                return view('order.index',[
                    'barang' => $w,

                ]);
            }else{
                // abort(404);
                $profiles = Profile::all();
                $barang = Barang::all();
                return view('order.index', [
                    'profiles' => $profiles,
                    'barang' => $barang,
                ]);

            }
        }else{
            return view('order.index', [
                'order' => Order::where('user_id', session('id'))->get(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create',[
            'order'     => Order::where('user_id', session('id'))->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data= $request->validate([
                'nama_barang'=>'required',
                'id_profile'=>['required', 'numeric'],
                'harga'=>['required', 'numeric'],
                'notes'=>'nullable',
                'jumlah' => ['required','numeric'],
            ]);
            $data['harga']=$data['jumlah'] * $data['harga'];
            $data['status']="0";
            $data['user_id']=session('id');
            $store= Order::create($data);
            if($store) {
                toast('Data berhasil ditambahkan!','success');
                return redirect('/dashboard');
            }
            return back()->with('error', 'order failed!');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            $statusCode = 500;

            return response()->json(['error' => $errorMessage], $statusCode);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    try {
        // dd($request->input('delete'));
        if($request->input('delete')){
            $orderIds = $request->input('orders');

        if (!is_array($orderIds) || empty($orderIds)) {
            return back()->with('error', 'No orders selected!');
        }

        $orders = Order::whereIn('id', $orderIds)->where('user_id', auth()->user()->id)->get();

        foreach ($orders as $order) {
            $order->delete();
        }

        toast('Pesanan dibatalkan!', 'success');
        return redirect('/dashboard');
        }
        $orderIds = $request->input('orders');

        if (!is_array($orderIds) || empty($orderIds)) {
            return back()->with('error', 'No orders selected!');
        }

        $orders = Order::whereIn('id', $orderIds)->where('user_id', auth()->user()->id)->get();

        foreach ($orders as $order) {
            $order->status = 1;
            $order->save();
        }

        toast('Pembayaran berhasil diperbarui!', 'success');
        return redirect('/dashboard');
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        $statusCode = 500;
        return response()->json(['error' => $errorMessage], $statusCode);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
