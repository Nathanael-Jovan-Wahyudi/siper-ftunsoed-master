<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gedungs = [
            ['kode' => 'A', 'gedung_id' => 1, 'lantai' => 2],
            ['kode' => 'C', 'gedung_id' => 2, 'lantai' => 2],
            ['kode' => 'D', 'gedung_id' => 3, 'lantai' => 2],
            ['kode' => 'E', 'gedung_id' => 4, 'lantai' => 3], // E: 3 lantai
            ['kode' => 'F', 'gedung_id' => 5, 'lantai' => 2],
        ];

        $ruangs = [];
        foreach ($gedungs as $gedung) {
            for ($lantai = 1; $lantai <= $gedung['lantai']; $lantai++) {
                for ($no = 1; $no <= 5; $no++) {
                    $kode = $gedung['kode'] . $lantai . sprintf('%02d', $no);
                    $ruangs[] = [
                        'nama_ruang' => $kode,
                        'kapasitas' => 50,
                        'tipe_ruang' => 'Kelas',
                        'gedung_id' => $gedung['gedung_id'],
                    ];
                }
            }
        }

        // Tambahan ruangan khusus
        $ruangs[] = [
            'nama_ruang' => 'Aula Gedung F',
            'kapasitas' => 200,
            'tipe_ruang' => 'Aula',
            'gedung_id' => 6, // Aula F
        ];
        $ruangs[] = [
            'nama_ruang' => 'Lapangan Gedung C',
            'kapasitas' => 150,
            'tipe_ruang' => 'Lapangan',
            'gedung_id' => 7, // Lapangan Basket
        ];
        $ruangs[] = [
            'nama_ruang' => 'Masjid Teknik',
            'kapasitas' => 100,
            'tipe_ruang' => 'Masjid',
            'gedung_id' => 8, // Masjid Teknik
        ];

        Ruangan::insert($ruangs);
    }
}
