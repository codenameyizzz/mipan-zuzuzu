@extends('admin.layouts.app')

@section('content')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Unduh Data</h1>
    <nav>
      <ol class="breadcrumb">
        <li>Hello, Admin!</li>
      </ol>
    </nav>
  </div>
  <a href="{{ route('data.unduh-csv') }}" class="btn btn-sm btn-primary">Unduh CSV Responden</a>
</main>
@endsection
