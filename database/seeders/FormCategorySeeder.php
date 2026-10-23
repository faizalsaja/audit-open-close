<?php

namespace Database\Seeders;

use App\Models\FormCategory;
use Illuminate\Database\Seeder;

class FormCategorySeeder extends Seeder
{
    public function run(): void
    {
        FormCategory::create([
            'name' => 'TAMBAHAN PASIEN VIA POLIKLINIK',
            'description' => 'Formulir tambahan untuk pasien melalui poliklinik',
            'is_active' => true,
        ]);

        FormCategory::create([
            'name' => 'TAMBAHAN PASIEN VIA IGD',
            'description' => 'Formulir tambahan untuk pasien melalui IGD',
            'is_active' => true,
        ]);

        FormCategory::create([
            'name' => 'INDIKATOR UTAMA',
            'description' => 'Formulir yang termasuk dalam indikator utama audit rekam medis',
            'is_active' => true,
        ]);

        FormCategory::create([
            'name' => 'TAMBAHAN KASUS BEDAH',
            'description' => 'Formulir tambahan untuk kasus bedah',
            'is_active' => true,
        ]);

        FormCategory::create([
            'name' => 'TAMBAHAN KASUS PERSALINAN VIA VK',
            'description' => 'Formulir tambahan untuk kasus persalinan melalui VK',
            'is_active' => true,
        ]);
    }
}