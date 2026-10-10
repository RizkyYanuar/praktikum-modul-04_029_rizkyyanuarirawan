<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('img');

        $products = [
            [
                'id_barang'   => 'PRD001',
                'nama_barang' => 'Yonex - Astrox 10 Navy Blue AX10EX Badminton Racket (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Astrox 10 dengan desain navy blue.',
                'harga'       => 1600000.00,
                'stok'        => 25,
                'gambar'      => 'yonex.jpg',
            ],
            [
                'id_barang'   => 'PRD002',
                'nama_barang' => 'Yonex - Astrox 10 Olive Green AX10EX Badminton Racket (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Astrox 10 dengan desain olive green.',
                'harga'       => 1600000.00,
                'stok'        => 50,
                'gambar'      => 'yonex2.jpg',
            ],
            [
                'id_barang'   => 'PRD003',
                'nama_barang' => 'Yonex - Astrox 10 White Pink AX10EX Badminton Racket (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Astrox 10 dengan desain white pink.',
                'harga'       => 1600000.00,
                'stok'        => 30,
                'gambar'      => 'yonex3.jpg',
            ],
            [
                'id_barang'   => 'PRD004',
                'nama_barang' => 'Yonex - Astrox 3DG HF Blue White Durable Grade Badminton Racket AX3DGHF (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Astrox 3DG HF dengan desain blue white.',
                'harga'       => 2000000.00,
                'stok'        => 40,
                'gambar'      => 'yonex4.jpg',
            ],
            [
                'id_barang'   => 'PRD005',
                'nama_barang' => 'Yonex - Astrox 3DG Red Black Durable Grade Badminton Racket AX3DG (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Astrox 3DG dengan desain red black.',
                'harga'       => 1750000.00,
                'stok'        => 15,
                'gambar'      => 'yonex5.jpg',
            ],
            [
                'id_barang'   => 'PRD006',
                'nama_barang' => 'Yonex - Astrox 7DG Black Blue Durable Grade Badminton Racket AX7DGEX (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Astrox 7DG dengan desain black blue.',
                'harga'       => 2100000.00,
                'stok'        => 20,
                'gambar'      => 'yonex6.jpg',
            ],
            [
                'id_barang'   => 'PRD007',
                'nama_barang' => 'Yonex - Voltric Lite 20i iSeries VTLT20IEX Blue Badminton Racket (5U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Voltric Lite 20i dengan desain blue.',
                'harga'       => 1100000.00,
                'stok'        => 60,
                'gambar'      => 'yonex7.jpg',
            ],
            [
                'id_barang'   => 'PRD008',
                'nama_barang' => 'Yonex Arcsaber 1 CLEAR Blue Badminton Racket (5U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Arcsaber 1 dengan desain clear blue.',
                'harga'       => 1050000.00,
                'stok'        => 35,
                'gambar'      => 'yonex8.jpg',
            ],
            [
                'id_barang'   => 'PRD009',
                'nama_barang' => 'Yonex Arcsaber 11 Play Grayish Pearl (Made In China) Badminton Racket (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Arcsaber 11 dengan desain grayish pearl.',
                'harga'       => 1500000.00,
                'stok'        => 25,
                'gambar'      => 'yonex9.jpg',
            ],
            [
                'id_barang'   => 'PRD010',
                'nama_barang' => 'Yonex Arcsaber 2 ABILITY Black Pink Badminton Racket (4U-G5)',
                'deskripsi'   => 'Raket badminton Yonex Arcsaber 2 dengan desain black pink.',
                'harga'       => 1800000.00,
                'stok'        => 20,
                'gambar'      => 'yonex10.jpg',
            ],
        ];
        foreach ($products as $item) {
            Product::updateOrCreate(
                ['id_barang' => $item['id_barang']],
                [
                    'nama_barang' => $item['nama_barang'],
                    'deskripsi'   => $item['deskripsi'],
                    'harga'       => $item['harga'],
                    'stok'        => $item['stok'],
                    'gambar'      => $item['gambar'],
                ]
            );
        }
    }
}
