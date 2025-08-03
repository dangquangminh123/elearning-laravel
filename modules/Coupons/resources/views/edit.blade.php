@extends('layouts.backend')
@section('title', $pageTitle)

@section('content')
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã giảm giá</label>
                   <input type="text" class="form-control codename"
                        name="code" value="{{ old('code', $coupon->code) }}" readonly
                        style="background-color: #e9ecef; cursor: not-allowed;"/>
                    @error('code')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Loại mã giảm giá</label>
                     <select name="discount_type" id="" class="form-select {{$errors->has('discount_type') ? 'is-invalid' : ''}}">
                        <option value="percent" {{ old('discount_type', $coupon->discount_type) == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                        <option value="value" {{ old('discount_type', $coupon->discount_type) == 'value' ? 'selected' : '' }}>Số tiền</option>
                    </select>
                    @error('discount_type')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Số tiền giảm trực tiếp</label>
                    <input type="number" class="form-control {{$errors->has('discount_value') ? 'is-invalid' : ''}}"
                        placeholder="Số tiền giảm..." name="discount_value" id="" 
                        value="{{ old('discount_value', $coupon->discount_value) }}" />
                    @error('discount_value')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá tiền hoá đơn áp dụng</label>
                    <input type="number" class="form-control {{$errors->has('total_condition') ? 'is-invalid' : ''}}"
                        placeholder="Giá tiền hoá đơn áp dụng..." name="total_condition" id="" value="{{ old('total_condition', $coupon->total_condition) }}" />
                    @error('total_condition')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Số lần sử dụng mã</label>
                    <input type="number"  name="count" class="form-control {{$errors->has('count') ? 'is-invalid' : ''}}"
                        placeholder="Số lần sử dụng mã..." name="count" id="" value="{{ old('count', $coupon->count) }}"/>
                    @error('count')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Thời gian bắt đầu áp dụng</label>
                    <input type="text" name="start_date" id="start_date" class="form-control datepicker" aria-labelledby="date4-label"
                     value="{{ old('start_date', $coupon->start_date) }}">
                    @error('start_date')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Thời gian kết thúc mã</label>
                     <input type="text" name="end_date" id="end_date" class="form-control datepicker" aria-labelledby="date4-label"
                     value="{{ old('end_date', $coupon->end_date) }}">
                    @error('count')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Khoá học được sử dụng</label>
                    <select name="course_id[]" id="" class="form-select {{$errors->has('teacher_id') ? 'is-invalid' : ''}} select2-multiple" multiple="multiple">
                        <option value="" {{ empty(old( 'course_id')) ? 'selected' : '' }}>Toàn bộ các khoá</option>
                        @if($courses) 
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ in_array($course->id, old('course_id', $courseIds) ?? []) ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Học viên được sử dụng</label>
                    <select name="student_id[]" id="" class="form-select {{$errors->has('student_id') ? 'is-invalid' : ''}} select2-multiple" multiple="multiple">
                        <option value="" {{ empty(old('student_id')) ? 'selected' : '' }}>Tất cả học viên</option>
                        @if($students) 
                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ in_array($student->id, old('student_id', $studentIds) ?? []) ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sửa mã</button>
                <a href="{{route('admin.coupons.index')}}" class="btn btn-danger">Huỷ</a>
            </div>
        </div>
        @csrf
        @method('PUT')
    </form>
@endsection

@section('stylesheets')
    <style>
    
    </style>
@endsection