<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateFilamentUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filament-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat filament admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nama = $this->ask('Nama');
        $email = $this->ask('Email');
        $nomor_telepon = $this->ask('Nomor Telepon');
        $jenis_kelamin = $this->choice('Jenis Kelamin',['L','P']);
        $password = $this->secret('Password');

        User::create([
            'role' => 'admin',
            'nama' => $nama,
            'email' => $email,
            'nomor_telepon' => $nomor_telepon,
            'jenis_kelamin' => $jenis_kelamin,
            'password' => Hash::make($password)
        ]);

        $this->info('Filament admin user berhasil di registrasi');
    }
}
