@extends('layouts.backend')
@section('title', $pageTitle)
@section('content')
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.name') }}</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}} title"
                        placeholder="{{ __('courses::messages.name') }}..." name="name" id="" value="{{old('name')}}" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.slug') }}</label>
                    <input type="text" class="form-control {{$errors->has('slug') ? 'is-invalid' : ''}} slug"
                        placeholder="{{ __('courses::messages.slug') }}..." name="slug" id="" value="{{old('slug')}}" />
                    @error('slug')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.group') }}</label>
                    <select name="teacher_id" id="" class="form-select {{$errors->has('teacher_id') ? 'is-invalid' : ''}}">
                        <option value="0" {{old('')}}>{{ __('courses::messages.choose_a_lecturer') }}</option>
                        @if($teacher) 
                            @foreach($teacher as $item)
                                <option value="{{$item->id}}"
                                    {{old('teacher_id') == $item->id ? 'selected' : false}}>{{$item->name}}
                                </option>
                            @endforeach
                        @endif
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
                    <label for="">{{ __('courses::messages.course_code') }}</label>
                    <input type="text"  name="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"
                        placeholder="{{ __('courses::messages.course_code') }}..." name="code" id="" value="{{old('code')}}"/>
                    @error('code')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.course_price') }}</label>
                    <input type="number"  name="price" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}"
                        placeholder="{{ __('courses::messages.course_price') }}..." name="price" id="" value="{{old('price')}}"/>
                    @error('price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.promotional_price') }}</label>
                    <input type="number"  name="sale_price" class="form-control {{$errors->has('sale_price') ? 'is-invalid' : ''}}"
                        placeholder="{{ __('courses::messages.promotional_price') }}..." name="sale_price" id="" value="{{old('sale_price')}}"/>
                    @error('sale_price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.attached_documents') }}</label>
                    <select name="is_document" id="" class="form-select {{$errors->has('is_document') ? 'is-invalid' : ''}}">
                        <option value="0" {{old('is_document') == 0 ? 'selected' : false}}>{{ __('courses::messages.No') }}</option>
                        <option value="1" {{old('is_document') == 1 ? 'selected' : false}}>{{ __('courses::messages.Yes') }}</option>
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
                    <label for="">{{ __('courses::messages.status_course') }}</label>
                     <select name="status" id="" class="form-select {{$errors->has('status') ? 'is-invalid' : ''}}">
                        <option value="0" {{old('status') == 0 ? 'selected' : false}}>{{ __('courses::messages.courses_not_yet') }}</option>
                        <option value="1" {{old('status') == 0 ? 'selected' : false}}>{{ __('courses::messages.courses_taken_place') }}</option>
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
                    <label for="">{{ __('courses::messages.course_support_infomation') }}</label>
                    <textarea name="supports" id="" class="form-control {{$errors->has('supports') ? 'is-invalid' : ''}}" placeholder="{{ __('courses::messages.course_support_infomation') }}...">{{ old('supports')}}</textarea>
                    @error('supports')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.category_course') }}</label>
                    <div class="list-categories">
                        {{
                            getCategoriesCheckbox($categories, old('categories'))
                        }}
                    </div>
                    @error('categories')
                        <div class="invalid-feedback d-block">
                            {{$message}}
                        </div>
                    @enderror
                    
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.course_type') }}</label>
                     <select name="type_id" id="type_id" class="form-control" class="form-select {{$errors->has('type_id') ? 'is-invalid' : ''}}">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == 1 ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            

            <div class="col-12">
                <div class="mb-3">
                    <label for="">{{ __('courses::messages.intension') }}</label>
                    <textarea name="detail" id="" class="form-control ckeditor {{$errors->has('detail') ? 'is-invalid' : ''}}" placeholder="{{ __('courses::messages.intension') }}...">{{ old('detail')}}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                   <div class="row {{$errors->has('thumbnail') ? 'align-items-center' : 'align-items-end' }}">
                        <div class="col-lg-7">
                            <label for="">{{ __('courses::messages.thumbnail') }}</label>
                            <input type="text" name="thumbnail" id="thumbnail"
                            class="form-control {{$errors->has('thumbnail') ? 'is-invalid' : ''}}"
                            placeholder="{{ __('courses::messages.thumbnail') }}..." value="{{old('thumbnail')}}">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="thumbnail" data-preview="holder">
                                {{ __('courses::messages.select_photo') }}
                            </button>
                        </div>
                        <div class="col-lg-3">
                           <div id="holder">
                                @if (old('thumbnail'))
                                    <img src="{{old('thumbnail')}}" />
                                @endif
                           </div>
                        </div>
                   </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{ __('courses::messages.save_course') }}</button>
                <a href="{{route('admin.courses.index')}}" class="btn btn-danger">{{ __('courses::messages.cancel_course') }}</a>
            </div>
        </div>
        @csrf
    </form>
@endsection

@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto !important;
        }

        #holder img {
            width: 100% !important;
        }

        .list-categories{
            max-height: 250px;
            overflow: auto;
        }
    </style>
@endsection