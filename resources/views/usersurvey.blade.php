@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study')

@section('content')
<section class="questionnaire-section">
    <div class="container">
        <h2>User Survey</h2>
        <form action="{{ route('questionnaire.submit') }}" method="post">
            @csrf
            <!-- Segmen 1 -->
            <div class="question-card">
                <h3>1. Identitas Pengisi</h3>

                <div class="form-group">
                    <label for="name">Nama Lengkap:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="name">Jabatan:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
            </div>


            <!-- Segmen 2 -->
            <div class="question-card">
                <h3>2. Informasi Umum</h3>

                <div class="form-group">
                    <label for="jumlah-lulusan">Berapakah jumlah lulusan kami yang bekerja di instansi/perusahaan anda?</label>
                    <input type="number" id="jumlah-lulusan" name="jumlah-lulusan" placeholder="Masukkan jumlah lulusan" required>
                </div>

                <div class="form-group">
                    <label for="ipk-minimal">Berapa nilai IPK minimal untuk bekerja di instansi/perusahaan Bapak/Ibu?</label>
                    <input type="text" id="ipk-minimal" name="ipk-minimal" placeholder="Contoh: 4.00" requied>
                </div>
            </div>


            <!-- Segmen 3 -->
            <div class="question-card">
                <h3>3. Identitas Lembaga/Perusahaan</h3>

                <div class="form-group">
                    <label for="institution-name">Nama:</label>
                    <input type="text" id="institution-name" name="institution-name" placeholder="Masukkan nama lembaga/perusahaan" required>
                </div>

                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <textarea id="address" name="address" placeholder="Masukkan alamat lengkap lembaga/perusahaan" rows="2" required></textarea>
                </div>

                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="province">Provinsi:</label>
                        <input type="text" id="province" name="province" placeholder="Provinsi" required>
                    </div>
                    <div class="form-group">
                        <label for="city">Kota/Kabupaten:</label>
                        <select id="city" name="city" required>
                            <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="institution-email" placeholder="Masukkan email lembaga/perusahaan" required>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telp/WA:</label>
                    <input type="tel" id="phone" name="institution-phone" placeholder="Masukkan nomor telepon/WA lembaga/perusahaan" required>
                </div>

                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="business-field">Bidang Usaha:</label>
                        <select id="business-field" name="business-field" required>
                            <option value="" disabled selected>Pilih Bidang Usaha</option>
                        </select>
                    </div>
                </div>
            </div>


            <!-- Segmen 4 -->
            <div class="question-card">
            <h3>4. Identitas Lembaga/Perusahaan</h3>

            <div class="form-group">
                <label for="city">Kota/Kabupaten:</label>
                <select id="city" name="city" required>
                    <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                </select>
            </div>

            <!-- Dropdown Bidang Usaha -->
            <div class="form-group">
                <label for="business-field">Bidang Usaha:</label>
                <select id="business-field" name="business-field" required>
                    <option value="" disabled selected>Pilih Bidang Usaha</option>
                    <option value="Pertanian, Kehutanan, dan Perikanan">Pertanian, Kehutanan, dan Perikanan</option>
                    <option value="Industri Pengolahan">Industri Pengolahan</option>
                    <option value="Konstruksi">Konstruksi</option>
                    <option value="Perdagangan Besar dan Eceran">Perdagangan Besar dan Eceran</option>
                    <option value="Transportasi dan Pergudangan">Transportasi dan Pergudangan</option>
                    <option value="Informasi dan Komunikasi">Informasi dan Komunikasi</option>
                    <option value="Keuangan dan Asuransi">Keuangan dan Asuransi</option>
                    <option value="Real Estat">Real Estat</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Kesehatan dan Kegiatan Sosial">Kesehatan dan Kegiatan Sosial</option>
                    <option value="Jasa Lainnya">Jasa Lainnya</option>
                </select>
            </div>
        </div>

        <!-- Segmen 5-->
        <div class="question-card">
        <h3 onclick="toggleSection('etika-section')" style="cursor: pointer;">
            Etika <span id="etika-toggle" style="float: right;"></span>
        </h3>
        <div id="etika-section" class="animated-section">
            <div class="form-group">
                <label>Kepatuhan pada tata nilai yang berlaku</label>
                <div class="radio-group horizontal">
                    <label><input type="radio" name="kepatuhan" value="Sangat Baik" > Sangat Baik</label>
                    <label><input type="radio" name="kepatuhan" value="Baik"> Baik</label>
                    <label><input type="radio" name="kepatuhan" value="Cukup"> Cukup</label>
                    <label><input type="radio" name="kepatuhan" value="Kurang"> Kurang</label>
                </div>
            </div>

            <div class="form-group">
                <label>Sikap mematuhi aturan dan norma yang berlaku</label>
                <div class="radio-group horizontal">
                    <label><input type="radio" name="sikap" value="Sangat Baik" required> Sangat Baik</label>
                    <label><input type="radio" name="sikap" value="Baik"> Baik</label>
                    <label><input type="radio" name="sikap" value="Cukup"> Cukup</label>
                    <label><input type="radio" name="sikap" value="Kurang"> Kurang</label>
                </div>
            </div>

            <div class="form-group">
                <label>Kecerdasan emosional (emotional intelligence)</label>
                <div class="radio-group horizontal">
                    <label><input type="radio" name="emosional" value="Sangat Baik" required> Sangat Baik</label>
                    <label><input type="radio" name="emosional" value="Baik"> Baik</label>
                    <label><input type="radio" name="emosional" value="Cukup"> Cukup</label>
                    <label><input type="radio" name="emosional" value="Kurang"> Kurang</label>
                </div>
            </div>
        </div>
    </div>

            <!-- Tambahkan pertanyaan lainnya sesuai kebutuhan -->

            <div class="submit-button">
                <button type="submit" class="btn">Kirim Kuisioner</button>
            </div>
        </form>
    </div>
</section>
@endsection
