<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'tb_staffs';
    protected $guarded = [
        'id'
    ];


    public function user()
    {
        return $this->hasOne(User::class);
    }

    protected $with = ['creator','editor'];

    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
    public function editor()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }
}