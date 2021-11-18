<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        DB::table('Subjects')->truncate();
        $subjects = [
            'Toán 6',
            'Toán 7',
            'Toán 8',
            'Toán 9',
            'Toán 10',
            'Toán 11',
            'Toán 12',
            'Hóa 6',
            'Hóa 7',
            'Hóa 8',
            'Hóa 9',
            'Hóa 10',
            'Hóa 11',
            'Hóa 12',
            'Lý 6',
            'Lý 7',
            'Lý 8',
            'Lý 9',
            'Lý 10',
            'Lý 11',
            'Lý 12',
            'Anh 6',
            'Anh 7',
            'Anh 8',
            'Anh 9',
            'Anh 10',
            'Anh 11',
            'Anh 12',
        ];

        foreach ($subjects as $subject) {
            DB::table('Subjects')->insert([
                'name' => $subject,
            ]);
        }

//        DB::table('Shifts')->truncate();
        $shifts = [
            'ca-sang',
            'ca-chieu',
            'ca-toi',
        ];

        foreach ($shifts as $shift) {
            DB::table('shifts')->insert([
                'name' => $shift,
            ]);
        }

        Student::factory()->count(20)->create();
    }
}
