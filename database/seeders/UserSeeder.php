<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => 'customer',
            'nama' => 'Elvis Presley',
            'email' => 'elvis.presley@gmail.com',
            'nomor_telepon' => '08912312234',
            'jenis_kelamin' => 'L',
            'password' => Hash::make('ElvisP567'),
        ]);

        User::create([
            'role' => 'admin',
            'nama' => 'JohnDoe@Admin',
            'email' => 'john.doe@admin.email.com',
            'nomor_telepon' => '08977730748',
            'jenis_kelamin' => 'L',
            'password' => Hash::make('JohnDoe@Admin'),
        ]);
    }
}
