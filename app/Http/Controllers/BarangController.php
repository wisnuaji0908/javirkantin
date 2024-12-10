<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Barang $barang)
    {
        // $this->authorize('update', $barang);
        return view('table.barang.index',[
            'barang'=>Barang::where('user_id', session('id'))->get()
        ]);
    }

    public function store(Request $request)
    {
        $id_user= session('id');
        $id_profile= User::where('id',$id_user)->pluck('id_profile')->first();
        $request['user_id'] = $id_user;
        $request['profile_id'] = $id_profile;
        // dd($id_profile);
        try {
            $data = $request->validate([
                'barang' => 'required',
                'harga' => ['required', 'numeric'],
                'stok' => ['required', 'numeric'],
                'desc_barang' => 'nullable',
                'user_id' => ['required', 'numeric'],
                'profile_id' => ['required', 'numeric'],
                'photo' => ['nullable', 'image', 'max:2048'] // Validasi untuk foto (opsional, bisa dihapus jika tidak diperlukan)
            ]);

            // Menyimpan foto (jika ada)
            if ($request->hasFile('photo')) {
                // Menyimpan foto ke direktori yang diinginkan
                $foto = $request->file('photo');
                $namaFoto = time() . '_' . $foto->getClientOriginalName();
                $lokasiSimpan = public_path('photos'); // Ganti dengan lokasi direktori penyimpanan foto yang diinginkan
                $foto->move($lokasiSimpan, $namaFoto);

                // Menyimpan nama file foto ke dalam data yang akan disimpan ke database
                $data['photo'] = $namaFoto;
            }

            // Membuat record barang baru
            $store = Barang::create($data);


            if($store){
                toast('Data berhasil ditambahkan!','success');
                return redirect('/table/barang');
            } else {
                // Jika gagal menyimpan barang, hapus foto yang telah diunggah (jika ada)
                if ($request->hasFile('photo')) {
                    unlink($lokasiSimpan . '/' . $namaFoto);
                }
                return back()->with('error', 'added barang failed!');
            }

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            // Anda juga dapat menambahkan kode status tertentu, misalnya:
            $statusCode = 500; // Internal Server Error

            // Kembalikan respon dengan pesan kesalahan
            return response()->json(['error' => $errorMessage], $statusCode);
        }
    }

    public function update(Request $request, Barang $barang)
{
    try {
        $data = $request->validate([
            'barang' => 'required',
            'harga' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'desc_barang' => 'nullable',
            'user_id' => ['nullable', 'numeric'],
            'photo' => ['nullable', 'image', 'max:2048']
        ]);

        // Ambil data barang yang akan diupdate
        $barang = Barang::findOrFail($barang->id);

        // Cek apakah ada foto yang diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($barang->photo) {
                $oldPhotoPath = public_path('photos/' . $barang->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                } else {
                    // Log the error or handle the case where the file does not exist
                    // For example:
                    \Log::error("File does not exist: $oldPhotoPath");
                }
            }

            // Simpan foto baru
            $foto = $request->file('photo');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('photos'), $namaFoto);

            // Ubah nama file foto dalam data
            $data['photo'] = $namaFoto;
        }

        // Update data barang
        $barang->update($data);

        // Redirect kembali dengan pesan sukses
        toast('Data berhasil diupdate!', 'success');
        return redirect('/table/barang');

    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        $statusCode = 500; // Internal Server Error
        return response()->json(['error' => $errorMessage], $statusCode);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        toast('Data berhasil diupdate!','success');
        return back();
    }
}
