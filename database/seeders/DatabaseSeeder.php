<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        User::factory()->create( [ 
            'roles_id'          => 2,
            'first_name'        => 'Tes',
            'last_name'         => 'Seller',
            'email'             => 'seller@gmail.com',
            'password'          => 'password',
            'status'            => 1,
            'phone'             => '089517721586',
            'address'           => 'Jl gunung guntur RT 2 RW 8 Kelurahan Bancarkembar, Kecamatan Purwokerto Utara 53121',
        ] );
        User::factory()->create( [ 
            'roles_id'   => 2,
            'first_name' => 'Tes',
            'last_name'  => 'Seller1',
            'email'      => 'seller1@gmail.com',
            'password'   => 'password',
            'status'     => 1,
            'phone'      => '089517721586',
            'address'    => 'Jl gunung guntur RT 2 RW 8 Kelurahan Bancarkembar, Kecamatan Purwokerto Utara 53121',
        ] );
        $this->call(CustomerSeeder::class);
        Customer::factory()->create( [ 
            'first_name'         => 'Customer',
            'last_name'          => 'Active',
            'email'              => 'customer@gmail.com',
            'password'           => 'password',
            'phone'              => '089517721586',
            'address'            => fake()->address(),
            'status'             => 1,
            'image' => 'thumb-1.jpg',
        ] );

        Customer::factory()->create( [ 
            'first_name'         => 'Customer',
            'last_name'          => 'Non-Active',
            'email'              => 'customeroff@gmail.com',
            'password'           => 'password',
            'phone'              => '089517721586',
            'address'            => fake()->address(),
            'status'             => 0,
            'image' => 'thumb-1.jpg',
        ] );
        // $this->call(OrdersSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
