<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use App\Models\Pesanan;
use App\Http\Requests\StorePesananRequest;
use App\Http\Requests\UpdatePesananRequest;
use App\Models\Profile;
use Illuminate\Http\Request;


class PesananController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $id= Barang::where('user_id', session(('id')))->pluck('user_id')->first();
    //     $profile= Profile::where('user_id',$id)->pluck('id')->first();
    //     return view('table.checkout.index',[
    //         'profile' => Order::where('id_profile', $profile)->get(),
    //     ]);
    // }

    // ChatGPT
    public function index()
    {
        $id = Barang::where('user_id', session('id'))->pluck('user_id')->first();
        $profile = Profile::where('user_id', $id)->pluck('id')->first();

        // Mendapatkan data order dengan status 'lunas' saja
        $orders = Order::where('id_profile', $profile)
                    ->where('status', 'lunas')
                    ->get();

        return view('transaction.checkout.index', [
            'profile' => $orders
        ]);
    }

    public function store(Request $request)
    {
        $data= $request->validate([
            'nama_barang'=>'required',
            'harga'=>['required','numeric']
        ]);
        $store= Pesanan::create($data);
        if($store) return redirect('/dashboard')->with('success', 'pesanan successfully!');
        return back()->with('error', 'pesanan failed!');
    }

    public function update(UpdatePesananRequest $request, Pesanan $pesanan)
    {
        //
    }

    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
