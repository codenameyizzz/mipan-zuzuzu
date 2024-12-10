@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study - Status')

@section('content')
<section class="questionnaire-section">
    <div class="container">
        <h2>Kuisioner Tracer Study</h2>
        <form action="{{ route('questionnaire.submit') }}" method="post">
            @csrf
            <!-- Pertanyaan Status -->
            <div class="question-card">
                <h3>Jelaskan status Anda saat ini?</h3>
                <div>
                    <input type="radio" id="bekerja" name="status" value="Bekerja" required>
                    <label for="bekerja">Bekerja (full time / part time)</label>
                </div>
                <div>
                    <input type="radio" id="belum_kerja" name="status" value="Belum memungkinkan bekerja">
                    <label for="belum_kerja">Belum memungkinkan bekerja</label>
                </div>
                <div>
                    <input type="radio" id="wiraswasta" name="status" value="Wiraswasta">
                    <label for="wiraswasta">Wiraswasta</label>
                </div>
                <div>
                    <input type="radio" id="melanjutkan_pendidikan" name="status" value="Melanjutkan Pendidikan">
                    <label for="melanjutkan_pendidikan">Melanjutkan Pendidikan</label>
                </div>
                <div>
                    <input type="radio" id="mencari_kerja" name="status" value="Tidak kerja tetapi sedang mencari kerja">
                    <label for="mencari_kerja">Tidak kerja tetapi sedang mencari kerja</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Selanjutnya</button>
        </form>
    </div>
</section>
@endsection
