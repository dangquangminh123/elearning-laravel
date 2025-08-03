@extends('layouts.backend')
@section('title', $pageTitle)

@section('content')

    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}} title"
                        placeholder="Tên..." name="name" id="" value="{{old('name')}}" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" class="form-control {{$errors->has('slug') ? 'is-invalid' : ''}} slug"
                        placeholder="Slug..." name="slug" id="" value="{{old('slug')}}" />
                    @error('slug')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Số năm kinh nghiệm</label>
                    <input type="number" class="form-control {{$errors->has('exp') ? 'is-invalid' : ''}} exp"
                        placeholder="số năm kinh nghiệm..." name="exp" id="" value="{{old('exp')}}" />
                    @error('exp')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

             <div class="col-6">
                <div class="mb-3">
                    <label for="">Số điện thoại/ số zalo</label>
                    <input type="number" class="form-control {{$errors->has('phone_zalo') ? 'is-invalid' : ''}} phone_zalo"
                        placeholder="Điện thoại/zalo..." name="phone_zalo" id="" value="{{old('phone_zalo')}}" />
                    @error('phone_zalo')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Mô tả</label>
                    <textarea name="description" id="" class="form-control ckeditor {{$errors->has('description') ? 'is-invalid' : ''}}" placeholder="Mô tả...">{{ old('description')}}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                   <div class="row {{$errors->has('image') ? 'align-items-center' : 'align-items-end' }}">
                        <div class="col-lg-7">
                            <label for="">Ảnh giảng viên</label>
                            <input type="text" name="image" id="image"
                            class="form-control {{$errors->has('image') ? 'is-invalid' : ''}}"
                            placeholder="Hình ảnh giảng viên..." value="{{old('image')}}">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="image" data-preview="holder">
                                Chọn ảnh
                            </button>
                        </div>
                        <div class="col-lg-3">
                           <div id="holder">
                                @if (old('image'))
                                    <img style="width: 10rem; height: 10rem;" src="{{old('image')}}" />
                                @endif
                           </div>
                        </div>
                   </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{route('admin.users.index')}}" class="btn btn-danger">Huỷ</a>
            </div>
        </div>
        @csrf
    </form>
@endsection