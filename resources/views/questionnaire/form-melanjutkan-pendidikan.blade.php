@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study - Bekerja')

@section('content')
<section class="questionnaire-section">
    <div class="container">
        <h2>Form Kuisioner - Melanjutkan Pendidikan</h2>
        <form action="{{ route('questionnaire.submit') }}" method="post">
            @csrf
            <input type="hidden" name="status" value="Melanjutkan Pendidikan">
            <!-- Pertanyaan Studi Lanjut -->
            <div class="question-card">
                <h3>1. Pertanyaan studi lanjut</h3>
                <label for="sumber_biaya">Sumber biaya:</label>
                <select name="question[1]['Pertanyaan studi lanjut']['Sumber biaya']" required>
                    <option value="Biaya Sendiri">Biaya Sendiri</option>
                    <option value="Beasiswa">Beasiswa</option>
                </select>

                <label for="perguruan_tinggi">Perguruan Tinggi:</label>
                <input type="text" name="question[1]['Pertanyaan studi lanjut']['Perguruan Tinggi']" id="perguruan_tinggi" required>

                <label for="program_studi">Program Studi:</label>
                <input type="text" name="question[1]['Pertanyaan studi lanjut']['Program Studi']" id="program_studi" required>

                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" name="question[1]['Pertanyaan studi lanjut']['Tanggal Masuk']" required>
            </div>

            <!-- Pertanyaan Sumber Dana -->
            <div class="question-card" style="margin-bottom: 50px;">
                <h3 style="margin-bottom: 15px;">2. Sebutkan sumber dana dalam pembiayaan kuliah?</h3>
                <div class="radio-group">
                    @foreach([
                        'Biaya Sendiri/Keluarga',
                        'Beasiswa ADIK',
                        'Beasiswa BIDIKMISI',
                        'Beasiswa PPA',
                        'Beasiswa AFIRMASI',
                        'Beasiswa Perusahaan/Swasta',
                        'Lainnya'
                    ] as $sumber_dana)
                        <div class="radio-option">
                            <input type="radio" name="question[2]['Sebutkan sumber dana dalam pembiayaan kuliah?']" value="{{ $sumber_dana }}" id="{{ $sumber_dana === 'Lainnya' ? 'option_lainnya_2' : 'sumber_dana_' . $loop->index }}" class="sumber_dana" required>
                            <label for="{{ $sumber_dana === 'Lainnya' ? 'option_lainnya_2' : 'sumber_dana_' . $loop->index }}" class="radio-text">{{ $sumber_dana }}</label>
                        </div>
                    @endforeach
                    <div id="input_lainnya_container_2" style="display: none; margin-top: 10px;">
                        <input type="text" name="question[2]['Sebutkan sumber dana dalam pembiayaan kuliah?']" id="input_lainnya_2" placeholder="Tuliskan lainnya..." style="width: 100%; padding: 8px;">
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function () {
                                const $radioButtons = $("input.sumber_dana");
                                const $inputLainnya = $("#input_lainnya_2");
                                const $inputLainnyaContainer = $("#input_lainnya_container_2");

                                $radioButtons.on("change", function () {
                                    if ($("#option_lainnya_2").is(":checked")) {
                                        $inputLainnyaContainer.show();
                                        $inputLainnya.attr("name", "question[2]['Sebutkan sumber dana dalam pembiayaan kuliah?']");
                                    } else {
                                        $inputLainnyaContainer.hide();
                                        $inputLainnya.attr("name", "");
                                    }
                                });
                            });
                    </script>
                </div>
            </div>

           <!-- Kompetensi yang Dikuasai Saat Lulus dan Kompetensi yang Diperlukan dalam Pekerjaan -->
            <div class="question-card" style="margin-bottom: 50px;">
                <h3>3. Pada saat lulus, pada tingkat mana kompetensi di bawah ini anda kuasai? </h3>
                <!-- Kompetensi yang Dikuasai Saat Lulus -->
                <div class="competency-columns">
                    @foreach(['Etika', 'Keahlian Berdasarkan Bidang Ilmu', 'Bahasa Inggris', 'Penggunaan Teknologi Informasi', 'Komunikasi', 'Kerjasama Tim', 'Pengembangan'] as $kompetensi)
                        <div class="competency-item">
                            <label for="kompetensi_{{ $kompetensi }}" class="competency-label">{{ $kompetensi }}:</label>
                            <div class="radio-buttons">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="radio-option">
                                        <input type="radio" name="question[3]['Pada saat lulus, pada tingkat mana kompetensi di bawah ini Anda kuasai?']['kompetensi_{{ $kompetensi }}']" value="{{ $i }}" required> {{ $i }}
                                    </label>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Kompetensi yang Diperlukan dalam Pekerjaan -->
                <h3>Dan pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan?</h3>
                <div class="competency-columns">
                    @foreach(['Etika', 'Keahlian Berdasarkan Bidang Ilmu', 'Bahasa Inggris', 'Penggunaan Teknologi Informasi', 'Komunikasi', 'Kerjasama Tim', 'Pengembangan'] as $kompetensi)
                        <div class="competency-item">
                            <label for="kompetensi_pada_pekerjaan_{{ $kompetensi }}" class="competency-label">{{ $kompetensi }}:</label>
                            <div class="radio-buttons">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="radio-option">
                                        <input type="radio" name="question[4]['Dan pada saat ini, pada tingkat mana kompetensi di bawah ini diperlukan dalam pekerjaan?']['kompetensi_pada_pekerjaan_{{ $kompetensi }}']" value="{{ $i }}" required> {{ $i }}
                                    </label>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Penekanan pada metode pembelajaran -->
            <div class="question-card">
                <h3>4. Menurut Anda seberapa besar penekanan pada metode pembelajaran berikut dilaksanakan di program studi Anda?</h3>

                <div class="method-columns">
                    @foreach(['Perkuliahan', 'Demonstrasi', 'Partisipasi dalam Proyek Riset', 'Magang', 'Praktikum', 'Kerja Lapangan', 'Diskusi'] as $index => $metode)
                        <div class="method-item">
                            <!-- Menampilkan nomor dan nama metode -->
                            <label for="penekanan_{{ $metode }}" class="method-label">{{ $index + 1 }}. {{ $metode }}</label>

                            <!-- Radio buttons untuk pilihan penekanan -->
                            <div class="method-radio-buttons">
                                @foreach(['Sangat Besar', 'Besar', 'Cukup Besar', 'Kurang Besar', 'Tidak Sama Sekali'] as $level)
                                    <label class="method-radio-option">
                                        <input type="radio" name="question[5]['Menurut Anda seberapa besar penekanan pada metode pembelajaran berikut dilaksanakan di program studi Anda?']['penekanan_{{ $metode }}']" value="{{ $level }}" required> {{ $level }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Waktu Mencari Pekerjaan -->
            <div class="question-card">
                <h3>5. Kapan Anda mulai mencari pekerjaan?</h3>
                <div>
                    <label class="radio-option" style="font-size: 1rem;">
                        <input type="radio" name="question[5]['Kapan Anda mulai mencari pekerjaan?']" value="sebelum_lulus" class="radio-option_5" required>
                        Kira-kira
                        <select id="bulan_sebelum_lulus" class="select_5" style="width: 80px;" disabled>
                            <option value="" disabled selected>Pilih</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select> bulan sebelum lulus
                    </label>
                </div>

                <div>
                    <label class="radio-option" style="font-size: 1rem;">
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
                    <label class="radio-option" style="font-size: 1rem;">
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

            <!-- Cara Mencari Pekerjaan -->
            <div class="question-card">
                <h3>6. Bagaimana Anda mencari pekerjaan tersebut? (Jawaban bisa lebih dari satu)</h3>
                <div class="checkbox-group">
                    @foreach([
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
                        <label class="checkbox-option">
                            <input type="checkbox" name="question[6]['Bagaimana Anda mencari pekerjaan tersebut? (Jawaban bisa lebih dari satu)'][]" value="{{ $cara }}"> {{ $cara }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Jumlah Perusahaan yang Dilamar -->
            <div class="question-card">
                <h3>7. Berapa perusahaan/instansi/institusi yang sudah Anda lamar (lewat surat atau e-mail) sebelum Anda memperoleh pekerjaan pertama?</h3>
                <input type="number" name="question[7]['Berapa perusahaan/instansi/institusi yang sudah Anda lamar (lewat surat atau e-mail) sebelum Anda memperoleh pekerjaan pertama?']" required>
            </div>

            <!-- Jumlah Respon yang Diterima -->
            <div class="question-card">
                <h3>8. Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?</h3>
                <input type="number" name="question[8]['Berapa banyak perusahaan/instansi/institusi yang merespons lamaran Anda?']" required>
            </div>

            <!-- Jumlah Wawancara yang Diundang -->
            <div class="question-card">
                <h3>9. Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?</h3>
                <input type="number" name="question[9]['Berapa banyak perusahaan/instansi/institusi yang mengundang Anda untuk wawancara?']" required>
            </div>

            <!-- Apakah Aktif Mencari Pekerjaan -->
            <div class="question-card">
                <h3>10. Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?</h3>
                <select name="question[10]['Apakah Anda aktif mencari pekerjaan dalam 4 minggu terakhir?']" required>
                    <option value="Tidak">Tidak</option>
                    <option value="Tidak, tapi saya sedang menunggu hasil lamaran kerja">Tidak, tapi saya sedang menunggu hasil lamaran kerja</option>
                    <option value="Ya, saya akan mulai bekerja dalam 2 minggu ke depan">Ya, saya akan mulai bekerja dalam 2 minggu ke depan</option>
                    <option value="Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan">Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Alasan Pekerjaan Tidak Sesuai dengan Pendidikan -->
            <div class="question-card">
                <h3>11. Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya? (Jawaban bisa lebih dari satu)</h3>
                <div class="checkbox-group">
                    @foreach([
                        'Pekerjaan saya sekarang sudah sesuai dengan pendidikan saya',
                        'Saya belum mendapatkan pekerjaan yang lebih sesuai',
                        'Di pekerjaan ini saya memperoleh prospek karir yang baik',
                        'Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya',
                        'Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya',
                        'Saya dapat memperoleh pendapatan yang lebih tinggi di pekerjaan ini',
                        'Pekerjaan saya saat ini lebih aman/terjamin/secure',
                        'Pekerjaan saya saat ini lebih menarik',
                        'Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll.',
                        'Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya',
                        'Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya',
                        'Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya',
                        'Lainnya'
                    ] as $reason)
                        <label class="checkbox-option">
                            <input type="checkbox" name="question[11]['Jika menurut Anda pekerjaan Anda saat ini tidak sesuai dengan pendidikan Anda, mengapa Anda mengambilnya? (Jawaban bisa lebih dari satu)'][]" value="{{ $reason }}"> {{ $reason }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit">Kirim Kuisioner</button>
        </form>
    </div>
</section>


<style>

    body {
        font-family: Arial, sans-serif;
        text-align: left;
    }

    /* Styling untuk card pertanyaan */
        .question-card {
            margin-bottom: 50px;
        }

        .question-card h3 {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 20px;
            color: #333;
            text-align: left;
        }

        /* Styling untuk group radio buttons */
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Styling untuk setiap radio button dan labelnya */
        .radio-option {
            display: flex;
            align-items: center;
            font-weight: normal !important;
        }

        .radio-text {
            font-size: 14px;
            color: #333;
            margin-left: 10px;
            font-weight: normal !important;
            font-weight: normal !important;
        }

        .radio-option input[type="radio"] {
            margin-left: 10px;
            height: 17px;
            width: 17px;
            vertical-align: middle;

        }


        /* Styling untuk Kompetensi yang Diperlukan dalam Pekerjaan */
        .question-card {
            margin-bottom: 50px;
        }

        .question-card h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .competency-columns {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            font-weight: normal !important;
        }

        .competency-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1 1 20%;
            min-width: 220px;
            box-sizing: border-box;
            font-weight: normal !important;
        }

        .competency-label {
            font-size: 14px;
            color: #333;
            text-align: center;
            flex: 1;
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            font-weight: normal !important;
        }

        .separator {
            border-top: 2px solid #ccc;
            margin: 20px 0; /* Spasi atas dan bawah */
            width: 100%;
        }

        /* Styling untuk radio buttons */
        .radio-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            flex: 2;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .radio-buttons input[type="radio"] {
            margin-right: 5px;
            height: 18px;
            width: 18px;
        }

        /* Menata layout agar radio button berada di kanan dan kiri */
        .competency-item .radio-buttons {
            display: flex;
            justify-content: space-between;
            flex: 3;
        }

        /* Styling untuk pilihan yang ada di tengah */
        .radio-option {
            font-size: 10px;
            color: #333;
            display: inline-flex;
            align-items: center;
            margin-right: 0px;
        }


        /* Styling untuk Penekanan pada metode pembelajaran */
        .question-card {
            margin-bottom: 30px;
        }

        .question-card h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .method-columns {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            font-weight: normal !important;
        }

        .method-item {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            font-weight: normal !important;
        }

        .method-label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .method-radio-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: flex-start;
        }

        .method-radio-option {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            color: #333;
            font-weight: normal !important;
        }

        .method-radio-buttons input[type="radio"] {
            margin-right: 5px;
            height: 18px;
            width: 18px;
        }



        /* Styling untuk group checkbox */
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .checkbox-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            font-weight: normal !important;
        }

        .checkbox-label {
            font-size: 14px;
            color: #333;
            margin-right: 10px;
            width: 10%;
        }

        .checkbox-text {
            font-size: 14px;
            color: #333;
            flex-grow: 1;
        }

        .checkbox-option input[type="checkbox"] {
            margin-left: auto;
            height: 18px;
            width: 18px;

        }


        /* Styling untuk group checkbox */
        .checkbox-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            font-weight: normal !important;
        }

        /* Styling untuk setiap checkbox item */
        .checkbox-item {
            display: flex;
            align-items: center;
            width: 100%;
        }

        /* Styling untuk checkbox di sebelah kiri */
        .checkbox-item input[type="checkbox"] {
            margin-right: 10px;
            height: 18px;
            width: 18px;
        }

        /* Styling untuk teks pilihan */
        .checkbox-label {
            font-size: 14px;
            color: #333;
            flex-grow: 1;
            text-align: left;
            font-weight: normal !important;
        }


        .questionnaire-section {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        .questionnaire-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .question-card {
            margin-bottom: 20px;
        }
        .question-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .question-card label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }
        .question-card select,
        .question-card input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .checkbox-group label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }
        .checkbox-group input {
            margin-right: 10px;
        }

        button {
            padding: 12px 24px;
            background-color:  #fbbf24;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
            min-width: 150px;
            text-align: center;
        }

        button:hover {
            background-color: #007bff;
        }

        button:active {
            background-color: #004085;
        }

        </style>

@endsection
