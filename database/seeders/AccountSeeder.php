<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            $new_admin = User::create([
                'email' => 'fatahathariq6@gmail.com',
                'type' => 1,
                'password' => 'fatah321123',
                'google_id' => null,

            ]);
            $new_user = User::create([
                'email' => '190613015@fellow.lpkia.ac.id',
                'type' => 0,
                'password' => '108337727044184656941',
                'google_id' => '108337727044184656941',
                
            ]);
            $new_student = Student::create([
                'user_id' => $new_user->id(),
                'nrp' => '190613015',
                'name' => 'Fatah At Thariq',
                'class' => '3MI-01',
                'Major' => 'MI',
                'college_type' => 'Reguler',
                'phone_number' => '087889550578',
                'picture' => null,
                'defence_status' => 'Sudah Lulus'
            ]);
            $new_admin->save();
            $new_user->save();
            $new_student->save();
    }
}
