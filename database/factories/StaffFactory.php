<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // nip nama jenis_kelamin tanggal_lahir nomor_telepon alamat 
        $jk = rand(0, 1) ? 'Laki-laki' : 'Perempuan';

        return [
            'nama' => fake()->name(),
            'jenis_kelamin' => $jk,
            'tanggal_lahir' => fake()->date(),
            'nomor_telepon' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'email' => fake()->email(),
            'signed' => 1
        ];
    }
}