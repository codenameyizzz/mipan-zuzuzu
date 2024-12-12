<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{ route('dashboard') }}">
        <i class="ri-dashboard-3-line"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('data.questionnaire') }}">
          <i class="bi bi-card-list"></i>
          <span>Data Kuisioner</span>
        </a>
      </li><!-- End Register Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('data.responden') }}">
        <i class="bi bi-card-list"></i>
        <span>Data Responden</span>
      </a>
    </li><!-- End Register Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('data.statistik')}}">
        <i class="bi bi-bar-chart"></i>
        <span>Statistik</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('data.unggah')}}">
        <i class="ri-upload-2-line"></i>
        <span>Unggah Data</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('data.unduh')}}">
        <i class="ri-download-2-fill"></i>
        <span>Unduh Data</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('user.survey')}}">
        <i class="ri-account-pin-circle-line"></i>
        <span>User Survey</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('data.panduan')}}">
        <i class="bi bi-journal-text"></i>
        <span>Panduan Form</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="tables-general.html">
            <i class="bi bi-circle"></i><span>General Tables</span>
          </a>
        </li>
        <li>
          <a href="tables-data.html">
            <i class="bi bi-circle"></i><span>Data Tables</span>
          </a>
        </li>
      </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-heading">Other</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('data.faq')}}">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{route('data.contact')}}">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
      </a>
    </li><!-- End Contact Page Nav -->
  </ul>
</aside>
