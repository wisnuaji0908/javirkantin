<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use App\Models\Profile;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class KatalogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $dataBarang= Barang::all()->pluck('id')->toArray();
        // dd($dataBarang);

        return view("katalog.index",[
            'katalog'=> Profile::all(),
            'barang'=> Barang::all(),
            // 'barang'=> Barang::where('id', session('id'))->get(),
            'order'=> Order::all()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(session('id'));
        try {
            $data= $request->validate([
                'nama_barang'=>'required',
                'harga'=>['required','numeric'],
                'id_profile'=>['required', 'numeric'],
                'notes'=>'nullable'
            ]);
            $data['status']="belum bayar";
            $data['user_id']=session('id');
            $store= Order::create($data);
            if($store) {
                toast('Data berhasil ditambahkan!','success');
                return redirect('/order');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
