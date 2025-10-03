@extends('layouts.client')
@section('title', $pageTitle)
@section('content')
@include('parts.clients.page_title')
<section class="course-detal">
    <div class="container">
        <div class="row relative">
            <div class="col-12 col-lg-9">
                <div class="submenu">
                    <ul>
                        <li>
                            <a href="#information">
                                <i class="fa-solid fa-file"></i> {{ __('courses::messages.general_info') }}
                            </a>
                        </li>
                        <li>
                            <a href="#curriculum">
                                <i class="fa-solid fa-book"></i>
                               {{ __('courses::messages.textbooks') }}
                            </a>
                        </li>
                        <li>
                            <a href="#author">
                                <i class="fa-solid fa-user"></i>
                                {{ __('courses::messages.teacher_course') }}
                            </a>
                        </li>
                        <li>
                            <a href="#evaluate">
                                <i class="fa-solid fa-comment"></i>
                                {{ __('courses::messages.rating_course') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="course-descreption" id="information">
                    <div class="course-content">
                        {!! $course->detail !!}
                    </div>

                </div>
                <div class="accordion" id="curriculum">
                    <div class="accordion-top px-2">
                        <p>
                            <i class="fa-solid fa-book me-1"></i>
                            {{ __('courses::messages.including') }}: {{getLessonCount($course)->module}} {{ __('courses::messages.part') }} - {{getLessonCount($course)->lessons}}
                            {{ __('courses::messages.courses_lesson') }}
                        </p>
                        <p>
                            <i class="fa-solid fa-clock me-1"></i>
                            {{ __('courses::messages.duration') }} {{getHour($course->durations)}}
                        </p>
                    </div>
                    @include('courses::clients.lesson')
                </div>
                @if ($course->teacher)
                <div class="course-video mb-4" id="author">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="{{$course->teacher->image}}" alt="" class="rounded-circle" style="width: 80px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p>{{ __('courses::messages.teacher_course') }}</p>
                            <h4 class="mt-2"><a
                                    href="/giang-vien/{{$course->teacher->slug}}">{{$course->teacher->name}}</a></h4>
                        </div>
                    </div>

                    <p class="course-content-infor mt-3">
                        {!!$course->teacher->description!!}
                    </p>

                </div>
                @endif

                <div class="course-video mb-4" id="evaluate">
                    <h2 class="fs-4">{{ __('courses::messages.student_evaluation') }}</h2>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="course-profile mb-4">
                    <div class="img">
                        <img src="{{$course->thumbnail}}" alt="" />
                    </div>
                    <div class="group-text">
                        <p class="price">
                            <i class="fa-solid fa-tag"></i>
                            @if ($course->sale_price)
                            <span class="sale">{{money($course->price)}}</span>
                            <span>{{money($course->sale_price)}}</span>
                            @else
                            <span>{{money($course->price)}}</span>
                            @endif
                        </p>
                        <p class="bookmark">
                            <i class="fa-solid fa-bookmark"></i>
                            {{ __('courses::messages.course_code') }} {{$course->code}}
                        </p>
                        <p class="techer">
                            <i class="fa-solid fa-user"></i>
                            {{ __('courses::messages.teacher_course') }} {{$course->teacher->name.' - '.$course->teacher->exp}} {{ __('courses::messages.years_of_experience') }}
                        </p>
                        <p class="clock">
                            <i class="fa-solid fa-clock"></i>
                            {{ __('courses::messages.duration') }}: {{getHour($course->durations)}}   {{ __('courses::messages.learn') }}
                        </p>
                        <p>
                            <i class="fa-brands fa-hire-a-helper"></i>
                            {{ __('courses::messages.support') }} {{$course->supports}}
                        </p>
                        <p>
                            <i class="fa-brands fa-hire-a-helper"></i>
                            {{ __('courses::messages.attached_documents') }} {{$course->is_document ?  __('courses::messages.Yes') : __('courses::messages.No') }}
                        </p>
                        @php
                            $buttonText =  __('courses::messages.order_the_course') ;
                            $buttonClass = 'payment';

                            if ($courseStatus === 'owned') {
                                $buttonText = __('courses::messages.learn_now');
                                $buttonClass = 'go-learn';
                            } elseif ($courseStatus === 'not_owned') {
                                $buttonText = __('courses::messages.activate_this_course');
                                $buttonClass = 'activate-course';
                            }
                        @endphp
                        <button class="{{ $buttonClass }}"
                                data-course-id="{{ $course->id }}"
                                data-course-slug="{{ $course->slug }}">
                            {{ $buttonText }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
