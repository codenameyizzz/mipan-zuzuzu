@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study - Wiraswasta')

@section('content')
<style>
    .questionnaire-section {
        text-align: left; /* Mengatur teks menjadi rata kiri */
    }
    .question-card {
        margin-bottom: 20px; /* Menambahkan jarak antar pertanyaan */
    }
    input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    display: inline-block;
    width: 16px;
    height: 16px;
    margin: 0 5px;
    border: 2px solid #007BFF;
    border-radius: 50%;
    outline: none;
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease;
}

input[type="radio"]:checked {
    background-color: #007BFF;
    border-color: #0056b3;
}

</style>

<section class="questionnaire-section">
    <div class="container">
        <h2>Form Kuisioner - Wiraswasta</h2>
        <form action="{{ route('questionnaire.submit') }}" method="post">
            @csrf
            <input type="hidden" name="status" value="Wiraswasta">
            <!-- Pertanyaan Wiraswasta -->
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
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            <!-- Pertanyaan Sumber Dana -->
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
                        <input type="radio" name="question[3]['Sebutkan sumber dana dalam pembiayaan kuliah?']" value="{{ $sumber_dana }}" class="sumber_dana"
                            id="{{ $sumber_dana === 'Lainnya' ? 'option_lainnya_3' : '' }}">
                        {{ $sumber_dana }}
                    </label>
                </div>
                @endforeach
                <div id="input_lainnya_container_3" style="display: none; margin-top: 10px;">
                    <input type="text" name="question[3]['Sebutkan sumber dana dalam pembiayaan kuliah?']['lainnya']" id="input_lainnya_3" placeholder="Tuliskan lainnya..." style="width: 100%; padding: 8px;">
                </div>
                <script>
                    $(document).ready(function () {
                            const $radioButtons = $("input.sumber_dana");
                            const $inputLainnya = $("#input_lainnya_3");
                            const $inputLainnyaContainer = $("#input_lainnya_container_3");

                            $radioButtons.on("change", function () {
                                if ($("#option_lainnya_3").is(":checked")) {
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
                                    <input type="radio" name="question[4]['Pada saat lulus, pada tingkat mana kompetensi di bawah ini Anda kuasai?']['kompetensi_lulus_{{ strtolower(str_replace(' ', '_', $kompetensi)) }}']" value="{{ $i }}" required> {{ $i }}
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
                                        <input type="radio" name="question[5]['Pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan? (Skala 1-5)']['kompetensi_pekerjaan_{{ strtolower(str_replace(' ', '_', $kompetensi)) }}']" value="{{ $i }}" required> {{ $i }}
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
                                    <input type="radio" name="question[6]['Menurut Anda seberapa besar penekanan pada metode pembelajaran di bawah ini dilaksanakan di program studi Anda?']['metode_{{ strtolower(str_replace(' ', '_', $metode)) }}']" value="{{ $opsi }}" required> {{ $opsi }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="question-card">
                <h3>Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)</h3>
                <div>
                    <label>
                        <input type="radio" name="question[7]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="sebelum_lulus" class="radio-option_7" required>
                        Kira-kira <select id="bulan_sebelum_lulus" class="select_7" style="width: 80px;" disabled>
                        <option value="" disabled selected>Pilih</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        </select> bulan sebelum lulus
                    </label>
                </div>

                <div>
                    <label>
                        <input type="radio" name="question[7]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="sesudah_lulus" class="radio-option_7" required>
                        Kira-kira <select id="bulan_sesudah_lulus" class="select_7" style="width: 80px;" disabled>
                        <option value="" disabled selected>Pilih</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        </select> bulan sesudah lulus
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="question[7]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="tidak_mencari" class="radio-option_7" required>
                        Saya tidak mencari kerja
                    </label>
                </div>
                <input type="hidden" id="final_answer" name="question[7]['Kapan Anda mulai mencari pekerjaan? (Mohon pekerjaan sambilan tidak dimasukkan)']" value="">
                <script>
                    $(document).ready(function () {
                        $(".radio-option_7").on("change", function () {
                            const selectedValue = $(this).val();

                            $(".select_7").prop("disabled", true).val("");

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

                        $(".select_7").on("change", function () {
                            const selectedRadio = $(".radio-option_7:checked").val();
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

            <!-- Cara Mencari Pekerjaan -->
            <div class="question-card">
                <h3>Bagaimana Anda mencari pekerjaan tersebut? (Jawaban bisa lebih dari satu)</h3>
                @foreach ([
                    'Melalui iklan di koran/majalah, brosur',
                    'Melamar ke perusahaan tanpa mengetahui lowongan yang ada',
                    'Pergi ke bursa/pameran kerja',
                    'Mencari lewat internet/iklan online/milis',
                    'Dihubungi oleh perusahaan',
                    'Menghubungi Kemenakertrans',
                    'Menghubungi agen tenaga kerja komersial/swasta',
                    'Memperoleh informasi dari pusat/kantor pengembangan karir fakultas/universitas',
                    'Menghubungi kantor kemahasiswaan/hubungan alumni',
                    'Membangun jejaring (network) sejak masih kuliah',
                    'Melalui relasi (misalnya dosen, orang tua, saudara, teman, dll.)',
                    'Membangun bisnis sendiri',
                    'Melalui penempatan kerja atau magang',
                    'Bekerja di tempat yang sama dengan tempat kerja semasa kuliah',
                    'Lainnya'
                ] as $cara)
                    <label><input type="checkbox" name="question[8]['Bagaimana Anda mencari pekerjaan tersebut?'][]" value="{{ $cara }}"> {{ $cara }}</label><br>
                @endforeach
            </div>

            <!-- Jumlah Perusahaan yang Dilamar -->
            <div class="question-card">
                <h3>Berapa perusahaan/instansi/institusi yang sudah Anda lamar (lewat surat atau e-mail) sebelum Anda memperoleh pekerjaan pertama?</h3>
                <input type="number" name="question[9]['Berapa perusahaan/instansi/institusi yang sudah Anda lamar (lewat surat atau e-mail) sebelum Anda memperoleh pekerjaan pertama?']" required>
            </div>

            <!-- Jumlah Respon yang Diterima -->
            <div class="question-card">
                <h3>Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?</h3>
                <input type="number" name="question[10]['Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?']" required>
            </div>

            <!-- Jumlah Wawancara yang Diundang -->
            <div class="question-card">
                <h3>Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?</h3>
                <input type="number" name="question[11]['Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?']" required>
            </div>

            <!-- Apakah Aktif Mencari Pekerjaan -->
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
                            name="question[12]['Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?']"
                            value="{{ $status_cari_pekerjaan }}"
                            id="{{ $status_cari_pekerjaan === 'Lainnya' ? 'option_lainnya_12' : '' }}"
                            class="aktif_mencari"
                            required>
                        {{ $status_cari_pekerjaan }}
                    </label>
                </div>
                @endforeach
                <!-- Input untuk jawaban "Lainnya" -->
                <div id="input_lainnya_container_12" style="display: none; margin-top: 10px;">
                    <input type="text"
                        name="question[12]['Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?']"
                        id="input_lainnya_12"
                        placeholder="Tuliskan jawaban Anda..."
                        style="width: 100%; padding: 8px;">
                </div>
                <script>
                    $(document).ready(function () {
                        // Radio buttons group
                        const $radioButtons = $("input.aktif_mencari");
                        const $inputLainnya = $("#input_lainnya_12");
                        const $inputLainnyaContainer = $("#input_lainnya_container_12");

                        // On change event for radio buttons
                        $radioButtons.on("change", function () {
                            if ($("#option_lainnya_12").is(":checked")) {
                                $inputLainnyaContainer.show(); // Show input "Lainnya"
                                $inputLainnya.attr("name", "question[12]['Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?']"); // Set name for "Lainnya"
                            } else {
                                $inputLainnyaContainer.hide(); // Hide input "Lainnya"
                                $inputLainnya.attr("name", ""); // Remove name if not selected
                            }
                        });
                    });
                </script>
            </div>

            <!-- Pertanyaan 13 -->
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
                            name="question[13]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"
                            class="tidak_sesuai"
                            value="{{ $alasan_kerja }}"
                            id="{{ $alasan_kerja === 'Lainnya' ? 'option_lainnya_13' : '' }}"
                            required>
                        {{ $alasan_kerja }}
                    </label>
                </div>
                @endforeach
                <div id="input_lainnya_container_13" style="display: none; margin-top: 10px;">
                    <input type="text"
                        name="question[13]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"
                        id="input_lainnya_13"
                        placeholder="Tuliskan jawaban Anda..."
                        style="width: 100%; padding: 8px;">
                </div>
                <script>
                    $(document).ready(function () {
                        const $radioButtons = $("input.tidak_sesuai");
                        const $inputLainnya = $("#input_lainnya_13");
                        const $inputLainnyaContainer = $("#input_lainnya_container_13");

                        $radioButtons.on("change", function () {
                            if ($("#option_lainnya_13").is(":checked")) {
                                $inputLainnyaContainer.show();
                                $inputLainnya.attr("name", "question[13]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"); // Set name for "Lainnya"
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
