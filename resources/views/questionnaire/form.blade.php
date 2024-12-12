@extends('layouts.app')

@section('title', 'Kuisioner Tracer Study - Bekerja')

@section('content')
<section class="questionnaire-section">
    <div class="container">
        <h2>Form Kuisioner - {{ $questionnaire->title }}</h2>
        <form action="{{ route('questionnaire.submit') }}" method="post">
            @csrf
            <input type="hidden" name="survey_id" value="{{ $questionnaire->id }}">
            @foreach ($questionnaire->Questions as $question)
            <div class="question-card">
                <h3>{{ $question->question }} @if ($question->is_required) <small style="color: red">*</small> @endif</h3>
                @if ($question->type === 'text')
                    <div class="input-container">
                        <input type="text" name="question[{{ $question->id }}]" id="{{ $question->id }}" {{ $question->is_required ? 'required' : '' }}>
                    </div>
                @elseif($question->type === 'textarea')
                    <div class="input-container">
                        <textarea name="question[{{ $question->id }}]" id="{{ $question->id }}" {{ $question->is_required ? 'required' : '' }}></textarea>
                    </div>
                @elseif($question->type === 'radio')
                    @foreach ($question->Options as $option)
                    <div>
                        <label>
                            <input type="radio" name="question[{{ $question->id }}]" value="{{ $option->value }}"
                                id="question_{{ $question->id }}_option_{{ $option->id }}">
                            {{ $option->text }}
                        </label>
                    </div>
                    @endforeach
                @elseif($question->type === 'checkbox')
                    @foreach ($question->Options as $option)
                    <div>
                        <label>
                            <input type="checkbox" name="question[{{ $question->id }}][]" value="{{ $option->value }}"
                                id="question_{{ $question->id }}_option_{{ $option->id }}">
                            {{ $option->text }}
                        </label>
                    </div>
                    @endforeach
                @elseif($question->type === 'dropdown')
                <select name="question[{{ $question->id }}]" id="{{ $question->id }}" {{ $question->is_required ? 'required' : '' }}>
                    <option value="" disabled selected>Pilih Salah Satu</option>
                    @foreach ($question->Options as $option)
                    <option value="{{ $option->value }}">{{ $option->text }}</option>
                    @endforeach
                </select>
                @elseif($question->type === 'scaled')
                    @php
                        $minOption = $question->options->first();
                        $maxOption = $question->options->last();
                    @endphp
                    <div style="display: flex; justify-content: space-between; padding: 0px 3rem;">
                        <div>
                            <label for="question[{{ $question->id }}]" style="font-weight: bold;">{{ $minOption->text }}</label>
                        </div>
                        @foreach ($question->Options as $option)
                            <div>
                                <label style="font-weight: normal;">
                                    <input type="radio" name="question[{{ $question->id }}]" value="{{ $option->value }}" {{ $question->is_required ? 'required' : '' }}> {{ $option->text }}
                                </label>
                            </div>
                        @endforeach
                        <div>
                            <label for="question[{{ $question->id }}]" style="font-weight: bold;">{{ $maxOption->text }}</label>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
            <button type="submit">Kirim</button>
        </form>
    </div>
</section>
@endsection
