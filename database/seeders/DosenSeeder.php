<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Bapak Rizqi',
            'email' => 'Rizqi@telkomuniversity.ac.id',
            'password' => Hash::make('admin'),
            'role' => 'dosen',
        ]);
    }
}
