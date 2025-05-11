<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSubject;

class UsersSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSubject::create([
            'user_id' => 1,
            'subject_id' => 1,
        ]);
    }
}
