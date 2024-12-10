<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function toko(){
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
