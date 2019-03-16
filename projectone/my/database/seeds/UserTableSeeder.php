<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     			for ($i=1; $i < 30; $i++) { 
    		
        	DB::table('user')->insert([
            	'username' => str_random(10),
            	'email' => str_random(10).'@gmail.com',
            	'password' => bcrypt('secret'),
            	'phone' => '139'.rand(11111111,99999999),
            	'profile' => '/upload/48301488638993.bmp',
            	'status' => '0'

        	]);
        }  
    }
}
