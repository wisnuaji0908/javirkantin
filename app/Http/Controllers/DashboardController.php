<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Order;
use App\Models\Pesanan;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->role=='admin'){
        $today=Carbon::today()->toDateString();
        $profile=Profile::where('user_id',session('id'))->first() ?? ['id'=> 0];
        $order= Order::whereDate('created_at', $today)->where('status', 4);

        if(!$order->where('id_profile', $profile['id'])->get()) {
            // dd(1);
            return view('dashboard.index',[
            'order'=> $order,
            'profile'=> Profile::where('id',session('id'))->get(),
            'barang'=> Barang::all(),
        ]);
    }

    // dd($profile['id'], auth()->user()->id_profile);

        return view('dashboard.index',[
            'order'=> $order->where('id_profile', $profile['id'])->get(),
            'profile'=> Profile::where('id',session('id'))->get(),
            'barang'=> Barang::all(),
        ]);
        }else{
            $belomDiambil= Order::where('user_id', session(('id')))->where('status', 3)->get();
            $proses= Order::where('user_id', session(('id')))->where('status', 2)->get();
            $order= Order::where('user_id', session(('id')))->where('status', 1)->get();
            return view('dashboard.index',[
                'order' => $order->count(),
                'belom'=>$belomDiambil->count(),
                'proses'=>$proses->count(),
                'profile'=> Profile::where('id',session('id'))->get(),
            ]);
        }
    }

}
