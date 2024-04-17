<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert(
            [
                [
                    'name' => 'PT. Trimitra Putra Mandiri',
                    'abbreviation' => 'TPM',
                    'created_at' => now()
                ],
                [
                    'name' => 'PT. Tunas Perkasa Muda Logistik',
                    'abbreviation' => 'TPM Logistik',
                    'created_at' => now()
                ],
                [
                    'name' => 'PT. Logamindo Teknologi Indonesia',
                    'abbreviation' => 'Mindotek',
                    'created_at' => now()
                ],
                [
                    'name' => 'PT. Tunas Prakarsa Mandiri',
                    'abbreviation' => 'TPM',
                    'created_at' => now()
                ],
                [
                    'name' => 'PT. Trimitra Media Teknologi',
                    'abbreviation' => 'TMT',
                    'created_at' => now()
                ],
                [
                    'name' => 'PT. Trimitra Media Teknologi Indonesia',
                    'abbreviation' => 'TMT Indonesia',
                    'created_at' => now()
                ],
                [
                    'name' => 'PT. Trimitra Data Komunikasi',
                    'abbreviation' => 'TDK',
                    'created_at' => now()
                ]
            ]
        );
    }
}
