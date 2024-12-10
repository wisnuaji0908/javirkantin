<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Staff;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Budi', 'Ani', 'Siti', 'Agus', 'Rahmat', 'Sri', 'Dewi', 'Hendra', 'Rina', 'Eko',
            'Yanto', 'Wati', 'Joko', 'Sari', 'Ahmad', 'Rudi', 'Indra', 'Fitri', 'Usman', 'Lina'
        ];

        foreach ($names as $name) {
            DB::table('users')->insert([
                'name' => $name,
                'password' => bcrypt('12345'),
                'role' => 'admin'
            ]);
        }
        
    }
}
