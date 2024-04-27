@extends('layouts.app')
@section('navbar')
    <div class="container">
        @include('admin.include.navbar')
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật slider</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('slider.index') }}" class="btn btn-success">Liệt kê slider</a>
                    <a href="{{ route('slider.create') }}" class="btn btn-success">Thêm slider</a>
                    <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $slider->title }}"
                                placeholder="...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea name="description" class="form-control" placeholder="...">{{ $slider->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" class="form-control-file" name="image" placeholder="...">
                            <img src="{{ asset('uploads/slider/' . $slider->image) }}" alt="" height="150px"
                                width="100%">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Trạng thái</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                @if ($slider->status == 1)
                                    <option value="1" selected>Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                @else
                                    <option value="1">Hiển thị</option>
                                    <option value="0" selected>Không hiển thị</option>
                                @endif

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
