@extends('layouts.backend')
@section('title', $pageTitle)

@section('content')
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('categories::messages.name') }}</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}} title"
                        placeholder="{{ __('categories::messages.name') }}..." name="name" id="" value="{{old('name')}}" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('categories::messages.slug') }}</label>
                    <input type="text" class="form-control {{$errors->has('slug') ? 'is-invalid' : ''}} slug"
                        placeholder="{{ __('categories::messages.slug') }}..." name="slug" id="" value="{{old('slug')}}" />
                    @error('slug')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">{{ __('categories::messages.category') }}</label>
                    <select name="parent_id" id="" class="form-select {{$errors->has('parent_id') ? 'is-invalid' : ''}}">
                        <option value="0">{{ __('categories::messages.parent_category') }}</option>
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
                <button type="submit" class="btn btn-primary">{{ __('categories::messages.save_category') }}</button>
                <a href="{{route('admin.categories.index')}}" class="btn btn-danger">{{ __('categories::messages.cancel_button') }}</a>
            </div>
        </div>
        @csrf
    </form>
@endsection