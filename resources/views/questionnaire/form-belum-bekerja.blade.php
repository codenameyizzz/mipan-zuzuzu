@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study')

@section('content')
<style>
    .questionnaire-section {
        text-align: left;
    }
    .question-card {
        margin-bottom: 20px;
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
        <h2>Form Kuisioner - Tracer Study</h2>
        <form action="{{ route('questionnaire.submit') }}" method="post">
            @csrf
            <input type="hidden" name="status" value="Belum memungkinkan bekerja">
            <!-- Pertanyaan 1 -->
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
                        <input type="radio" name="question[1]['Sebutkan sumber dana dalam pembiayaan kuliah?']" value="{{ $sumber_dana }}" class="sumber_dana"
                            id="{{ $sumber_dana === 'Lainnya' ? 'option_lainnya_1' : '' }}">
                        {{ $sumber_dana }}
                    </label>
                </div>
                @endforeach
                <div id="input_lainnya_container_1" style="display: none; margin-top: 10px;">
                    <input type="text" name="question[1]['Sebutkan sumber dana dalam pembiayaan kuliah?']['lainnya']" id="input_lainnya_1" placeholder="Tuliskan lainnya..." style="width: 100%; padding: 8px;">
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                            const $radioButtons = $("input.sumber_dana");
                            const $inputLainnya = $("#input_lainnya_1");
                            const $inputLainnyaContainer = $("#input_lainnya_container_1");

                            $radioButtons.on("change", function () {
                                if ($("#option_lainnya_1").is(":checked")) {
                                    $inputLainnyaContainer.show();
                                    $inputLainnya.attr("name", "question[1]['Sebutkan sumber dana dalam pembiayaan kuliah?']");
                                } else {
                                    $inputLainnyaContainer.hide();
                                    $inputLainnya.attr("name", "");
                                }
                            });
                        });
                </script>
            </div>

            <!-- Pertanyaan 2 - 3 -->
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
                                    <input type="radio" name="question[2]['Pada saat lulus, pada tingkat mana kompetensi di bawah ini Anda kuasai?']['kompetensi_lulus_{{ strtolower(str_replace(' ', '_', $kompetensi)) }}']" value="{{ $i }}" required> {{ $i }}
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
                                        <input type="radio" name="question[3]['Pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan? (Skala 1-5)']['kompetensi_pekerjaan_{{ strtolower(str_replace(' ', '_', $kompetensi)) }}']" value="{{ $i }}" required> {{ $i }}
                                    </label>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pertanyaan 4 -->
            <div class="question-card">
                <h3>Menurut Anda, seberapa besar penekanan pada metode pembelajaran di bawah ini dilaksanakan di program studi Anda?</h3>
                @foreach ([
                    'Perkuliahan',
                    'Demonstrasi',
                    'Partisipasi dalam Proyek Riset',
                    'Magang',
                    'Praktikum',
                    'Kerja Lapangan',
                    'Diskusi'
                ] as $metode)
                    <label style="font-weight: bold;">{{ $metode }}</label>
                    <div style="display: flex; gap: 10px; margin-top: 5px;">
                        @foreach (['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak Sama Sekali'] as $opsi)
                            <label>
                                <input type="radio" name="question[4]['Menurut Anda, seberapa besar penekanan pada metode pembelajaran di bawah ini dilaksanakan di program studi Anda?']['metode_{{ strtolower(str_replace(' ', '_', $metode)) }}']" value="{{ $opsi }}" required> {{ $opsi }}
                            </label>
                        @endforeach
                    </div>
                    <br>
                @endforeach
            </div>

            <!-- Pertanyaan 5 -->
            <div class="question-card">
                <h3>Kapan Anda mulai mencari pekerjaan?</h3>
                <div>
                    <label>
                        <input type="radio" name="question[5]['Kapan Anda mulai mencari pekerjaan?']" value="sebelum_lulus" class="radio-option_4" required>
                        Kira-kira <select id="bulan_sebelum_lulus" class="select_4" style="width: 80px;" disabled>
                        <option value="" disabled selected>Pilih</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        </select> bulan sebelum lulus
                    </label>
                </div>

                <div>
                    <label>
                        <input type="radio" name="question[5]['Kapan Anda mulai mencari pekerjaan?']" value="sesudah_lulus" class="radio-option_5" required>
                        Kira-kira <select id="bulan_sesudah_lulus" class="select_5" style="width: 80px;" disabled>
                        <option value="" disabled selected>Pilih</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        </select> bulan sesudah lulus
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="question[5]['Kapan Anda mulai mencari pekerjaan?']" value="tidak_mencari" class="radio-option_5" required>
                        Saya tidak mencari kerja
                    </label>
                </div>
                <input type="hidden" id="final_answer" name="question[5]['Kapan Anda mulai mencari pekerjaan?']" value="">
                <script>
                    $(document).ready(function () {
                        $(".radio-option_5").on("change", function () {
                            const selectedValue = $(this).val();

                            $(".select_5").prop("disabled", true).val("");

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

                        $(".select_5").on("change", function () {
                            const selectedRadio = $(".radio-option_5:checked").val();
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

            <!-- Pertanyaan 6 -->
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
                    <label><input type="checkbox" name="question[6]['Bagaimana Anda mencari pekerjaan tersebut?'][]" value="{{ $cara }}"> {{ $cara }}</label><br>
                @endforeach
            </div>

            <!-- Pertanyaan 7 -->
            <div class="question-card">
                <h3>Berapa perusahaan/instansi/institusi yang sudah Anda lamar sebelum memperoleh pekerjaan pertama?</h3>
                <input type="number" name="question[7]['Berapa perusahaan/instansi/institusi yang sudah Anda lamar sebelum memperoleh pekerjaan pertama?']" required>
            </div>

            <!-- Pertanyaan 8 -->
            <div class="question-card">
                <h3>Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?</h3>
                <input type="number" name="question[8]['Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?']" required>
            </div>

            <!-- Pertanyaan 9 -->
            <div class="question-card">
                <h3>Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?</h3>
                <input type="number" name="question[9]['Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?']" required>
            </div>

            <!-- Pertanyaan 10 -->
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
                            name="question[10]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"
                            value="{{ $alasan_kerja }}"
                            id="{{ $alasan_kerja === 'Lainnya' ? 'option_lainnya_10' : '' }}"
                            class="tidak_sesuai"
                            required>
                        {{ $alasan_kerja }}
                    </label>
                </div>
                @endforeach

                <!-- Input untuk jawaban "Lainnya" -->
                <div id="input_lainnya_container_10" style="display: none; margin-top: 10px;">
                    <input type="text" name="question[10]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']" id="input_lainnya_10" placeholder="Tuliskan jawaban Anda..." style="width: 100%; padding: 8px;">
                </div>
                <script>
                    $(document).ready(function () {
                        // Radio buttons group
                        const $radioButtons = $("input.tidak_sesuai");
                        const $inputLainnya = $("#input_lainnya_10");
                        const $inputLainnyaContainer = $("#input_lainnya_container_10");

                        // On change event for radio buttons
                        $radioButtons.on("change", function () {
                            if ($("#option_lainnya_10").is(":checked")) {
                                $inputLainnyaContainer.show(); // Show input "Lainnya"
                                $inputLainnya.attr("name", "question[10]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya?']"); // Set name for "Lainnya"
                            } else {
                                $inputLainnyaContainer.hide(); // Hide input "Lainnya"
                                $inputLainnya.attr("name", ""); // Remove name if not selected
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
