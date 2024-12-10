<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cek_profile= Profile::where('user_id', session('id'))->get()->count();
        // dd($cek_profile);
        return view('table.profile.index',[
            'profile'=> Profile::where('user_id', session('id'))->get(),
            'cek'=>$cek_profile,
            'lokasi'=>["MM", "TP"],
            'label'=>["Makanan", "Minuman", "ATK", "Dan lainnya"],
        ]);
    }

    public function store(Request $request)
    {
        $cek=Profile::count();
        $request['nomor_toko']= $cek + 1;
        $userId= session('id');
        $request['user_id']= $userId;
        // dd($request);
        try {
            $data= $request->validate([
                'nama_toko'=>'required',
                'nomor_toko'=>['required','numeric'],
                'nomor_telp'=>['required','numeric'],
                'user_id'=>['required','numeric'],
                'lokasi'=>['required'],
                'label'=>['nullable'],
                'deskripsi_toko'=>['nullable'],
            ]);
            //buat ambil id  user
            $store= Profile::create($data);
            if($store){
                $set= User::where('id',$store->user_id)->update(['id_profile'=>$store->id]);
                if(!$set){
                    toast('Data gagal ditambahkan!','success');
                    return back();
                }
                toast('Data berhasil ditambahkan!','success');
                return redirect('/table/profile');
            };
            return back()->with('error', 'gagal tambah data profile');
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
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        try {
            $data= $request->validate([
                'nama_toko'=>'required',
                'nomor_telp'=>['required','numeric'],
                'lokasi'=>['required'],
                'label'=>['nullable'],
                'deskripsi_toko'=>['nullable'],
            ]);
            //buat ambil id  user
            $store= $profile->update($data);
            if($store){
                toast('Data berhasil diupdate!','success');
                return redirect('/table/profile');
            };
            return back()->with('error', 'gagal tambah data profile');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            // Anda juga dapat menambahkan kode status tertentu, misalnya:
            $statusCode = 500; // Internal Server Error

            // Kembalikan respon dengan pesan kesalahan
            return response()->json(['error' => $errorMessage], $statusCode);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        $set= User::where('id',$profile->user_id)->update(['id_profile'=>'0']);
        if($set){
            toast('Data berhasil dihapus!','success');
            return back();
        }
    }
}
