@extends('layouts.client')
@section('title', $pageTitle)

@section('content')
@include('parts.clients.page_title')
<section class="all-course">
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-danger">
                {{ session('msg') }}
            </div>
        @endif
        @if ($courses)
        <div class="row">
            @foreach ($courses as $course)
            <div class="col-12 col-lg-6">
                <div class="d-flex course">
                    <div class="banner-course">
                        <img src="{{$course->thumbnail}}" alt="{{$course->name}}" />
                    </div>
                    <div class="descreption-course">
                        <div class="descreption-top">
                            <p><i class="fa-solid fa-clock"></i> {{getHour($course->durations)}} học</p>
                            <p><i class="fa-solid fa-video"></i> {{getLessonCount($course)->module}}
                                {{ __('courses::messages.part') }}/{{getLessonCount($course)->lessons}} {{ __('courses::messages.courses_lesson') }}</p>
                            <p><i class="fa-solid fa-eye"></i> {{$course->view ? number_format($course->view): 0}}</p>
                        </div>
                        <h5 class="descreption-title">
                            <a href="/khoa-hoc/{{$course->slug}}">
                                {{$course->name}}
                            </a>
                        </h5>
                        <div class="descreption-teacher">
                            <img src="{{$course->teacher?->image}}" alt="{{$course->teacher?->name}}" />
                            <span>{{$course->teacher?->name}}</span>
                        </div>
                        <p class="descreption-price">
                            @if ($course->sale_price)
                            <span class="sale">{{money($course->price)}}</span>
                            <span class="new-price">{{money($course->sale_price)}}</span>
                            @else
                            <span class="new-price">{{money($course->price)}}</span>
                            @endif
                        </p>
                        <div class="descreption-actions">
                            @auth('students')
                                @php
                                    $hasAccess = $hasAccessList[$course->id] ?? false;
                                @endphp


                                @if ($hasAccess)
                                    <a href="{{ route('courses.learn', ['slug' => $course->slug]) }}" class="btn btn-start-learning">
                                        {{ __('courses::messages.learn_now') }}
                                    </a>
                                @else
                                    <a href="#" class="btn btn-buy">{{ __('courses::messages.order_the_course') }}</a>
                                    <form method="POST">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <button type="submit" class="btn btn-add-to-cart" data-id="{{ $course->id }}">{{ __('courses::messages.add_to_cart') }}</button>
                                    </form>
                                @endif
                            @else
                                <a href="#" class="btn btn-buy">{{ __('courses::messages.order_the_course') }}</a>
                                <form method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="submit" class="btn btn-add-to-cart" data-id="{{ $course->id }}">{{ __('courses::messages.add_to_cart') }}</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{$courses->links()}}
        </div>
        @endif
    </div>
</section>
@endsection