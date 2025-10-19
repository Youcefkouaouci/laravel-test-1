<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    
        $users = User::factory(5)->create();  
    
        Property::factory(10)->create();
    
        Booking::factory(8)->create()->each(function ($booking) use ($users) {
            $tenant = $users->random();  
            $booking->user_id = $tenant->id; 
            $booking->save();
        });
    }
}
