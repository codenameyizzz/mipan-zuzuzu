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
  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#unduhModal" class="btn btn-sm btn-primary">Unduh CSV Responden</a>
</main>
<div class="modal fade" id="unduhModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Unduh CSV Responden</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <label for="survey_id>">Questionnaire<small class="text-danger">*</small></label>
            <select name="survey_id" id="survey_id" class="form-control" required>
                <option value="" disabled selected>Pilih Questionnaire</option>
                @foreach ($questionnaires as $questionnaire)
                <option value="{{ $questionnaire->id }}">{{ $questionnaire->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="unduhCSV()">Unduh</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function unduhCSV() {
        var survey_id = $('#survey_id').val();
        if (!survey_id) {
            toastr.error('Questionnaire harus dipilih');
            return;
        }
        window.location.href = '/admin/unduh-data/csv/' + survey_id;
        $('#survey_id').val('');
        $('#unduhModal').modal('hide');
    }
  </script>
@endsection
