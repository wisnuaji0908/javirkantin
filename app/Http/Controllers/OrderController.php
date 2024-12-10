<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use App\Models\Profile;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function apiBarang($id){
        $barang = Barang::where('user_id',$id)->get();
        // dd($barang);
        return response()->json($barang);
    }
    public function apiDetailBarang($id, $barang){
        $barang = Barang::where('user_id',$id)->where('barang',$barang)->get();
        // dd($barang);
        return response()->json($barang);
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $id = Barang::where('user_id', session('id'))->pluck('user_id')->first();
        $profile = Profile::where('user_id', $id)->pluck('id')->first();

        $orders = Order::where('id_profile', $profile)
                        ->get();

        // Cek apakah ada pesanan
        if ($orders->isEmpty()) {
            $status = null;
        } else {
            $status = $orders[0]['status'];
        }

        // $status=$orders[0]['status'];
        return view('transaction.order.index',   [
            'profile' => $orders,
            'status' => $status
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data= $request->validate([
                'nama_barang'=>'required',
                'harga'=>['required','numeric'],
                'id_profile'=>['required', 'numeric'],
                'notes'=>'nullable'
            ]);
            $store= Order::create($data);
            if($store) {
                toast('Data berhasil ditambahkan!','success');
                return redirect('/transaction/order');
            }
            return back()->with('error', 'order failed!');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            // Anda juga dapat menambahkan kode status tertentu, misalnya:
            $statusCode = 500; // Internal Server Error

            // Kembalikan respon dengan pesan kesalahan
            return response()->json(['error' => $errorMessage], $statusCode);
        }


    }


    public function update(Request $request, Order $order)
    {
        if($request->status=="2"){
            $request['status']= 2;
        }else if($request->status=="3"){
            $request['status']= 3;
        }else if($request->status=="4"){
            $request['status']= 4;
        }else if($request->status=="5"){
            $request['status']= 5;
        }else{
            $request['status']= "unknown";
        }
        $update= $order->update(["status"=>$request->status]);
        $barang=Barang::where('user_id', session('id'))->pluck('stok')->first();
        // dd($barang-1);

        if($update) {
            toast('Data berhasil diupdate!','success');
            Barang::where('user_id', session('id'))->update(['stok'=>$barang-1]);

            return redirect('/transaction/order');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $orderIds = $request->input('orders');
        // dd($request);

        if (!is_array($orderIds) || empty($orderIds)) {
            return back()->with('error', 'No orders selected!');
        }

        $orders = Order::whereIn('id', $orderIds)->where('user_id', auth()->user()->id)->get();

        foreach ($orders as $order) {
            $order->delete();
        }
        toast('Data berhasil dihapus!','success');
        return back();
    }

}
