<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::create([
            'name'=>'Superadmin_1',
            'email'=>'superadmin@gmail.com',
            'password'=>Hash::make('admin'),
            'profile_picture'=>'null',
            ]);
    }
}
