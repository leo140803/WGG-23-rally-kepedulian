<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakultasProdi extends Seeder
{
    public function run()
    {
        //
        $now = date('Y-m-d H:i:s');
        $fakultas = array(
            array('id' => null, 'kode' => 'A', 'nama' => 'FAKULTAS BAHASA DAN SASTRA',              'nama_inggris' => null,                                             'created_at' => $now, 'updated_at' => $now, 'deleted_at' => $now),
            array('id' => null, 'kode' => 'B', 'nama' => 'FAKULTAS TEKNIK SIPIL DAN PERENCANAAN',   'nama_inggris' => 'FACULTY OF CIVIL ENGINEERING AND PLANNING',      'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => 'C', 'nama' => 'FAKULTAS TEKNOLOGI INDUSTRI',             'nama_inggris' => 'FACULTY OF INDUSTRIAL TECHNOLOGY',               'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => 'D', 'nama' => 'FAKULTAS BISNIS DAN EKONOMI',             'nama_inggris' => 'SCHOOL OF BUSINNES AND MANAGEMENT',              'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => 'E', 'nama' => 'FAKULTAS SENDI DAN DESAIN',               'nama_inggris' => null,                                             'created_at' => $now, 'updated_at' => $now, 'deleted_at' => $now),
            array('id' => null, 'kode' => 'F', 'nama' => 'FAKULTAS ILMU KOMUNIKASI',                'nama_inggris' => null,                                             'created_at' => $now, 'updated_at' => $now, 'deleted_at' => $now),
            array('id' => null, 'kode' => 'G', 'nama' => 'FAKULTAS KEGURUAN AND ILMU PENDIDIKAN',   'nama_inggris' => 'FACULTY OF TEACHER EDUCATION',                   'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => 'H', 'nama' => 'FAKULTAS HUMANIORA DAN INDUSTRI KREATIF', 'nama_inggris' => 'FACULTY OF HUMANITIES AND CREATIVE INDUSTRIES',  'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
        );
        $this->db->table('master_fakultas')->insertBatch($fakultas);

        $prodi = array(
            array('id' => null, 'kode' => '1', 'nama' => 'TEKNIK SIPIL',                                        'nama_inggris' => 'CIVIL ENGINEERING',                                      'fakultas' => 2, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'ARSITEKTUR',                                          'nama_inggris' => 'ARCHITECTURE',                                           'fakultas' => 2, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'ARCHITECTURE OF SUSTAINABLE HOUSING & REAL ESTATE',   'nama_inggris' => 'ARCHITECTURE OF SUSTAINABLE HOUSING AND REAL ESTATE',    'fakultas' => 2, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'TEKNIK ELEKTRO',                                      'nama_inggris' => 'ELECTRICAL ENGINEERING',                                 'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'INTERNET OF THINGS',                                  'nama_inggris' => 'INTERNET OF THINGS',                                     'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'SUSTAINABLE MECHANICAL ENGINEERING AND DESIGN',       'nama_inggris' => 'SUSTAINABLE MECHANICAL ENGINEERING AND DESIGN',          'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'AUTOMOTIVE',                                          'nama_inggris' => 'AUTOMOTIVE',                                             'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '3', 'nama' => 'TEKNIK INDUSTRI',                                     'nama_inggris' => 'INDUSTRIAL ENGINEERING',                                 'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '3', 'nama' => 'INTERNATIONAL BUSINESS ENGINEERING',                  'nama_inggris' => 'INTERNATIONAL BUSINESS ENGINEERING',                     'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '3', 'nama' => 'GLOBAL LOGISTICS & SUPPLY CHAIN',                     'nama_inggris' => 'GLOBAL LOGISTICS AND SUPPLY CHAIN',                      'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '4', 'nama' => 'INFORMATIKA',                                         'nama_inggris' => 'INFORMATICS  ',                                          'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '4', 'nama' => 'BUSINESS INFORMATION SYSTEM',                         'nama_inggris' => 'BUSINESS INFORMATION SYSTEM',                            'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '4', 'nama' => 'DATA SCIENCE AND ANALYTICS',                          'nama_inggris' => 'DATA SCIENCE AND ANALYTICS',                             'fakultas' => 3, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'CREATIVE TOURISM',                                    'nama_inggris' => 'CREATIVE TOURISM',                                       'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'HOTEL MANAGEMENT',                                    'nama_inggris' => 'HOTEL MANAGEMENT',                                       'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'FINANCE AND INVESTMENT',                              'nama_inggris' => 'FINANCE AND INVESTMENT',                                 'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'BRANDING AND DIGITAL MARKETING',                      'nama_inggris' => 'BRANDING AND DIGITAL MARKETING',                                   'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'BUSINESS MANAGEMENT',                                 'nama_inggris' => 'BUSINESS MANAGEMENT',                                    'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'INTERNATIONAL BUSINESS MANAGEMENT',                   'nama_inggris' => 'INTERNATIONAL BUSINESS MANAGEMENT',                      'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'BUSINESS ACCOUNTING',                                 'nama_inggris' => 'BUSINESS ACCOUNTING',                                    'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'INTERNATIONAL BUSINESS ACCOUNTING',                   'nama_inggris' => 'INTERNATIONAL BUSINESS ACCOUNTING',                      'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'TAX ACCOUNTING',                                      'nama_inggris' => 'TAX ACCOUNTING',                                         'fakultas' => 4, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'PENDIDIKAN GURU - SEKOLAH DASAR',                     'nama_inggris' => 'ELEMENTARY TEACHER EDUCATION',                           'fakultas' => 7, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'PENDIDIKAN GURU PENDIDIKAN ANAK USIA DINI',           'nama_inggris' => 'EARLY CHILDHOOD TEACHER EDUCATION',                      'fakultas' => 7, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'ENGLISH FOR BUSINESS',                                'nama_inggris' => 'ENGLISH FOR BUSINESS',                                   'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '1', 'nama' => 'ENGLISH FOR CREATIVE INDUSTRY',                       'nama_inggris' => 'ENGLISH FOR CREATIVE INDUSTRY',                          'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '2', 'nama' => 'BAHASA MANDARIN',                                     'nama_inggris' => 'CHINESE',                                                'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '3', 'nama' => 'INTERIOR PRODUCT DESIGN',                             'nama_inggris' => 'INTERIOR PRODUCT DESIGN',                                'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '3', 'nama' => 'INTERIOR DESIGN AND STYLING',                         'nama_inggris' => 'INTERIOR DESIGN AND STYLING',                            'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '4', 'nama' => 'DESAIN KOMUNIKASI VISUAL',                            'nama_inggris' => 'VISUAL COMMUNICATION DESIGN',                            'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '4', 'nama' => 'TEXTILE AND FASHION DESIGN',                          'nama_inggris' => 'TEXTILE AND FASHION DESIGN',                             'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '4', 'nama' => 'INTERNATIONAL PROGRAM IN DIGITAL MEDIA',              'nama_inggris' => 'INTERNATIONAL PROGRAM IN DIGITAL MEDIA',                 'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '5', 'nama' => 'BROADCAST AND JOURNALISM',                            'nama_inggris' => 'BROADCAST AND JOURNALISM',                               'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),
            array('id' => null, 'kode' => '5', 'nama' => 'STRATEGIC COMMUNICATION',                             'nama_inggris' => 'STRATEGIC COMMUNICATION',                                'fakultas' => 8, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => NULL),

        );
        $this->db->table('master_prodi')->insertBatch($prodi);
    }
}
