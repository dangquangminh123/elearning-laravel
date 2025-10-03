@extends('layouts.client')
@section('title', $pageTitle)
@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ $course->name }}</h2>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <div class="row">
        <!-- Video chính bên trái -->
        <div class="col-md-8">
            <div id="video-container">
                @if($firstLesson && $firstLesson->video)
                    <video id="main-video" width="100%" height="440" controls autoplay>
                        <source src="{{ route('courses.stream', ['lesson_id' => $firstLesson->id]) }}" type="video/mp4">
                        {{ __('courses::messages.browser_not_support') }}
                    </video>
                    <h5 class="mt-2 fw-bold" id="main-lesson-name">{{ $firstLesson->name }}</h5>
                @else
                    <p>{{ __('courses::messages.no_video_first_lesson') }}</p>
                @endif
            </div>

            @if ($firstLesson && $firstLesson->document && file_exists(public_path($firstLesson->document->url)))
                <div class="mt-3">
                    <a href="{{ asset($firstLesson->document->url) }}" target="_blank" class="doc-button">
                        <i class="fas fa-file-alt"></i> {{ $firstLesson->document->name }}
                    </a>
                </div>
            @elseif($firstLesson && $firstLesson->document)
                <div class="text-danger mt-3">
                    <i class="fas fa-exclamation-triangle"></i> {{ __('courses::messages.lesson_without_document') }}
                </div>
            @endif
        </div>

        <!-- Danh sách bài học bên phải -->
        <div class="col-md-4">
            <h5 class="mb-3 fw-bold">{{ __('courses::messages.list_of_lessons') }}</h5>

            @foreach ($lessonGroups as $index => $group)
                <div class="mb-3">
                    <div class="card-header fw-bold fs-6">
                        <i class="fas fa-folder-open me-2"></i> {{ __('courses::messages.part') }} {{ $index + 1 }} : {{ $group['section']->name }}
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($group['lessons'] as $lesson)
                            @if ($lesson->video)
                                <li class="list-group-item lesson-item play-video {{ $lesson->id === $firstLesson->id ? 'active-lesson' : '' }}"
                                    data-video-url="{{ route('courses.stream', ['lesson_id' => $lesson->id]) }}"
                                    data-doc-url="{{ $lesson->document?->url }}"
                                    data-doc-name="{{ $lesson->document?->name }}"
                                    data-lesson-name="{{ $lesson->name }}">
                                    <div class="lesson-thumbnail-wrapper">
                                        <img src="{{ $course->thumbnail ?? asset('default-thumbnail.jpg') }}" class="lesson-thumbnail" alt="thumb">
                                        <span class="duration-badge">{{ $lesson->formatted_duration ?? '00:00' }}</span>
                                    </div>
                                    <div class="lesson-info ms-3">
                                        <div class="lesson-title">{{ $lesson->name }}</div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
