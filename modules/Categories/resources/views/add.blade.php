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
                    <label for="">Danh mục</label>
                    <select name="parent_id" id="" class="form-select {{$errors->has('parent_id') ? 'is-invalid' : ''}}">
                        <option value="0">Cha</option>
                        {{getSubCategories($categories, old('parent_id'))}}

                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Huỷ</a>
            </div>
        </div>
        @csrf
    </form>
@endsection