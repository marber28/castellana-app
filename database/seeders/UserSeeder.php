<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new User();
        $status->name = 'admin';
        $status->email = 'admin@gmail.com';
        $status->password = bcrypt('12345678');
        $status->save();
    }
}
