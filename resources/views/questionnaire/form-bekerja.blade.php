@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study - Bekerja')

@section('content')
<section class="questionnaire-section">
    <div class="container">
        <h2>Form Kuisioner - Bekerja</h2>
        <form action="{{ route('questionnaire.submit') }}" method="post">
            @csrf
            <input type="hidden" name="status" value="Bekerja">
            <div class="question-card">
                <h3>Dalam berapa bulan Anda mendapatkan pekerjaan pertama?</h3>
                <select name="question[1]['Dalam berapa bulan Anda mendapatkan pekerjaan pertama?']" required>
                    <option value="<1"><1</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>

            <div class="question-card">
                <h3>Berapa rata-rata pendapatan Anda per bulan? (take home pay)</h3>
                <div class="input-container">
                    <input type="text" name="question[2]['Berapa rata-rata pendapatan Anda per bulan? (take home pay)']" id="pendapatan" required oninput="formatCurrency(this)">
                </div>

                <script>
                    function formatCurrency(input) {
                        // Menghapus semua karakter selain angka dan titik
                        let value = input.value.replace(/[^0-9]/g, '');

                        // Format angka dengan titik sebagai pemisah ribuan
                        if (value) {
                            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }

                        // Menambahkan prefix "Rp" di depan
                        input.value = 'Rp ' + value;
                    }
                </script>
            </div>

            <div class="question-card">
                <h3>Dimana lokasi tempat Anda bekerja?</h3>
                <label>Provinsi</label>
                <select name="question[3]['Dimana lokasi tempat Anda bekerja?']['provinsi']" id="provinsi" required>
                    <option value="" disabled selected>Pilih Provinsi</option>
                    <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam (Ibu Kota Banda Aceh)</option>
                    <option value="Sumatera Utara">Sumatera Utara (Ibu Kota Medan)</option>
                    <option value="Sumatera Selatan">Sumatera Selatan (Ibu Kota Palembang)</option>
                    <option value="Sumatera Barat">Sumatera Barat (Ibu Kota Padang)</option>
                    <option value="Bengkulu">Bengkulu (Ibu Kota Bengkulu)</option>
                    <option value="Riau">Riau (Ibu Kota Pekanbaru)</option>
                    <option value="Kepulauan Riau">Kepulauan Riau (Ibu Kota Tanjung Pinang)</option>
                    <option value="Jambi">Jambi (Ibu Kota Jambi)</option>
                    <option value="Lampung">Lampung (Ibu Kota Bandar Lampung)</option>
                    <option value="Bangka Belitung">Bangka Belitung (Ibu Kota Pangkal Pinang)</option>
                    <option value="Kalimantan Barat">Kalimantan Barat (Ibu Kota Pontianak)</option>
                    <option value="Kalimantan Timur">Kalimantan Timur (Ibu Kota Samarinda)</option>
                    <option value="Kalimantan Selatan">Kalimantan Selatan (Ibu Kota Banjarbaru)</option>
                    <option value="Kalimantan Tengah">Kalimantan Tengah (Ibu Kota Palangkaraya)</option>
                    <option value="Kalimantan Utara">Kalimantan Utara (Ibu Kota Tanjung Selor)</option>
                    <option value="Banten">Banten (Ibu Kota Serang)</option>
                    <option value="DKI Jakarta">DKI Jakarta (Ibu Kota Jakarta)</option>
                    <option value="Jawa Barat">Jawa Barat (Ibu Kota Bandung)</option>
                    <option value="Jawa Tengah">Jawa Tengah (Ibu Kota Semarang)</option>
                    <option value="Daerah Istimewa Yogyakarta">Daerah Istimewa Yogyakarta (Ibu Kota Yogyakarta)</option>
                    <option value="Jawa Timur">Jawa Timur (Ibu Kota Surabaya)</option>
                    <option value="Bali">Bali (Ibu Kota Denpasar)</option>
                    <option value="Nusa Tenggara Timur">Nusa Tenggara Timur (Ibu Kota Kupang)</option>
                    <option value="Nusa Tenggara Barat">Nusa Tenggara Barat (Ibu Kota Mataram)</option>
                    <option value="Gorontalo">Gorontalo (Ibu Kota Gorontalo)</option>
                    <option value="Sulawesi Barat">Sulawesi Barat (Ibu Kota Mamuju)</option>
                    <option value="Sulawesi Tengah">Sulawesi Tengah (Ibu Kota Palu)</option>
                    <option value="Sulawesi Utara">Sulawesi Utara (Ibu Kota Manado)</option>
                    <option value="Sulawesi Tenggara">Sulawesi Tenggara (Ibu Kota Kendari)</option>
                    <option value="Sulawesi Selatan">Sulawesi Selatan (Ibu Kota Makassar)</option>
                    <option value="Maluku Utara">Maluku Utara (Ibu Kota Sofifi)</option>
                    <option value="Maluku">Maluku (Ibu Kota Ambon)</option>
                    <option value="Papua Barat">Papua Barat (Ibu Kota Manokwari)</option>
                    <option value="Papua">Papua (Ibu Kota Jayapura)</option>
                    <option value="Papua Tengah">Papua Tengah (Ibu Kota Nabire)</option>
                    <option value="Papua Pegunungan">Papua Pegunungan (Ibu Kota Jayawijaya)</option>
                    <option value="Papua Selatan">Papua Selatan (Ibu Kota Merauke)</option>
                    <option value="Papua Barat Daya">Papua Barat Daya (Ibu Kota Sorong)</option>
                </select>

                <label>Kota/Kabupaten</label>
                <select name="question[3]['Dimana lokasi tempat Anda bekerja?']['kota/kabupaten']" id="kabupaten" required>
                    <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                </select>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    // Data JSON Kabupaten/Kota per Provinsi
                    const data = {
                    "Nanggroe Aceh Darussalam": [
                    "Banda Aceh", "Sabang", "Lhokseumawe", "Langsa", "Aceh Besar", "Aceh Utara", "Aceh Timur", "Aceh Tamiang", "Bener Meriah", "Bireuen", "Gayo Lues", "Nagan Raya", "Pidie", "Pidie Jaya", "Simeulue", "Aceh Selatan", "Aceh Singkil", "Aceh Barat", "Aceh Jaya", "Aceh Tenggara", "Aceh Barat Daya", "Aceh Tengah", "Aceh Pidie", "Aceh Tenggara"
                    ],
                    "Sumatera Utara": [
                    "Medan", "Binjai", "Pematang Siantar", "Tanjung Balai", "Sibolga", "Langkat", "Deli Serdang", "Karo", "Simalungun", "Asahan", "Labuhanbatu", "Tapanuli Utara", "Tapanuli Selatan", "Tapanuli Tengah", "Humbang Hasundutan", "Pakpak Bharat", "Samosir", "Nias", "Mandailing Natal", "Karo", "Toba Samosir", "Langkat"
                    ],
                    "Sumatera Selatan": [
                    "Palembang", "Prabumulih", "Lubuklinggau", "Baturaja", "Muara Enim", "Lahat", "Musi Rawas", "Ogan Ilir", "Ogan Komering Ulu", "Ogan Komering Ulu Selatan", "Ogan Komering Ulu Timur", "Empat Lawang", "Penukal Abab Lematang Ilir", "Banyuasin"
                    ],
                    "Sumatera Barat": [
                    "Padang", "Bukittinggi", "Payakumbuh", "Solok", "Padang Panjang", "Pariaman", "Sijunjung", "Tanah Datar", "Pesisir Selatan", "Limapuluh Kota", "Agam", "Solok Selatan", "Dharmasraya", "Pasaman", "Pasaman Barat", "Kepulauan Mentawai"
                    ],
                    "Bengkulu": [
                    "Bengkulu", "Rejang Lebong", "Kepahiang", "Bengkulu Utara", "Bengkulu Selatan", "Muko Muko", "Lebong", "Seluma", "Kaur", "Tais"
                    ],
                    "Riau": [
                    "Pekanbaru", "Dumai", "Bengkalis", "Rokan Hilir", "Rokan Hulu", "Kampar", "Kuantan Singingi", "Indragiri Hilir", "Indragiri Hulu", "Pelalawan", "Siak", "Meranti", "Kepulauan Riau", "Natuna", "Anambas"
                    ],
                    "Kepulauan Riau": [
                    "Tanjung Pinang", "Batam", "Bintan", "Karimun", "Lingga", "Anambas", "Natuna"
                    ],
                    "Jambi": [
                    "Jambi", "Sungai Penuh", "Muaro Jambi", "Tebo", "Bungo", "Sarolangun", "Merangin", "Batanghari", "Tanjung Jabung Barat", "Tanjung Jabung Timur", "Kerinci", "Muara Tebo"
                    ],
                    "Lampung": [
                    "Bandar Lampung", "Metro", "Lampung Selatan", "Lampung Utara", "Tanggamus", "Pesawaran", "Pringsewu", "Way Kanan", "Tulang Bawang", "Tulang Bawang Barat", "Mesuji", "Pesisir Barat", "Lampung Timur", "Bandar Lampung", "Lamsel"
                    ],
                    "Bangka Belitung": [
                    "Pangkal Pinang", "Bangka", "Belitung", "Bangka Tengah", "Bangka Selatan", "Bangka Barat", "Belitung Timur", "Pangkal Pinang"
                    ],
                    "Kalimantan Barat": [
                    "Pontianak", "Singkawang", "Sambas", "Landak", "Mempawah", "Kubu Raya", "Sanggau", "Sekadau", "Kapuas Hulu", "Ketapang", "Melawi", "Bengkayang", "Pesisir Selatan"
                    ],
                    "Kalimantan Timur": [
                    "Samarinda", "Balikpapan", "Bontang", "Kutai Kartanegara", "Kutai Timur", "Penajam Paser Utara", "Mahakam Ulu", "Berau", "Paser"
                    ],
                    "Kalimantan Selatan": [
                    "Banjarbaru", "Banjarmasin", "Barito Kuala", "Tapin", "Hulu Sungai Selatan", "Hulu Sungai Tengah", "Hulu Sungai Utara", "Tanah Laut", "Tanah Bumbu", "Kotabaru"
                    ],
                    "Kalimantan Tengah": [
                    "Palangkaraya", "Katingan", "Kapuas", "Barito Selatan", "Barito Utara", "Lamandau", "Seruyan", "Sukamara", "Murung Raya", "Pulang Pisau"
                    ],
                    "Kalimantan Utara": [
                    "Tanjung Selor", "Nunukan", "Malinau", "Bulungan", "Tana Tidung", "Kutim"
                    ],
                    "Banten": [
                    "Serang", "Cilegon", "Tangerang", "Tangerang Selatan", "Lebak", "Pandeglang", "Serang"
                    ],
                    "DKI Jakarta": [
                    "Jakarta Pusat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Utara", "Jakarta Barat"
                    ],
                    "Jawa Barat": [
                    "Bandung", "Bekasi", "Bogor", "Depok", "Cirebon", "Tasikmalaya", "Sukabumi", "Garut", "Purwakarta", "Subang", "Majalengka", "Indramayu", "Ciamis", "Kuningan", "Banjar", "Sumedang", "Cianjur"
                    ],
                    "Jawa Tengah": [
                    "Semarang", "Solo", "Yogyakarta", "Salatiga", "Magelang", "Purwokerto", "Tegal", "Pekalongan", "Sragen", "Klaten", "Boyolali", "Karanganyar", "Temanggung", "Wonosobo", "Kebumen", "Cilacap", "Brebes", "Rembang"
                    ],
                    "Daerah Istimewa Yogyakarta": [
                    "Yogyakarta", "Bantul", "Sleman", "Gunung Kidul", "Kulon Progo"
                    ],
                    "Jawa Timur": [
                    "Surabaya", "Malang", "Madiun", "Probolinggo", "Kediri", "Blitar", "Banyuwangi", "Sidoarjo", "Pasuruan", "Tulungagung", "Lamongan", "Jember", "Situbondo", "Bondowoso", "Jombang", "Mojokerto", "Nganjuk", "Magetan"
                    ],
                    "Bali": [
                    "Denpasar", "Badung", "Buleleng", "Gianyar", "Tabanan", "Klungkung", "Bangli", "Karangasem", "Jembrana"
                    ],
                    "Nusa Tenggara Timur": [
                    "Kupang", "Maumere", "Ruteng", "Ende", "Larantuka", "Waingapu", "Atambua", "SoE", "Kefamenanu"
                    ],
                    "Nusa Tenggara Barat": [
                    "Mataram", "Bima", "Dompu", "Sumbawa", "Lombok Barat", "Lombok Timur"
                    ],
                    "Gorontalo": [
                    "Gorontalo", "Boalemo", "Bone Bolango", "Pohuwato", "Indramayu"
                    ],
                    "Sulawesi Barat": [
                    "Mamuju", "Majene", "Polewali Mandar", "Mamuju Tengah", "Mamasa"
                    ],
                    "Sulawesi Tengah": [
                    "Palu", "Donggala", "Sigi", "Parigi Moutong", "Morowali", "Tojo Una-Una"
                    ],
                    "Sulawesi Utara": [
                    "Manado", "Bitung", "Tomohon", "Minahasa", "Minahasa Utara", "Minahasa Selatan", "Bolaang Mongondow"
                    ],
                    "Sulawesi Tenggara": [
                    "Kendari", "Baubau", "Buton", "Kolaka", "Bombana", "Wakatobi"
                    ],
                    "Sulawesi Selatan": [
                    "Makassar", "Parepare", "Palopo", "Pinrang", "Barru", "Takalar", "Gowa", "Maros", "Pangkep", "Bone", "Soppeng", "Wajo", "Luwu", "Luwu Utara", "Luwu Timur"
                    ],
                    "Maluku Utara": [
                    "Sofifi", "Ternate", "Tidore", "Halmahera Utara", "Halmahera Barat"
                    ],
                    "Maluku": [
                    "Ambon", "Tual", "Saumlaki", "Langgur", "Dobo", "Namlea", "Masohi", "Bula", "Kairatu"
                    ],
                    "Papua Barat": [
                    "Manokwari", "Sorong", "Fakfak", "Raja Ampat", "Kaimana", "Teluk Bintuni"
                    ],
                    "Papua": [
                    "Jayapura", "Merauke", "Timika", "Sorong", "Manokwari", "Biak", "Nabire", "Wamena", "Jayawijaya", "Keerom"
                    ],
                    "Papua Tengah": [
                    "Nabire", "Paniai", "Mamberamo Raya", "Dogiyai", "Intan Jaya"
                    ],
                    "Papua Pegunungan": [
                    "Jayawijaya", "Yalimo", "Puncak", "Mamberamo Tengah", "Lanny Jaya"
                    ],
                    "Papua Selatan": [
                    "Merauke", "Boven Digoel", "Mappi", "Asmat"
                    ],
                    "Papua Barat Daya": [
                    "Sorong", "Maybrat", "Tambrauw", "Kaimana"
                    ]
                    };

                    // Event listener untuk perubahan Provinsi
                    $('#provinsi').change(function() {
                        var provinsi = $(this).val(); // Get the selected province
                        var kabupatenSelect = $('#kabupaten');

                        // Kosongkan daftar kota/kabupaten
                        kabupatenSelect.empty();

                        // Menambahkan opsi default
                        kabupatenSelect.append('<option value="" disabled selected>Pilih Kota/Kabupaten</option>');

                        // Mengecek apakah provinsi ada dalam data JSON
                        if (data[provinsi]) {
                            // Menambahkan kota/kabupaten ke dropdown
                            data[provinsi].forEach(function(kabupaten) {
                                kabupatenSelect.append('<option value="' + kabupaten + '">' + kabupaten + '</option>');
                            });
                        }
                    });
                </script>
        </div>

        <div class="question-card">
            <h3>Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?</h3>
            @foreach ([
                'Instansi pemerintah',
                'Organisasi non-profit/Lembaga Swadaya Masyarakat',
                'Perusahaan swasta',
                'Wiraswasta/perusahaan sendiri',
                'BUMN/BUMD',
                'Institusi/Organisasi Multilateral',
                'Lainnya'
            ] as $jenis_perusahaan)
                <div>
                    <label>
                        <input type="radio" name="question[4]['Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?']" value="{{ $jenis_perusahaan }}" class="jenis_perusahaan"
                            id="{{ $jenis_perusahaan === 'Lainnya' ? 'option_lainnya_4' : '' }}">
                        {{ $jenis_perusahaan }}
                    </label>
                </div>
            @endforeach
            <div id="input_lainnya_container_4" style="display: none; margin-top: 10px;">
                <input type="text" name="" id="input_lainnya_4" placeholder="Tuliskan lainnya..." style="width: 100%; padding: 8px;">
            </div>
            <script>
                $(document).ready(function () {
                    const $radioButtons = $("input.jenis_perusahaan");
                    const $inputLainnya = $("#input_lainnya_4");
                    const $inputLainnyaContainer = $("#input_lainnya_container_4");

                    $radioButtons.on("change", function () {
                        if ($("#option_lainnya_4").is(":checked")) {
                            $inputLainnyaContainer.show();
                            $inputLainnya.attr("name", "question[4]['Apa jenis perusahaan/instansi/institusi tempat Anda bekerja sekarang?']");
                        } else {
                            $inputLainnyaContainer.hide();
                            $inputLainnya.attr("name", "");
                        }
                    });
                });
            </script>
        </div>

        <div class="question-card">
            <h3>Apa nama perusahaan/kantor tempat Anda bekerja?</h3>
            <input type="text" name="question[5]['Apa nama perusahaan/kantor tempat Anda bekerja?']" required>
        </div>

        <div class="question-card">
            <h3>Apa tingkat tempat kerja Anda?</h3>
            <select name="question[6]['Apa tingkat tempat kerja Anda?']" required>
                <option value="lokal">Lokal/Wilayah/Wiraswasta tidak berbadan hukum</option>
                <option value="nasional">Nasional/Wiraswasta berbadan hukum</option>
                <option value="multinasional">Multinasional/Internasional</option>
            </select>
        </div>

        <div class="question-card">
            <h3>Seberapa erat hubungan bidang studi dengan pekerjaan Anda?</h3>
            <div>
                <label>
                    <input type="radio" name="question[7]['Seberapa erat hubungan bidang studi dengan pekerjaan Anda?']" value="Sangat Erat" required> Sangat Erat
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[7]['Seberapa erat hubungan bidang studi dengan pekerjaan Anda?']" value="Erat" required> Erat
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[7]['Seberapa erat hubungan bidang studi dengan pekerjaan Anda?']" value="Cukup Erat" required> Cukup Erat
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[7]['Seberapa erat hubungan bidang studi dengan pekerjaan Anda?']" value="Kurang Erat" required> Kurang Erat
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[7]['Seberapa erat hubungan bidang studi dengan pekerjaan Anda?']" value="Tidak Sama Sekali" required> Tidak Sama Sekali
                </label>
            </div>
        </div>

        <div class="question-card">
            <h3>Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat ini?</h3>
            <div>
                <label>
                    <input type="radio" name="question[8]['Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat ini?']" value="Setingkat Lebih Tinggi" required> Setingkat Lebih Tinggi
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[8]['Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat ini?']" value="Tingkat yang Sama" required> Tingkat yang Sama
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[8]['Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat ini?']" value="Setingkat Lebih Rendah" required> Setingkat Lebih Rendah
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[8]['Tingkat pendidikan apa yang paling tepat/sesuai untuk pekerjaan Anda saat ini?']" value="Tidak Perlu Pendidikan Tinggi" required> Tidak Perlu Pendidikan Tinggi
                </label>
            </div>
        </div>

        <div class="question-card">
            <h3>Sebutkan sumber dana dalam pembiayaan kuliah?</h3>
            @foreach ([
                'Biaya Sendiri/Keluarga',
                'Beasiswa ADIK',
                'Beasiswa BIDIKMISI',
                'Beasiswa PPA',
                'Beasiswa AFIRMASI',
                'Beasiswa Perusahaan/Swasta',
                'Lainnya'
            ] as $sumber_dana)
            <div>
                <label>
                    <input type="radio" name="question[9]['Sebutkan sumber dana dalam pembiayaan kuliah?']" value="{{ $sumber_dana }}" class="sumber_dana"
                        id="{{ $sumber_dana === 'Lainnya' ? 'option_lainnya_17' : '' }}">
                    {{ $sumber_dana }}
                </label>
            </div>
            @endforeach
            <div id="input_lainnya_container_17" style="display: none; margin-top: 10px;">
                <input type="text" name="question[9]['Sebutkan sumber dana dalam pembiayaan kuliah?']" id="input_lainnya_17" placeholder="Tuliskan lainnya..." style="width: 100%; padding: 8px;">
            </div>
            <script>
                $(document).ready(function () {
                        const $radioButtons = $("input.sumber_dana");
                        const $inputLainnya = $("#input_lainnya_17");
                        const $inputLainnyaContainer = $("#input_lainnya_container_17");

                        $radioButtons.on("change", function () {
                            if ($("#option_lainnya_17").is(":checked")) {
                                $inputLainnyaContainer.show();
                                $inputLainnya.attr("name", "question[9]['Sebutkan sumber dana dalam pembiayaan kuliah?']");
                            } else {
                                $inputLainnyaContainer.hide();
                                $inputLainnya.attr("name", "");
                            }
                        });
                    });
            </script>
        </div>

        <div class="question-card" style="display: flex; gap: 20px;">
            <!-- Kolom Kiri -->
            <div style="flex: 1;">
                <h3>Pada saat lulus, pada tingkat mana kompetensi di bawah ini Anda kuasai?</h3>
                @foreach (['Etika', 'Keahlian Berdasarkan Bidang Ilmu', 'Bahasa Inggris', 'Penggunaan Teknologi Informasi', 'Komunikasi', 'Kerjasama Tim', 'Pengelolaan Waktu'] as $kompetensi)
                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold;">{{ $kompetensi }}</label>
                        <div style="display: flex; gap: 10px; margin-top: 5px;">
                            @for ($i = 1; $i <= 5; $i++)
                            <label style="font-weight: normal;">
                                <input type="radio" name="question[10]['Pada saat lulus, pada tingkat mana kompetensi di bawah ini Anda kuasai?']['kompetensi_lulus_{{ strtolower(str_replace(' ', '_', $kompetensi)) }}']" value="{{ $i }}" required> {{ $i }}
                            </label>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Kolom Kanan -->
            <div style="flex: 1;">
                <h3>Pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan? (Skala 1-5)</h3>
                @foreach (['Etika', 'Keahlian Berdasarkan Bidang Ilmu', 'Bahasa Inggris', 'Penggunaan Teknologi Informasi', 'Komunikasi', 'Kerjasama Tim', 'Pengembangan'] as $kompetensi)
                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold;">{{ $kompetensi }}</label>
                        <div style="display: flex; gap: 10px; margin-top: 5px;">
                            @for ($i = 1; $i <= 5; $i++)
                                <label style="font-weight: normal;">
                                    <input type="radio" name="question[11]['Pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan? (Skala 1-5)']['kompetensi_pekerjaan_{{ strtolower(str_replace(' ', '_', $kompetensi)) }}']" value="{{ $i }}" required> {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="question-card">
            <h3>Menurut Anda seberapa besar penekanan pada metode pembelajaran di bawah ini dilaksanakan di program studi Anda?</h3>
            @foreach (['Perkuliahan', 'Demonstrasi', 'Partisipasi dalam Proyek Riset', 'Magang', 'Praktikum', 'Kerja Lapangan', 'Diskusi'] as $metode)
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold;">{{ $metode }}</label>
                    <div style="display: flex; gap: 15px; margin-top: 5px;">
                        @foreach (['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak Sama Sekali'] as $opsi)
                            <label style="font-weight: normal;">
                                <input type="radio" name="question[12]['Menurut Anda seberapa besar penekanan pada metode pembelajaran di bawah ini dilaksanakan di program studi Anda?']['metode_{{ strtolower(str_replace(' ', '_', $metode)) }}']" value="{{ $opsi }}" required> {{ $opsi }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pertanyaan 13 -->
        <div class="question-card">
            <h3>Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)</h3>
            <div>
                <label>
                    <input type="radio" name="question[13]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="sebelum_lulus" class="radio-option_13" required>
                    Kira-kira <select id="bulan_sebelum_lulus" class="select_13" style="width: 80px;" disabled>
                    <option value="" disabled selected>Pilih</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    </select> bulan sebelum lulus
                </label>
            </div>

            <div>
                <label>
                    <input type="radio" name="question[13]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="sesudah_lulus" class="radio-option_13" required>
                    Kira-kira <select id="bulan_sesudah_lulus" class="select_13" style="width: 80px;" disabled>
                    <option value="" disabled selected>Pilih</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    </select> bulan sesudah lulus
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="question[13]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="tidak_mencari" class="radio-option_13" required>
                    Saya tidak mencari kerja
                </label>
            </div>
            <input type="hidden" id="final_answer" name="question[13]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="">
            <script>
                $(document).ready(function () {
                    $(".radio-option_13").on("change", function () {
                        const selectedValue = $(this).val();

                        $(".select_13").prop("disabled", true).val("");

                        let finalAnswer = "";
                        if (selectedValue === "sebelum_lulus") {
                            $("#bulan_sebelum_lulus").prop("disabled", false);
                        } else if (selectedValue === "sesudah_lulus") {
                            $("#bulan_sesudah_lulus").prop("disabled", false);
                        } else {
                            finalAnswer = "Saya tidak mencari kerja";
                        }
                        $("#final_answer").val(finalAnswer);
                    });

                    $(".select_13").on("change", function () {
                        const selectedRadio = $(".radio-option_13:checked").val();
                        const selectedMonth = $(this).val();
                        let finalAnswer = "";

                        if (selectedRadio === "sebelum_lulus") {
                            finalAnswer = `Kira-kira ${selectedMonth} bulan sebelum lulus`;
                        } else if (selectedRadio === "sesudah_lulus") {
                            finalAnswer = `Kira-kira ${selectedMonth} bulan sesudah lulus`;
                        }

                        $("#final_answer").val(finalAnswer);
                    });
                });
            </script>
        </div>

        <!-- Pertanyaan 14 -->
        <div class="question-card">
            <h3>Bagaimana Anda mencari pekerjaan tersebut?</h3>
            @foreach ([
                'Melalui iklan di koran/majalah, brosur',
                'Melamar ke perusahaan tanpa mengetahui lowongan yang ada',
                'Pergi ke bursa/pameran kerja',
                'Mencari lewat internet/iklan online/milis',
                'Dihubungi oleh perusahaan',
                'Menghubungi Kemenakertrans',
                'Menghubungi agen tenaga kerja komersial/swasta',
                'Memeroleh informasi dari pusat/kantor pengembangan karir fakultas/universitas',
                'Menghubungi kantor kemahasiswaan/hubungan alumni',
                'Membangun jejaring (network) sejak masih kuliah',
                'Melalui relasi (misalnya dosen, orang tua, saudara, teman, dll.)',
                'Membangun bisnis sendiri',
                'Melalui penempatan kerja atau magang',
                'Bekerja di tempat yang sama dengan tempat kerja semasa kuliah',
                'Lainnya'
            ] as $cara_cari_kerja)
            <div>
                <label>
                    <input type="radio" name="question[14]['Bagaimana Anda mencari pekerjaan tersebut?']" value="{{ $cara_cari_kerja }}" class="cari_kerja"
                        id="{{ $cara_cari_kerja === 'Lainnya' ? 'option_lainnya_14' : '' }}">
                    {{ $cara_cari_kerja }}
                </label>
            </div>
            @endforeach

            <!-- Input untuk jawaban "Lainnya" -->
            <div id="input_lainnya_container_14" style="display: none; margin-top: 10px;">
                <input type="text" name="question[14]['Bagaimana Anda mencari pekerjaan tersebut?']" id="input_lainnya_14" placeholder="Tuliskan jawaban Anda..." style="width: 100%; padding: 8px;">
            </div>
            <script>
                $(document).ready(function () {
                    // Radio buttons group
                    const $radioButtons = $("input.cari_kerja");
                    const $inputLainnya = $("#input_lainnya_14");
                    const $inputLainnyaContainer = $("#input_lainnya_container_14");

                    // On change event for radio buttons
                    $radioButtons.on("change", function () {
                        if ($("#option_lainnya_14").is(":checked")) {
                            $inputLainnyaContainer.show(); // Show input "Lainnya"
                            $inputLainnya.attr("name", "question[14]['Bagaimana Anda mencari pekerjaan tersebut?']"); // Set name for "Lainnya"
                        } else {
                            $inputLainnyaContainer.hide(); // Hide input "Lainnya"
                            $inputLainnya.attr("name", ""); // Remove name if not selected
                        }
                    });
                });
            </script>
        </div>

        <!-- Pertanyaan 15-17 -->
        <div class="question-card">
            <h3>Berapa perusahaan/instansi/institusi yang sudah Anda lamar sebelum Anda memeroleh pekerjaan pertama?</h3>
            <input type="number" name="question[15]['Berapa perusahaan/instansi/institusi yang sudah Anda lamar sebelum Anda memeroleh pekerjaan pertama?']" min="0" required>
        </div>

        <div class="question-card">
            <h3>Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?</h3>
            <input type="number" name="question[16]['Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?']" min="0" required>
        </div>

        <div class="question-card">
            <h3>Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?</h3>
            <input type="number" name="question[17]['Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?']" min="0" required>
        </div>

        <!-- Pertanyaan 18 -->
        <div class="question-card">
            <h3>Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?</h3>
            @foreach ([
                'Tidak',
                'Tidak, tapi saya sedang menunggu hasil lamaran kerja',
                'Ya, saya akan mulai bekerja dalam 2 minggu ke depan',
                'Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan',
                'Lainnya'
            ] as $status_cari_pekerjaan)
            <div>
                <label>
                    <input type="radio"
                        name="question[18]['Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?']"
                        value="{{ $status_cari_pekerjaan }}"
                        id="{{ $status_cari_pekerjaan === 'Lainnya' ? 'option_lainnya_18' : '' }}"
                        class="aktif_mencari"
                        required>
                    {{ $status_cari_pekerjaan }}
                </label>
            </div>
            @endforeach
            <!-- Input untuk jawaban "Lainnya" -->
            <div id="input_lainnya_container_18" style="display: none; margin-top: 10px;">
                <input type="text"
                    name="question[18]['Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?']"
                    id="input_lainnya_18"
                    placeholder="Tuliskan jawaban Anda..."
                    style="width: 100%; padding: 8px;">
            </div>
            <script>
                $(document).ready(function () {
                // Radio buttons group
                const $radioButtons = $("input.aktif_mencari");
                const $inputLainnya = $("#input_lainnya_18");
                const $inputLainnyaContainer = $("#input_lainnya_container_18");

                // On change event for radio buttons
                $radioButtons.on("change", function () {
                    if ($("#option_lainnya_18").is(":checked")) {
                        $inputLainnyaContainer.show(); // Show input "Lainnya"
                        $inputLainnya.attr("name", "question[18]['Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?']"); // Set name for "Lainnya"
                    } else {
                        $inputLainnyaContainer.hide(); // Hide input "Lainnya"
                        $inputLainnya.attr("name", ""); // Remove name if not selected
                    }
                });
            });
            </script>
        </div>

        <!-- Pertanyaan 19 -->
        <div class="question-card">
            <h3>Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?</h3>
            @foreach ([
                'Pertanyaan tidak sesuai; pekerjaan saya sekarang sudah sesuai dengan pendidikan saya.',
                'Saya belum mendapatkan pekerjaan yang lebih sesuai.',
                'Di pekerjaan ini saya memeroleh prospek karir yang baik.',
                'Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya.',
                'Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya.',
                'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini.',
                'Pekerjaan saya saat ini lebih aman/terjamin/secure.',
                'Pekerjaan saya saat ini lebih menarik.',
                'Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll.',
                'Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya.',
                'Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya.',
                'Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya.',
                'Lainnya'
            ] as $alasan_kerja)
            <div>
                <label>
                    <input type="radio"
                        name="question[19]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"
                        class="tidak_sesuai"
                        value="{{ $alasan_kerja }}"
                        id="{{ $alasan_kerja === 'Lainnya' ? 'option_lainnya_19' : '' }}"
                        required>
                    {{ $alasan_kerja }}
                </label>
            </div>
            @endforeach
            <div id="input_lainnya_container_19" style="display: none; margin-top: 10px;">
                <input type="text"
                    name="question[19]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"
                    id="input_lainnya_19"
                    placeholder="Tuliskan jawaban Anda..."
                    style="width: 100%; padding: 8px;">
            </div>
            <script>
                $(document).ready(function () {
                const $radioButtons = $("input.tidak_sesuai");
                const $inputLainnya = $("#input_lainnya_19");
                const $inputLainnyaContainer = $("#input_lainnya_container_19");

                $radioButtons.on("change", function () {
                    if ($("#option_lainnya_19").is(":checked")) {
                        $inputLainnyaContainer.show();
                        $inputLainnya.attr("name", "question[19]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"); // Set name for "Lainnya"
                    } else {
                        $inputLainnyaContainer.hide();
                        $inputLainnya.attr("name", "");
                    }
                });
            });
            </script>
        </div>

        <button type="submit">Kirim</button>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const radioButtons = document.querySelectorAll('input[type="radio"]');

                // Loop untuk semua radio button
                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function () {
                        const parentDiv = this.closest('.question-card'); // Mendapatkan div yang mengandung pertanyaan
                        const inputLainnyaContainer = parentDiv.querySelector('[id^="input_lainnya_container"]');
                        const inputLainnya = parentDiv.querySelector('[id^="input_lainnya"]');

                        // Cek apakah opsi yang dipilih adalah "Lainnya"
                        if (this.value === 'Lainnya') {
                            inputLainnyaContainer.style.display = 'block'; // Tampilkan input teks
                            inputLainnya.required = true; // Jadikan input teks wajib
                        } else {
                            inputLainnyaContainer.style.display = 'none'; // Sembunyikan input teks
                            inputLainnya.value = ''; // Hapus nilai input jika opsi lain dipilih
                            inputLainnya.required = false; // Hapus keharusan input teks
                        }
                    });
                });
            });
        </script>
    </form>
    </div>
</section>
@endsection
