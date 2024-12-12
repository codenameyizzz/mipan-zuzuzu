@extends('admin.layouts.app')

@section('content')

<main id="main" class="main">
    <div class="pagetitle d-flex align-items-center gap-3">
        <div>
            <h1>Data Questionnaire</h1>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('data.add-questionnaire') }}">
                Tambah Questionnaire
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body pt-4">
            <form id="formFilter" class="d-flex">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="search"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." name="search"
                        onkeyup="searchData()">
                </div>
            </form>
            <div class="table-responsive" id="data">

            </div>
            <div id="loading" class="text-center">
                <div>
                    <img src="{{ asset('assets/img/loading_animated_blue.svg') }}" alt="loading" width="55px">
                </div>
                <div>Loading...</div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            searchData();
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getData(page);
            })
        });

        function getData(page) {
            let formData = $('#formFilter').serialize();

            $.ajax({
                url: `/admin/questionnaire/data?page=` + page,
                method: 'GET',
                data: formData,
                beforeSend: function(e) {
                    loading(true)
                },
                success: function(data) {
                    loading(false)
                    $('#data').html(data);
                },
                error: function(error) {
                    loading(false)
                    toastr.error('Something went wrong');
                }
            })
        }

        function searchData() {
            let formData = $('#formFilter').serialize();

            $.ajax({
                url: `/admin/questionnaire/data`,
                method: 'GET',
                data: formData,
                beforeSend: function(e) {
                    loading(true)
                },
                success: function(data) {
                    loading(false)
                    $('#data').html(data)
                },
                error: function(error) {
                    loading(false)
                    toastr.error('Something went wrong');
                }
            })
        }
    </script>
</main>
@endsection
