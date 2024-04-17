<?php

namespace Database\Seeders;

use App\Models\Regional;
use Illuminate\Database\Seeder;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regionals = [
            [
                "id"    => 1,
                "name" => "Bengkulu",
                "abbreviation" => 'BK',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 2,
                "name" => "Bali Nusa Tenggara",
                "abbreviation" => 'BN',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 3,
                "name" => "Central Sumatra",
                "abbreviation" => 'CS',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 4,
                "name" => "Head Office",
                "abbreviation" => 'HO',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 5,
                "name" => "Central Java",
                "abbreviation" => 'CJ',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 6,
                "name" => "North Sumatra",
                "abbreviation" => 'NS',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 7,
                "name" => "Pekanbaru",
                "abbreviation" => 'PK',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 8,
                "name" => "South Central Java",
                "abbreviation" => 'SCJ',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 9,
                "name" => "SITE-KOKAS",
                "abbreviation" => 'kokas',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 10,
                "name" => "SITE-MEAINA",
                "abbreviation" => 'meaina',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 11,
                "name" => "SITE-PAKARTA",
                "abbreviation" => 'pakarta',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 12,
                "name" => "SITE-PERTAMINA CIREBON",
                "abbreviation" => 'PCirebon',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 13,
                "name" => "SITE-PLAZA BRI SBY",
                "abbreviation" => 'PLBRISBY',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 14,
                "name" => "SITE-SEIBU",
                "abbreviation" => 'seibu',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 15,
                "name" => "SITE-SOGO CENTRAL PARK",
                "abbreviation" => 'SCP',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 16,
                "name" => "SITE-SOGO KOKAS",
                "abbreviation" => 'S Kokas',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 17,
                "name" => "SITE-SOGO PIM",
                "abbreviation" => 'S PIM',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 18,
                "name" => "SITE-SOGO PS",
                "abbreviation" => 'S PS',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 19,
                "name" => "SITE-SOGO TP SBY",
                "abbreviation" => 'S TP SBY',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 20,
                "name" => "SITE-TARAKANITA",
                "abbreviation" => 'tarkit',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 21,
                "name" => "SITE-TPM SBY",
                "abbreviation" => 'tpm sby',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 22,
                "name" => "South Sumatra",
                "abbreviation" => 'SS',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 23,
                "name" => "Sulawesi",
                "abbreviation" => 'SW',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 24,
                "name" => "Surabaya",
                "abbreviation" => 'SB',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 25,
                "name" => "West Java",
                "abbreviation" => 'WJ',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 26,
                "name" => "BATAM",
                "abbreviation" => 'BTM',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 27,
                "name" => "MEDAN",
                "abbreviation" => 'MDN',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 28,
                "name" => "Palembang",
                "abbreviation" => 'PLB',
                "created_at" => date('Y-m-d H:i:s')
            ],
            [
                "id"    => 29,
                "name" => "Warehouse Jakarta",
                "abbreviation" => 'WH Jakarta',
                "created_at" => date('Y-m-d H:i:s')
            ]
        ];

        Regional::insert($regionals);
    }
}
