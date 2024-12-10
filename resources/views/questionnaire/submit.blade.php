@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study - Terima Kasih')

@section('content')
<section class="questionnaire-section">
    <div class="container">
        <h2>Terima Kasih!</h2>
        <p>Terima kasih telah mengisi kuisioner kami. Kami menghargai waktu dan kontribusi Anda.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>
</section>
@endsection
