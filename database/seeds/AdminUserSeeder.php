<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'lastname' => 'ESIPEC',
            'email' => 'admin@esipec.pe',
            'whatsapp' => '123456789',
            'role' => 'admin',
        ]);
    }
}
