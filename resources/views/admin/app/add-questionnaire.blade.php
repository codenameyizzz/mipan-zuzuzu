@extends('admin.layouts.app')

@section('content')

<main id="main" class="main">
    <div class="pagetitle d-flex align-items-center gap-3">
        <div>
            <h1>Tambah Questionnaire</h1>
        </div>
        <div>
            <a href="{{ route('data.questionnaire') }}" class="btn btn-primary">
                Kembali
            </a>
        </div>
    </div>
    <form action="{{ route('data.post-add-questionnaire') }}" method="POST" id="formData">
        @csrf
        <div class="card">
            <div class="card-body p-4">
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Judul Questionnaire<small class="text-danger">*</small></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group mb-3">
                    <label for="is_required" class="form-label">Tipe Questionnaire<small class="text-danger">*</small></label>
                        <select name="type" class="form-select" required>
                            <option value="">Pilih Tipe Questionnaire</option>
                            @foreach ($questionnaire_type as $type)
                                <option value="{{ $type }}">{{ ucwords($type) }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi <small class="text-muted">(Optional)</small></label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
            </div>
        </div>
        <div class="pagetitle d-flex align-items-center gap-3">
            <div>
                <h4>Pertanyaan</h4>
            </div>
            <div>
                {{-- <button type="button" class="btn btn-primary" onclick="addQuestion()">Tambah Pertanyaan</button> --}}
                <button type="button" class="btn btn-primary" id="add-question">Tambah Pertanyaan</button>
            </div>
        </div>
        <div id="questions-container">
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</main>
<script>
    $(document).ready(function () {
        let questionIndex = 0;

        $("#add-question").on("click", function () {
            questionIndex++; // Increment indeks
            let questionTemplate = `
                <div class="card mt-3 question-card" data-id="${questionIndex}">
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="question" class="form-label">Pertanyaan<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="questions[${questionIndex}][text]" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="type" class="form-label">Tipe Jawaban<small class="text-danger">*</small></label>
                                    <select name="questions[${questionIndex}][type]" class="form-select question-type" data-id="${questionIndex}" required>
                                        <option value="">Pilih Tipe Jawaban</option>
                                        <option value="text">Jawaban Singkat</option>
                                        <option value="textarea">Paragraf</option>
                                        <option value="radio">Pilihan Ganda</option>
                                        <option value="checkbox">Kotak Centang</option>
                                        <option value="dropdown">Drop-down</option>
                                        <option value="scaled">Skala Linier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="is_required" class="form-label">Wajib diisi<small class="text-danger">*</small></label>
                                    <select name="questions[${questionIndex}][is_required]" class="form-select" required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="option-container" data-id="${questionIndex}"></div>
                        <div class="row">
                            <div class="col-md d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger delete-question">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $("#questions-container").append(questionTemplate);
        });

        // Menangani tipe jawaban
        $(document).on("change", ".question-type", function () {
            let questionId = $(this).data("id"); // Ambil ID pertanyaan
            let type = $(this).val();
            let optionContainer = $(`.option-container[data-id="${questionId}"]`);

            // Hapus kontainer opsi sebelumnya
            optionContainer.empty();

            // Tambahkan opsi berdasarkan tipe
            if (type === "radio" || type === "checkbox" || type === "dropdown") {
                let optionsTemplate = `
                    <div class="form-group mt-3">
                        <label for="options" class="form-label">Opsi Jawaban<small class="text-danger">*</small></label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="questions[${questionId}][options][]" placeholder="Masukkan opsi">
                            <button type="button" class="btn btn-danger remove-option">Hapus</button>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm add-option">Tambah Opsi</button>
                    </div>
                `;
                optionContainer.append(optionsTemplate);
            } else if (type === "scaled") {
                let scaledTemplate = `
                    <div class="form-group mt-3">
                        <label for="scale" class="form-label">Skala Linier</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Minimum</label>
                                <input type="number" class="form-control" name="questions[${questionId}][scale_min]" placeholder="Contoh: 1">
                            </div>
                            <div class="col-md-6">
                                <label>Maksimum</label>
                                <input type="number" class="form-control" name="questions[${questionId}][scale_max]" placeholder="Contoh: 10">
                            </div>
                        </div>
                    </div>
                `;
                optionContainer.append(scaledTemplate);
            }
        });

        // Tambah opsi jawaban
        $(document).on("click", ".add-option", function () {
            let questionId = $(this).closest(".option-container").data("id"); // Ambil ID pertanyaan
            let optionInput = `
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="questions[${questionId}][options][]" placeholder="Masukkan opsi">
                    <button type="button" class="btn btn-danger remove-option">Hapus</button>
                </div>
            `;
            $(this).before(optionInput);
        });

        // Hapus opsi jawaban
        $(document).on("click", ".remove-option", function () {
            $(this).closest(".input-group").remove();
        });

        // Hapus pertanyaan
        $(document).on("click", ".delete-question", function () {
            $(this).closest(".question-card").remove();
        });
    });

</script>
@endsection
