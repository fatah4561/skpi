<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CertificateType;

class CertificateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //array list sertifikat
        $certificates = ['MOSMTA', 'Oracle', 'MTCNA', 'CCENT', 'CCNA', 'TOEIC', 'MOSWA'];
        foreach($certificates as $certificate){
            $new_data = CertificateType::create([
                'certificate_name' => $certificate,
            ]);
            $new_data->save();
        }

    }
}
