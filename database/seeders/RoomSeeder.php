<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['name' => 'WIJAYA KUSUMA', 'code' => 'WK'],
            ['name' => 'IGD', 'code' => 'IGD'],
            ['name' => 'VK', 'code' => 'VK'],
            ['name' => 'POLIKLINIK', 'code' => 'POLI'],

            ['name' => 'SERUNI', 'code' => 'SERUNI'],
            ['name' => 'KENANGA', 'code' => 'KENANGA'],
            ['name' => 'TERATAI', 'code' => 'TERATAI'],
            ['name' => 'CENDANA', 'code' => 'CENDANA'],
            ['name' => 'SOEPARJO RUSTAM', 'code' => 'SOEPARJO RUSTAM'],
            ['name' => 'MAWAR', 'code' => 'MAWAR'],
            ['name' => 'DAHLIA', 'code' => 'DAHLIA'],
            ['name' => 'FLAMBOYAN', 'code' => 'FLAMBOYAN'],
            ['name' => 'MELATI', 'code' => 'MELATI'],
        ];

        foreach ($rooms as $room) {
            Room::updateOrCreate(
                ['name' => $room['name']],
                [
                    'code' => $room['code'],
                    'is_active' => true,
                ]
            );
        }
    }
}