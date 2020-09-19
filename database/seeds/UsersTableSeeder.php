<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin= User::create([
        	'name'=>'Kaung Myat',
        	'profile'=>'images/user/admin.png',
        	'email'=>'admin@gmail.com',
        	'password'=>Hash::make('123456789'),
        	'phone'=>'0987654321',
        	'address'=>'YGN'

        ]);
        $admin->assignRole('admin');  
        $customer=User::create([
        	'name'=>'Myat Naing',
        	'profile'=>'images/user/customer.png',
        	'email'=>'customer@gmail.com',
        	'password'=>Hash::make('123456789'),
        	'phone'=>'0987654321',
        	'address'=>'YGN'

        ]);
        $customer->assignRole('customer');
    }
}
