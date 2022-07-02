<?php

namespace Database\Seeders;

use App\Models\Classs;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'role_id' => 1,
                'name' => 'admin',
                'username' => 'admin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
        );

        Role::create(['id'=>1,'name'=>'admin' ]);
        Role::create(['id'=>2,'name'=>'teacher' ]);
        Role::create(['id'=>3,'name'=>'student' ]);

        Classs::create(['id'=>1,'name'=>'1' ]);
        Classs::create(['id'=>2,'name'=>'2' ]);
        Classs::create(['id'=>3,'name'=>'3' ]);
        Classs::create(['id'=>4,'name'=>'4' ]);
        Classs::create(['id'=>5,'name'=>'5' ]);
        Classs::create(['id'=>6,'name'=>'6' ]);
    }
}
