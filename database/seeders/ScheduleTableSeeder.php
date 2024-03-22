<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'name' => 'John Doe',
            'andress' => 'Rua ibiruá, 424',
            'email' => 'john@example.com',
            'telephone' => '(98)99873-344'
        ]);

        Schedule::create([
            'name' => 'Jane Smith',
            'andress' => 'Rua Amazonas, 424',
            'email' => 'jane@example.com',
            'telephone' => '(92)99871-3348',
        ]);
    }
}
