@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Bagian Hero -->
<header class="hero">
    <div class="container">
        <div class="hero-content">
            <h2>Selamat Datang di <br> Tracer Study <br> Institut Teknologi Del</h2>
            <p>Bantu kami meningkatkan kualitas pendidikan dengan berpartisipasi dalam tracer study.</p>
            <a href="{{ url('/questionnaire') }}" class="btn">Mulai Sekarang</a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('image/wisuda.jpg') }}" alt="Ilustrasi Tracer Study">
        </div>
    </div>
    <div class="scroll-down">
        <a href="#info"><i class="fas fa-chevron-down"></i></a>
    </div>
</header>

<!-- Bagian Tracer Study -->
<section class="tracer-study-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="section-title fade-in">
          Apa itu <span class="highlight">Tracer Study?</span>
        </h2>
      </div>
      <div class="col-md-12 text-content fade-in">
        <p>
          Tracer Study di Institut Teknologi Del berperan penting dalam mempererat hubungan antara institusi dan alumni. Survei ini memberikan wawasan tentang perjalanan karir alumni serta harapan mereka terhadap pengembangan pendidikan. Selain meningkatkan kualitas pendidikan, Tracer Study juga memperkuat jaringan alumni yang saling mendukung dalam karir dan kontribusi terhadap kemajuan kampus, serta membuka peluang bagi alumni untuk berpartisipasi dalam pengembangan almamater.
        </p>
      </div>
    </div>
  </div>
</section>



<!-- Bagian Manfaat dan Tujuan -->
<section class="benefits-section">
    <div class="container">
        <h3>Manfaat dan Tujuan</h3>
        <div class="content-wrapper">
            <!-- Kolom Teks -->
            <div class="text-content">
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <div class="icon">
                        <img src="{{ asset('image/medal.png') }}" alt="Ikon Akreditasi ">

                        </div>
                        <div class="text">
                            <h4>Akreditasi Perguruan Tinggi</h4>
                            <p>Pengisian Tracer Study digunakan sebagai dasar perhitungan capaian Indikator Kinerja Utama yang mempengaruhi pemeringkatan perguruan tinggi.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="icon">
                        <img src="{{ asset('image/bookmark.png') }}" alt="Ikon Evaluasi">

                        </div>
                        <div class="text">
                            <h4>Evaluasi Relevansi Kurikulum dan Dunia Kerja</h4>
                            <p>Data Tracer Study digunakan sebagai bahan evaluasi kurikulum pada setiap program studi agar sesuai dengan kebutuhan dunia kerja sekarang.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="icon">
                        <img src="{{ asset('image/link.png') }}" alt="Ikon Jejaring">

                        </div>
                        <div class="text">
                            <h4>Membangun Jejaring Alumni</h4>
                            <p>Data Tracer Study dapat digunakan untuk mengetahui persebaran alumni dalam rangka membangun jaringan komunitas alumni di Indonesia atau dunia.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kolom Gambar -->
            <div class="left-image">
            <img src="{{ asset('image/Frame 19.png') }}" alt="Manfaan dan Tujuan">
            </div>
        </div>
    </div>
</section>


<!-- Bagian Informasi -->
<section class="info-section fade-in-info" id="info">
    <div class="container">
        <h4 class="section-title">Metode dan Konsep Tracer Study</h3>
        <p class="intro-paragraph">
            Sistem pelacakan alumni di Institut Teknologi Del disebut Tracer Study. Sistem ini dikelola oleh PPKHA IT Del dan bertujuan untuk memantau perkembangan karier alumni. Proses tracer study di IT Del membantu mengumpulkan informasi dari alumni untuk meningkatkan kualitas pendidikan dan menjaga hubungan yang baik antara kampus dan lulusan.
        </p>

        <div class="info-grid">
            <!-- Card 1: Program Tracer Study -->
            <div class="info-item">
            <div class="card-header"></div>
                <img src="image/megaphone.png" alt="Program Tracer Study" class="icon">
                <p>Tim PPKHA mengirimkan email broadcast dan WA broadcast kepada lulusan untuk berpartisipasi dalam tracer study online.</p>
            </div>
            <!-- Card 2: Metode Tracer Study -->
            <div class="info-item">
            <div class="card-header"></div>
                <img src="image/chat.png" alt="Metode Tracer Study" class="icon">
                <p>Pengelola prodi menghubungi lulusan untuk memberikan jawaban atas pertanyaan tracer study.</p>
            </div>
            <!-- Card 3: Sistem Pelacakan Alumni -->
            <div class="info-item">
            <div class="card-header"></div>
                <img src="image/bureaucracy.png" alt="Sistem Pelacakan Alumni" class="icon">
                <p>Himpunan mahasiswa mengirim broadcast message melalui media populer seperti Line, Instagram, dan WhatsApp.</p>
            </div>
        </div>
    </div>
</section>


<!-- Bagian Ajakan -->
<section class="cta-section">
    <div class="container">
        <h3>Ayo Berkontribusi dalam Tracer Study</h3>
        <a href="{{ url('/questionnaire') }}" class="btn">Isi Kuisioner</a>
    </div>
</section>
@endsection
