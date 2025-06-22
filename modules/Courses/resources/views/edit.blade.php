@extends('layouts.backend')
@section('content')
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                        placeholder="Tên..." name="name" id="" value="{{old('name') ?? $user->name}}" />
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                        placeholder="Tên..." name="email" id="" value="{{old('email') ?? $user->email}}" />
                    @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Nhóm</label>
                    <select name="group_id" id="" class="form-select {{$errors->has('group_id') ? 'is-invalid' : ''}}">
                        <option value="0">Chọn nhóm</option>
                        <option value="1">Adminstrator</option>
                    </select>
                    @error('group_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mật khẩu</label>
                    <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                        placeholder="Mật khẩu..." name="password" id="" />
                    @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{route('admin.users.index')}}" class="btn btn-danger">Huỷ</a>
            </div>
        </div>
        @csrf
        @method('PUT')

    </form>
@endsection