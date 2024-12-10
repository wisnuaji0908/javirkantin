<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function profile(){
        return $this->belongsTo(Profile::class, 'id_profile', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStatusLabel()
    {
        $statusLabels = [
            '0' => 'Keranjang',
            '1' => 'Pesan',
            '2' => 'Pesanan Diterima',
            '3' => 'Pesanan Sudah Jadi',
            '4' => 'Pesanan Sudah Selesai',
            '5' => 'Pesanan Ditolak',
        ];

        return $statusLabels[$this->status] ?? 'Unknown';
    }

    public function getStatusBadgeClass()
    {
        $statusClasses = [
            '0' => 'bg-secondary',
            '1' => 'bg-info',
            '2' => 'bg-primary',
            '3' => 'bg-warning',
            '4' => 'bg-success',
            '5' => 'bg-danger',
        ];

        return $statusClasses[$this->status] ?? 'bg-secondary';
    }
}
