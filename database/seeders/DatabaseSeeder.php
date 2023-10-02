<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'QED Admin',
            'username' => 'qed',
            'email' => 'admin@qed.co.ug',
        ]);

        if (tenant('id')) {
          \App\Models\User::factory(3)->create();

          $this->call([
            PermissionAndRoleSeeder::class
          ]);
        }

    }
}
