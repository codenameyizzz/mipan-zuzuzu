@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study')

@section('content')
<section class="questionnaire-section">
    <div class="container">
        <h2>Kuisioner Tracer Study</h2>
        <form action="{{ route('questionnaire.storeStatus') }}" method="post">
            @csrf
            <!-- Pertanyaan Identitas -->
            <div class="question-card">
                <h3>Identitas</h3>
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim"
                    value="{{ auth()->user()->Mahasiswa->nim }}" disabled
                    readonly>

                <label for="tahun_lulus">Tahun Lulus</label>
                <input type="text" id="tahun_lulus" name="tahun_lulus"
                    value="{{ auth()->user()->Mahasiswa->angkatan }}" disabled
                    readonly>

                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                    value="{{  auth()->user()->name ?? '' }}" disabled readonly>

                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email"
                    value="{{  auth()->user()->email ?? '' }}" disabled readonly>

                <label for="phone">Nomor Telephone</label>
                <input type="tel" id="phone" name="phone"
                    value="{{ auth()->user()->phone ?? '' }}" required>

                <label for="status">Status Anda Saat Ini</label>
                <div class="radio-group">
                    @php
                        $status = auth()->user()->status ?? '';
                    @endphp
                    <input type="radio" id="status_bekerja" name="status" value="Bekerja" {{ $status == 'Bekerja' ? 'checked' : '' }} required>
                    <label for="status_bekerja">Bekerja (full-time / part-time)</label>

                    <input type="radio" id="status_belum_bekerja" name="status" value="Belum memungkinkan bekerja" {{ $status == 'Belum memungkinkan bekerja' ? 'checked' : '' }} required>
                    <label for="status_belum_bekerja">Belum memungkinkan bekerja</label>

                    <input type="radio" id="status_wiraswasta" name="status" value="Wiraswasta" {{ $status == 'Wiraswasta' ? 'checked' : '' }} required>
                    <label for="status_wiraswasta">Wiraswasta</label>

                    <input type="radio" id="status_melanjutkan_pendidikan" name="status" value="Melanjutkan Pendidikan" {{ $status == 'Melanjutkan Pendidikan' ? 'checked' : '' }} required>
                    <label for="status_melanjutkan_pendidikan">Melanjutkan Pendidikan</label>

                    <input type="radio" id="status_mencari_kerja" name="status" value="Tidak kerja tetapi sedang mencari kerja" {{ $status == 'Tidak kerja tetapi sedang mencari kerja' ? 'checked' : '' }} required>
                    <label for="status_mencari_kerja">Tidak kerja tetapi sedang mencari kerja</label>
                </div>
            </div>
            <!-- Tombol Kirim -->
            <div class="submit-button">
                <button type="submit">Kirim</button>
            </div>
        </form>
    </div>
</section>
@endsection
