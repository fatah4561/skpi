<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CertificateVersion;


class CertificateVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // array list sertifikat beserta versi nya disusun berdasarkan id hasil seeder CertificateTypeSeeder
        $MOSMTA = ['MOS Excel 2013', 'MOS Excel 2016', 'MTA Database Administration Fundamentals'];
        $oracle = ['Oracle Java Programming', 'Oracle Java Fundamentals'];
        $mtcna = [];
        $ccent = [];
        $ccna = ['CCNA Networking Essentials', 
            'CCNA Routing and Switching: Introduction to Networks', 
            'CCNAv7: Switching, Routing, and Wireless Essentials',
            'CCNAv7: Enterprise Networking, Security, and Automation',
        ];
        $toeic = '2022';
        $moswa = [];

        foreach($MOSMTA as $item){
            $new_mosmta = CertificateVersion::create([
                'certificate_id' => 1,
                'version' => $item,
            ]);
            $new_mosmta->save();
        }

        foreach($oracle as $item){
            $new_oracle = CertificateVersion::create([
                'certificate_id' => 2,
                'version' => $item,
            ]);
            $new_oracle->save();
        }

        foreach($ccna as $item){
            $new_ccna = CertificateVersion::create([
                'certificate_id' => 5,
                'version' => $item,
            ]);
            $new_ccna->save();
        }

        $new_toeic = CertificateVersion::create([
            'certificate_id' => 6,
            'version' => $toeic,
        ]);
        $new_toeic->save();

    }
}
