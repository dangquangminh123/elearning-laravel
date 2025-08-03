@extends('layouts.backend')
@section('title', $pageTitle)

@section('content')
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã giảm giá</label>
                    <input type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}} codename"
                        placeholder="Mã..." name="code" id="" value="{{ old('code', $couponCode) }}"  readonly
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
                        <option value="percent" {{ old('discount_type', 'percent') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                        <option value="value" {{ old('discount_type') == 'value' ? 'selected' : '' }}>Số tiền</option>
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
                        placeholder="Số tiền giảm..." name="discount_value" id="" value="{{old('discount_value')}}" />
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
                        placeholder="Giá tiền hoá đơn áp dụng..." name="total_condition" id="" value="{{old('total_condition')}}" />
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
                        placeholder="Số lần sử dụng mã..." name="count" id="" value="{{old('count')}}"/>
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
                    <input type="text" name="start_date" id="start_date" value="{{ old('start_date') }}"
                    class="form-control datepicker  {{$errors->has('start_date') ? 'is-invalid' : ''}}" aria-labelledby="date4-label">
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
                     <input type="text" name="end_date" id="end_date" value="{{ old('end_date') }}"
                      class="form-control datepicker {{$errors->has('end_date') ? 'is-invalid' : ''}}" aria-labelledby="date4-label">
                    @error('end_date')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Khoá học được sử dụng</label>
                    <select name="course_id[]" class="form-select select2" multiple="multiple" data-placeholder="Toàn bộ các khoá">
                        @foreach($courses as $item)
                            <option value="{{ $item->id }}" 
                                {{ collect(old('course_id'))->contains($item->id) ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
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

                    <select name="student_id[]" class="form-select select2" multiple="multiple" data-placeholder="Tất cả học viên">
                        @foreach($students as $item)
                            <option value="{{ $item->id }}" 
                                {{ collect(old('student_id'))->contains($item->id) ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Tạo mã</button>
                <a href="{{route('admin.coupons.index')}}" class="btn btn-danger">Huỷ</a>
            </div>
        </div>
        @csrf
    </form>
@endsection

@section('stylesheets')
    <style>
    
    </style>
@endsection