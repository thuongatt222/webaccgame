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
                <div class="card-header">Cập nhật nick</div>
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
                    <a href="{{ route('nick.index') }}" class="btn btn-success">Liệt kê nick</a>
                    <a href="{{ route('nick.create') }}" class="btn btn-success">Thêm nick</a>
                    <form action="{{ route('nick.update', $nick->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$nick->title}}" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea name="description" class="form-control" value="{{$nick->description}}" placeholder="..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" class="form-control-file" name="image" placeholder="...">
                            <img src="{{asset('uploads/nick'.$nick->image)}}" alt="" width="100%" height="150px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="text" class="form-control" name="price" value="{{$nick->price}}" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Trạng thái</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                @if ($nick->status == 1)
                                    <option value="1" selected>Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                @else
                                    <option value="1">Hiển thị</option>
                                    <option value="0" selected>Không hiển thị</option>
                                @endif

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Game</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                                @foreach ($category as $cate)
                                    <option {{$cate->id == $accessories->category_id ? 'selected' : ''}} value="{{$cate->id}}">{{$cate->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc tính</label>
                            <textarea name="attribute" class="form-control" value="{{$nick->attribute}}" placeholder="..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
