@extends('admin.layouts.app')

@section('content')

<main id="main" class="main">
    <div class="pagetitle d-flex align-items-center gap-3">
        <div>
            <h1>Edit Questionnaire</h1>
        </div>
        <div>
            <a href="{{ route('data.questionnaire') }}" class="btn btn-primary">
                Kembali
            </a>
        </div>
    </div>
    <form action="{{ route('data.post-edit-questionnaire', $data->id) }}" method="POST" id="formData">
        @csrf
        <div class="card">
            <div class="card-body p-4">
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Judul Questionnaire<small class="text-danger">*</small></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="is_required" class="form-label">Tipe Questionnaire<small class="text-danger">*</small></label>
                        <select name="type" class="form-select" required>
                            <option value="">Pilih Tipe Questionnaire</option>
                            @foreach ($questionnaire_type as $type)
                                <option value="{{ $type }}" @if ($data->type == $type) selected @endif>{{ ucwords($type) }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi <small class="text-muted">(Optional)</small></label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $data->description }}">
                </div>
            </div>
        </div>
        <div class="pagetitle d-flex align-items-center gap-3">
            <div>
                <h4>Pertanyaan</h4>
            </div>
            <div>
                <button type="button" class="btn btn-primary" id="add-question">Tambah Pertanyaan</button>
            </div>
        </div>
        <div id="questions-container">
            @foreach ($data->Questions as $index => $question)
                <div class="card mt-3 question-card" data-index="{{ $index }}">
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="question_{{ $index }}" class="form-label">Pertanyaan<small class="text-danger">*</small></label>
                                    <input type="text" id="question_{{ $index }}" class="form-control" name="questions[{{ $index }}][text]" value="{{ $question->question }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="type_{{ $index }}" class="form-label">Tipe Jawaban<small class="text-danger">*</small></label>
                                    <select id="type_{{ $index }}" name="questions[{{ $index }}][type]" class="form-select question-type" data-id="{{ $index }}" required>
                                        <option value="" disabled>Pilih Tipe Jawaban</option>
                                        <option value="text" {{ $question->type == 'text' ? 'selected' : '' }}>Jawaban Singkat</option>
                                        <option value="textarea" {{ $question->type == 'textarea' ? 'selected' : '' }}>Paragraf</option>
                                        <option value="radio" {{ $question->type == 'radio' ? 'selected' : '' }}>Pilihan Ganda</option>
                                        <option value="checkbox" {{ $question->type == 'checkbox' ? 'selected' : '' }}>Kotak Centang</option>
                                        <option value="dropdown" {{ $question->type == 'dropdown' ? 'selected' : '' }}>Drop-down</option>
                                        <option value="scaled" {{ $question->type == 'scaled' ? 'selected' : '' }}>Skala Linier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="is_required" class="form-label">Wajib diisi<small class="text-danger">*</small></label>
                                    <select name="questions[{{ $index }}][is_required]" class="form-select" required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Opsi Jawaban -->
                        <div class="option-container" data-id="{{ $index }}">
                            @if (in_array($question->type, ['radio', 'checkbox', 'dropdown']))
                                @foreach ($question->options as $optIndex => $option)
                                    <div class="form-group mt-3">
                                        <label for="option_{{ $index }}_{{ $optIndex }}" class="form-label">Opsi Jawaban<small class="text-danger">*</small></label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="questions[{{ $index }}][options][{{ $optIndex }}]" id="option_{{ $index }}_{{ $optIndex }}" placeholder="Masukkan opsi" value="{{ $option->value }}">
                                            <button type="button" class="btn btn-danger remove-option">Hapus</button>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif ($question->type == 'scaled')
                                @php
                                    $minOption = $question->options->first();
                                    $maxOption = $question->options->last();
                                @endphp

                                <div class="form-group mt-3">
                                    <label for="scale" class="form-label">Skala Linier</label>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="min_{{ $index }}">Minimum</label>
                                            <input type="number" class="form-control" id="min_{{ $index }}" name="questions[{{ $index }}][scale_min]" placeholder="Contoh: 1" value="{{ $minOption ? $minOption->value : '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="max_{{ $index }}">Maksimum</label>
                                            <input type="number" class="form-control" id="max_{{ $index }}" name="questions[{{ $index }}][scale_max]" placeholder="Contoh: 10" value="{{ $maxOption ? $maxOption->value : '' }}">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <button type="button" class="btn btn-primary btn-sm add-option" data-id="{{ $index }}">Tambah Opsi</button>
                        </div>

                        <div class="row">
                            <div class="col-md d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-danger delete-question">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</main>
<script>
    $(document).ready(function () {
        let questionIndex = {{ count($data->Questions) }};

        $("#add-question").on("click", function () {
            questionIndex++;
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
