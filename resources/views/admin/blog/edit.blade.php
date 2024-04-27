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
                <div class="card-header">Cập nhật danh mục game</div>
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
                    <a href="{{ route('blog.index') }}" class="btn btn-success">Liệt kê danh mục game</a>
                    <a href="{{ route('blog.create') }}" class="btn btn-success">Thêm danh mục game</a>
                    <form action="{{ route('blog.update', $blog->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="slug" onkeyup="ChangeToSlug()"
                                name="title" value="{{ $blog->title }}" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slug" id="convert_slug"
                                value="{{ $blog->slug }}" placeholder="...">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" id="desc_blog" class="form-control" placeholder="...">{{ $blog->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control" id="content_blog" placeholder="...">{{ $blog->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control-file" name="image" placeholder="...">
                            <img src="{{ asset('uploads/blog/' . $blog->image) }}" alt="" height="150px"
                                width="150px">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Trạng thái</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                @if ($blog->status == 1)
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
