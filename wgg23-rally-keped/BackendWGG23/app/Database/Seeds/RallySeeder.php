<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;
use App\Models\Rally\KelompokModel;

class RallySeeder extends Seeder
{
    protected $kelompok;
    protected $db;

    public function __construct()
    {
        $this->kelompok = new KelompokModel();
        $this->db = \Config\Database::connect();
    }

    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $model = new \App\Models\Kelompok\KelompokModel();
//         $idKels = $model->select(['id'])->findAll();


//             $dataKel = [
//                 'nama' => $nama,
//                 'id_ketua' => $i,
//                 'ruangan' => 'P.' . $faker->randomNumber(3, true),
//                 'created_at' => Time::now(),
//                 'updated_at' => Time::now(),
//             ];
//             $this->db->table('kelompok')->insert($dataKel);
//         }

        $kel = $this->kelompok->findAll();
        foreach ($kel as $k) {
            $dataKelRally = [
                'id_kelompok' => $id,
                'poin' => 0,
                'scene' => $faker->numberBetween(1, 3),
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
            $this->db->table('kelompok_rally')->insert($dataKelRally);
        }
        // item
        $items = [
            [
                'nama' => 'Pohon 1',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 99,
                'height' => 105,
                'z-index' => 2,
            ],
            [
                'nama' => 'Pohon 1',
                'scene' => 1,
                'harga' => 15,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/pohon-kuning-shop.png',
                'width' => 99,
                'height' => 105,
                'z-index' => 2,
            ],
            [
                'nama' => 'Pohon 2',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 99,
                'height' => 100,
                'z-index' => 2,
            ],
            [
                'nama' => 'Pohon 2',
                'scene' => 1,
                'harga' => 15,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/pohon-merah-shop.png',
                'width' => 99,
                'height' => 100,
                'z-index' => 2,
            ],
            [
                'nama' => 'Background',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 99,
                'height' => 100,
                'z-index' => -2,
            ],
            [
                'nama' => 'Background',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 1,
                'width' => 99,
                'height' => 100,
                'z-index' => -2,
            ],
            [
                'nama' => 'Tanah',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 99,
                'height' => 100,
                'z-index' => -2,
            ],
            [
                'nama' => 'Tanah',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 1,
                'width' => 99,
                'height' => 100,
                'z-index' => -2,
            ],
            [
                'nama' => 'Sungai',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 85,
                'height' => 115,
                'z-index' => 2,
            ],
            [
                'nama' => 'Sungai',
                'scene' => 1,
                'harga' => 30,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/sungai-shop.png',
                'width' => 85,
                'height' => 115,
                'z-index' => 2,
            ],
            [
                'nama' => 'Bukit',
                'scene' => 1,
                'harga' => 25,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/bukit-shop.png',
                'width' => 99,
                'height' => 100,
                'z-index' => 0,
            ],
            [
                'nama' => 'Rumput',
                'scene' => 1,
                'harga' => 10,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/rumput-shop.png',
                'width' => 99,
                'height' => 100,
                'z-index' => 3,
            ],
            [
                'nama' => 'Buah',
                'scene' => 1,
                'harga' => 15,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/buah-shop.png',
                'width' => 99,
                'height' => 100,
                'z-index' => 3,
            ],
            [
                'nama' => 'Bunga',
                'scene' => 1,
                'harga' => 25,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/bunga-shop.png',
                'width' => 99,
                'height' => 100,
                'z-index' => 3,
            ],
            [
                'nama' => 'Kupu-kupu',
                'scene' => 1,
                'harga' => 25,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/kupu-shop.png',
                'width' => 99,
                'height' => 100,
                'z-index' => 3,
            ],
            [
                'nama' => 'Jerapah',
                'scene' => 1,
                'harga' => 40,
                'repaired' => 1,
                'shop_image' => 'assets/rally/climate/jerapah-shop.png',
                'width' => 99,
                'height' => 100,
                'z-index' => 3,
            ],
            [
                'nama' => 'Gedung Merah',
                'scene' => 2,
                'harga' => 15,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/red-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 7,
            ],
            [
                'nama' => 'Gedung Orange',
                'scene' => 2,
                'harga' => 15,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/orange-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 7,
            ],
            [
                'nama' => 'Gedung Kuning',
                'scene' => 2,
                'harga' => 20,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/yellow-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 5,
            ],
            [
                'nama' => 'Gedung Hijau',
                'scene' => 2,
                'harga' => 25,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/green-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 6,
            ],
            [
                'nama' => 'Gedung Biru',
                'scene' => 2,
                'harga' => 35,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/blue-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 3,
            ],
            [
                'nama' => 'Gedung Ungu',
                'scene' => 2,
                'harga' => 40,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/purple-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 2,
            ],
            [
                'nama' => 'Bianglala',
                'scene' => 2,
                'harga' => 20,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/bianglala-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 4,
            ],
            [
                'nama' => 'Mobil Mewah',
                'scene' => 2,
                'harga' => 30,
                'repaired' => 1,
                'shop_image' => 'assets/rally/eco/car-shop.png',
                'width' => 100,
                'height' => 100,
                'z-index' => 11,
            ],
            [
                'nama' => 'Background',
                'scene' => 2,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 11,
            ],
            [
                'nama' => 'Sky',
                'scene' => 2,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 11,
            ],
            [
                'nama' => 'Road',
                'scene' => 2,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 11,
            ],

            // awan climate
            [
                'nama' => 'Awan',
                'scene' => 1,
                'harga' => 10000,
                'repaired' => 1,
                'width' => 100,
                'height' => 100,
                'z-index' => -1,
            ],

            // herd mentality
            [
                'nama' => 'Kayu Penyangga',
                'scene' => 3,
                'harga' => 20,
                'repaired' => 1,
                'shop_image' => 'assets/rally/herd/kayu-penyangga.png',
                'width' => 100,
                'height' => 100,
                'z-index' => -1,
            ],

            [
                'nama' => 'Tali Jembatan',
                'scene' => 3,
                'harga' => 30,
                'repaired' => 1,
                'shop_image' => 'assets/rally/herd/tali.png',
                'width' => 100,
                'height' => 100,
                'z-index' => -1,
            ],

            [
                'nama' => 'Balok Kayu',
                'scene' => 3,
                'harga' => 50,
                'repaired' => 1,
                'shop_image' => 'assets/rally/herd/balok-kayu.png',
                'width' => 100,
                'height' => 100,
                'z-index' => -1,
            ],

            [
                'nama' => 'Background',
                'scene' => 3,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 0,
            ],

            [
                'nama' => 'Pohon',
                'scene' => 3,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 1,
            ],

            [
                'nama' => 'Arah',
                'scene' => 3,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 2,
            ],

            [
                'nama' => 'Jembatan Kanan',
                'scene' => 3,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 2,
            ],
            [
                'nama' => 'Orang Merah',
                'scene' => 3,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 3,
            ],
            [
                'nama' => 'Orang Biru',
                'scene' => 3,
                'harga' => 10000,
                'repaired' => 0,
                'width' => 100,
                'height' => 100,
                'z-index' => 3,
            ],
        ];

        foreach ($items as $item) {
            $item['created_at'] = Time::now();
            $item['updated_at'] = Time::now();
            $this->db->table('item')->insert($item);
        }

        // item img
        $img = [
            [
                'id_item' => 1,
                'image' => 'assets/rally/climate/pohon-kuning.png',
            ],
            [
                'id_item' => 2,
                'image' => 'assets/rally/climate/pohon-kuning-repaired.png',
            ],
            [
                'id_item' => 3,
                'image' => 'assets/rally/climate/pohon-merah.png',
            ],
            [
                'id_item' => 4,
                'image' => 'assets/rally/climate/pohon-merah-repaired.png',
            ],
            [
                'id_item' => 5,
                'image' => 'assets/rally/climate/background.png',
            ],
            [
                'id_item' => 6,
                'image' => 'assets/rally/climate/background-repaired.png',
            ],
            [
                'id_item' => 7,
                'image' => 'assets/rally/climate/tanah.png',
            ],
            [
                'id_item' => 8,
                'image' => 'assets/rally/climate/tanah-repaired.png',
            ],
            [
                'id_item' => 9,
                'image' => 'assets/rally/climate/sungai.png',
            ],
            [
                'id_item' => 10,
                'image' => 'assets/rally/climate/sungai-repaired.png',
            ],
            [
                'id_item' => 11,
                'image' => 'assets/rally/climate/bukit.png',
            ],
            [
                'id_item' => 12,
                'image' => 'assets/rally/climate/rumput.png',
            ],
            [
                'id_item' => 13,
                'image' => 'assets/rally/climate/buah.png',
            ],
            [
                'id_item' => 14,
                'image' => 'assets/rally/climate/bunga.png',
            ],
            [
                'id_item' => 15,
                'image' => 'assets/rally/climate/kupu.png',
            ],
            [
                'id_item' => 16,
                'image' => 'assets/rally/climate/jerapah.png',
            ],

            // Eco
            [
                'id_item' => 17,
                'image' => 'assets/rally/eco/red.png',
            ],
            [
                'id_item' => 18,
                'image' => 'assets/rally/eco/orange1.png',
            ],
            [
                'id_item' => 18,
                'image' => 'assets/rally/eco/orange2.png',
            ],
            [
                'id_item' => 19,
                'image' => 'assets/rally/eco/yellow1.png',
            ],
            [
                'id_item' => 19,
                'image' => 'assets/rally/eco/yellow2.png',
            ],
            [
                'id_item' => 20,
                'image' => 'assets/rally/eco/green1.png',
            ],
            [
                'id_item' => 20,
                'image' => 'assets/rally/eco/green2.png',
            ],
            [
                'id_item' => 21,
                'image' => 'assets/rally/eco/blue1.png',
            ],
            [
                'id_item' => 21,
                'image' => 'assets/rally/eco/blue2.png',
            ],
            [
                'id_item' => 22,
                'image' => 'assets/rally/eco/purple.png',
            ],
            [
                'id_item' => 23,
                'image' => 'assets/rally/eco/bianglala.png',
            ],
            [
                'id_item' => 24,
                'image' => 'assets/rally/eco/car1.png',
            ],
            [
                'id_item' => 24,
                'image' => 'assets/rally/eco/car2.png',
            ],
            [
                'id_item' => 24,
                'image' => 'assets/rally/eco/car3.png',
            ],
            [
                'id_item' => 24,
                'image' => 'assets/rally/eco/car4.png',
            ],
            [
                'id_item' => 24,
                'image' => 'assets/rally/eco/car5.png',
            ],
            [
                'id_item' => 25,
                'image' => 'assets/rally/eco/background.png',
            ],
            [
                'id_item' => 26,
                'image' => 'assets/rally/eco/sky.png',
            ],
            [
                'id_item' => 27,
                'image' => 'assets/rally/eco/road.png',
            ],

            // awan climate
            [
                'id_item' => 28,
                'image' => 'assets/rally/climate/awan.png',
            ],

            // herd
            [
                'id_item' => 29,
                'image' => 'assets/rally/herd/kayu-beli.png',
            ],
            [
                'id_item' => 30,
                'image' => 'assets/rally/herd/tali-beli.png',
            ],
            [
                'id_item' => 31,
                'image' => 'assets/rally/herd/kayu-1.png',
            ],
            [
                'id_item' => 32,
                'image' => 'assets/rally/herd/background.png',
            ],
            [
                'id_item' => 33,
                'image' => 'assets/rally/herd/pohon.png',
            ],
            [
                'id_item' => 34,
                'image' => 'assets/rally/herd/arah.png',
            ],
            [
                'id_item' => 35,
                'image' => 'assets/rally/herd/jembatan-kanan.png',
            ],
            [
                'id_item' => 36,
                'image' => 'assets/rally/herd/orang-merah.png',
            ],
            [
                'id_item' => 37,
                'image' => 'assets/rally/herd/orang-biru.png',
            ],
            [
                'id_item' => 31,
                'image' => 'assets/rally/herd/kayu-2.png',
            ],
            [
                'id_item' => 31,
                'image' => 'assets/rally/herd/kayu-3.png',
            ],
        ];

        foreach ($img as $i) {
            $i['created_at'] = Time::now();
            $i['updated_at'] = Time::now();
            $this->db->table('item_img')->insert($i);
        }
    }
}
