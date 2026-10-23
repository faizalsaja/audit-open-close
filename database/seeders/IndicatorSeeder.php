<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Indicator;
use Illuminate\Database\Seeder;

class IndicatorSeeder extends Seeder
{
    public function run(): void
    {
        $forms = Form::where('is_active', true)
            ->orderBy('id')
            ->get();

        foreach ($forms as $form) {

            // =========================
            // IDENTITAS
            // =========================

            $this->createIndicator(
                $form->id,
                'Nama Pasien',
                'identity',
                1
            );

            $this->createIndicator(
                $form->id,
                'No. Rekam Medik',
                'identity',
                2
            );

            $this->createIndicator(
                $form->id,
                'Tanggal Lahir / Usia',
                'identity',
                3
            );

            $this->createIndicator(
                $form->id,
                'Alamat',
                'identity',
                4
            );


            // =========================
            // KETERBACAAN
            // =========================

            $this->createIndicator(
                $form->id,
                'Tulisan Jelas / Terbaca',
                'readability',
                5
            );


            // =========================
            // AUTENTIKASI
            // =========================

            $this->createIndicator(
                $form->id,
                'Tanda Tangan',
                'authentication',
                6
            );

            $this->createIndicator(
                $form->id,
                'Nama / Cap / Stempel DPJP',
                'authentication',
                7
            );

            $this->createIndicator(
                $form->id,
                'Tanggal dan Jam Penulisan',
                'authentication',
                8
            );


            // =========================
            // KOREKSI
            // =========================

            $this->createIndicator(
                $form->id,
                'Pencatatan Koreksi Sesuai',
                'correction',
                9
            );
        }
    }

    private function createIndicator(
        int $formId,
        string $name,
        string $type,
        int $sortOrder
    ): void {
        Indicator::updateOrCreate(
            [
                'form_id' => $formId,
                'name' => $name,
            ],
            [
                'type' => $type,
                'sort_order' => $sortOrder,
                'is_required' => true,
                'is_active' => true,
            ]
        );
    }
}