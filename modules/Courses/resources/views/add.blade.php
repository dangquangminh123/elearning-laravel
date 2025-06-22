@extends('layouts.backend')
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
                    <label for="">Nhóm</label>
                    <select name="teacher_id" id="" class="form-select {{$errors->has('teacher_id') ? 'is-invalid' : ''}}">
                        <option value="0">Chọn giảng viên</option>
                        <option value="1">Hoàng an</option>
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã khoá học</label>
                    <input type="text"  name="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"
                        placeholder="Mã khoá học..." name="code" id="" />
                    @error('code')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khoá học</label>
                    <input type="number"  name="price" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}"
                        placeholder="Giá khoá học..." name="price" id="" />
                    @error('price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khuyến mãi</label>
                    <input type="number"  name="sale_price" class="form-control {{$errors->has('sale_price') ? 'is-invalid' : ''}}"
                        placeholder="Giá khuyến mãi..." name="sale_price" id="" />
                    @error('sale_price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tài liệu đính kèm</label>
                    <select name="is_document" id="" class="form-select {{$errors->has('is_document') ? 'is-invalid' : ''}}">
                        <option value="0">Không</option>
                        <option value="1">Có</option>
                    </select>
                    @error('is_document')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Trạng thái</label>
                     <select name="status" id="" class="form-select {{$errors->has('status') ? 'is-invalid' : ''}}">
                        <option value="0">Chưa diễn ra</option>
                        <option value="1">Đã diễn ra</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Thông tin hỗ trợ khoá học</label>
                    <textarea name="supports" id="" class="form-control {{$errors->has('supports') ? 'is-invalid' : ''}}" placeholder="thông tin hỗ trợ khoá học..."></textarea>
                    @error('supports')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Nội dung</label>
                    <textarea name="detail" id="" class="form-control ckeditor {{$errors->has('detail') ? 'is-invalid' : ''}}" placeholder="Nội dung..."></textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                   <div class="row align-items-end">
                        <div class="col-lg-7">
                            <label for="">Ảnh đại diện</label>
                            <input type="text" name="thumbnail" id=""
                            class="form-select {{$errors->has('thumbnail') ? 'is-invalid' : ''}}"
                            placeholder="Ảnh đại diện...">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary">
                                Chọn ảnh
                            </button>
                        </div>
                        <div class="col-lg-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/800px-Laravel.svg.png" alt="" />
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

@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection