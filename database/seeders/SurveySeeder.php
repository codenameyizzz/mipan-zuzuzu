<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $survey = [
            'Form Kuisioner - Bekerja',
            'Form Kuisioner - Tracer Study',
            'Form Kuisioner - Wiraswasta',
            'Form Kuisioner - Melanjutkan Pendidikan',
            'Form Kuisioner - Mencari Pekerjaan'
        ];

        foreach ($survey as $title) {
            $survey = Survey::create([
                'title' => $title
            ]);

            $quisioner = [
                [
                    'question' => 'Dalam berapa bulan Anda mendapatkan pekerjaan pertama?',
                    'type' => 'dropdown',
                    'is_multiple' => false,
                    'is_required' => true,
                    'survey_id' => $survey->id,
                    'options' => [
                        [
                            'value' => '<1',
                            'text' => 'Kurang dari 1 bulan'
                        ],
                        [
                            'value' => '1',
                            'text' => '1'
                        ],
                        [
                            'value' => '2',
                            'text' => '2'
                        ],
                        [
                            'value' => '3',
                            'text' => '3'
                        ],
                        [
                            'value' => '4',
                            'text' => '4'
                        ],
                        [
                            'value' => '5',
                            'text' => '5'
                        ],
                        [
                            'value' => '6',
                            'text' => '6'
                        ],
                        [
                            'value' => '7',
                            'text' => '7'
                        ],
                        [
                            'value' => '8',
                            'text' => '8'
                        ],
                        [
                            'value' => '9',
                            'text' => '9'
                        ],
                        [
                            'value' => '10',
                            'text' => '10'
                        ],
                        [
                            'value' => '11',
                            'text' => '11'
                        ],
                        [
                            'value' => '12',
                            'text' => '12'
                        ]
                    ]
                ],
                [
                    'question' => 'Berapa rata-rata pendapatan Anda per bulan? (take home pay)',
                    'type' => 'text',
                    'is_multiple' => false,
                    'is_required' => true,
                    'survey_id' => $survey->id
                ],
                [
                    'question' => 'Dimana lokasi tempat Anda bekerja?',
                    'type' => 'dropdown',
                    'is_multiple' => true,
                    'is_required' => true,
                    'survey_id' => $survey->id,
                    'sub_questions' => [
                        [
                            'question' => 'Provinsi',
                            'type' => 'dropdown',
                            'options' => [
                                [
                                    'value' => 'Nanggroe Aceh Darussalam',
                                    'text' => 'Nanggroe Aceh Darussalam (Ibu Kota Banda Aceh)'
                                ],
                                [
                                    'value' => 'Sumatera Utara',
                                    'text' => 'Sumatera Utara (Ibu Kota Medan)'
                                ],
                                [
                                    'value' => 'Sumatera Selatan',
                                    'text' => 'Sumatera Selatan (Ibu Kota Palembang)'
                                ],
                                [
                                    'value' => 'Sumatera Barat',
                                    'text' => 'Sumatera Barat (Ibu Kota Padang)'
                                ],
                                [
                                    'value' => 'Bengkulu',
                                    'text' => 'Bengkulu (Ibu Kota Bengkulu)'
                                ],
                                [
                                    'value' => 'Riau',
                                    'text' => 'Riau (Ibu Kota Pekanbaru)'
                                ],
                                [
                                    'value' => 'Kepulauan Riau',
                                    'text' => 'Kepulauan Riau (Ibu Kota Tanjung Pinang)'
                                ],
                                [
                                    'value' => 'Jambi',
                                    'text' => 'Jambi (Ibu Kota Jambi)'
                                ],
                                [
                                    'value' => 'Lampung',
                                    'text' => 'Lampung (Ibu Kota Bandar Lampung)'
                                ],
                                [
                                    'value' => 'Banka Belitung',
                                    'text' => 'Banka Belitung (Ibu Kota Pangkal Pinang)'
                                ],
                                [
                                    'value' => 'Kalimantan Barat',
                                    'text' => 'Kalimantan Barat (Ibu Kota Pontianak)'
                                ],
                                [
                                    'value' => 'Kalimantan Timur',
                                    'text' => 'Kalimantan Timur (Ibu Kota Samarinda)'
                                ],
                                [
                                    'value' => 'Kalimantan Selatan',
                                    'text' => 'Kalimantan Selatan (Ibu Kota Banjarbaru)'
                                ],
                                [
                                    'value' => 'Kalimantan Tengah',
                                    'text' => 'Kalimantan Tengah (Ibu Kota Palangkaraya)'
                                ],
                                [
                                    'value' => 'Kalimantan Utara',
                                    'text' => 'Kalimantan Utara (Ibu Kota Tanjung Selor)'
                                ],
                                [
                                    'value' => 'Banten',
                                    'text' => 'Banten (Ibu Kota Serang)'
                                ],
                                [
                                    'value' => 'DKI Jakarta',
                                    'text' => 'DKI Jakarta (Ibu Kota Jakarta)'
                                ],
                                [
                                    'value' => 'Jawa Barat',
                                    'text' => 'Jawa Barat (Ibu Kota Bandung)'
                                ],
                                [
                                    'value' => 'Jawa Tengah',
                                    'text' => 'Jawa Tengah (Ibu Kota Semarang)'
                                ],
                                [
                                    'value' => 'Daerah Istimewa Yogyakarta',
                                    'text' => 'Daerah Istimewa Yogyakarta (Ibu Kota Yogyakarta)'
                                ],
                                [
                                    'value' => 'Jawa Timur',
                                    'text' => 'Jawa Timur (Ibu Kota Surabaya)'
                                ],
                                [
                                    'value' => 'Bali',
                                    'text' => 'Bali (Ibu Kota Denpasar)'
                                ],
                                [
                                    'value' => 'Nusa Tenggara Timur',
                                    'text' => 'Nusa Tenggara Timur (Ibu Kota Kupang)'
                                ],
                                [
                                    'value' => 'Nusa Tenggara Barat',
                                    'text' => 'Nusa Tenggara Barat (Ibu Kota Mataram)'
                                ],
                                [
                                    'value' => 'Gorontalo',
                                    'text' => 'Gorontalo (Ibu Kota Gorontalo)'
                                ],
                                [
                                    'value' => 'Sulawesi Barat',
                                    'text' => 'Sulawesi Barat (Ibu Kota Mamuju)'
                                ],
                                [
                                    'value' => 'Sulawesi Tengah',
                                    'text' => 'Sulawesi Tengah (Ibu Kota Palu)'
                                ],
                                [
                                    'value' => 'Sulawesi Utara',
                                    'text' => 'Sulawesi Utara (Ibu Kota Manado)'
                                ],
                                [
                                    'value' => 'Sulawesi Tenggara',
                                    'text' => 'Sulawesi Tenggara (Ibu Kota Kendari)'
                                ],
                                [
                                    'value' => 'Sulawesi Selatan',
                                    'text' => 'Sulawesi Selatan (Ibu Kota Makassar)'
                                ],
                                [
                                    'value' => 'Maluku Utara',
                                    'text' => 'Maluku Utara (Ibu Kota Sofifi)'
                                ],
                                [
                                    'value' => 'Maluku',
                                    'text' => 'Maluku (Ibu Kota Ambon)'
                                ],
                                [
                                    'value' => 'Papua Barat',
                                    'text' => 'Papua Barat (Ibu Kota Manokwari)'
                                ],
                                [
                                    'value' => 'Papua',
                                    'text' => 'Papua (Ibu Kota Jayapura)'
                                ],
                                [
                                    'value' => 'Papua Tengah',
                                    'text' => 'Papua Tengah (Ibu Kota Nabire)'
                                ],
                                [
                                    'value' => 'Papua Pegunungan',
                                    'text' => 'Papua Pegunungan (Ibu Kota Jayawijaya)'
                                ],
                                [
                                    'value' => 'Papua Selatan',
                                    'text' => 'Papua Selatan (Ibu Kota Merauke)'
                                ],
                                [
                                    'value' => 'Papua Barat Daya',
                                    'text' => 'Papua Barat Daya (Ibu Kota Sorong)'
                                ]
                            ]
                        ],
                        [
                            'question' => 'Kota/Kabupaten',
                            'type' => 'dropdown',
                            'options' => [
                                [
                                    "Banda Aceh", "Sabang", "Lhokseumawe", "Langsa", "Aceh Besar", "Aceh Utara", "Aceh Timur", "Aceh Tamiang", "Bener Meriah", "Bireuen", "Gayo Lues", "Nagan Raya", "Pidie", "Pidie Jaya", "Simeulue", "Aceh Selatan", "Aceh Singkil", "Aceh Barat", "Aceh Jaya", "Aceh Tenggara", "Aceh Barat Daya", "Aceh Tengah", "Aceh Pidie", "Aceh Tenggara"
                                ]
                            ]
                        ],
                    ],
                ],
                [
                    'question' => 'Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?',
                    'type' => 'radio',
                    'is_multiple' => false,
                    'is_required' => true,
                    'survey_id' => $survey->id
                ],
                [
                    'question' => 'Apa nama perusahaan/kantor tempat Anda bekerja?',
                    'type' => 'text',
                    'is_multiple' => false,
                    'is_required' => true,
                    'survey_id' => $survey->id
                ],

                'Apa tingkat tempat kerja Anda?',
                'Seberapa erat hubungan bidang studi dengan pekerjaan Anda?',
                'Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat ini?',
                'Sebutkan sumber dana dalam pembiayaan kuliah?',
                'Pada saat lulus, pada tingkat mana kompetensi di bawah ini Anda kuasai?',
                'Pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan? (Skala 1-5)',
                'Menurut Anda seberapa besar penekanan pada metode pembelajaran di bawah ini dilaksanakan di program studi Anda?',
                'Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)',
                'Bagaimana Anda mencari pekerjaan tersebut?',
                'Berapa perusahaan/instansi/institusi yang sudah Anda lamar sebelum Anda memeroleh pekerjaan pertama?',
                'Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?',
                'Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?',
                'Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?',
                'Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?'
            ]
        }
    }
}