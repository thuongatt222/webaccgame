@extends('layouts.app')
@section('navbar')
    <div class="container">
        @include('admin.include.navbar')
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Liệt kê blog</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('blog.create') }}" class="btn btn-success">Thêm blog</a>
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên tiêu đề</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Hiển thị</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blog as $key => $bl)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $bl->title }}</td>
                                    <td>{!! $bl->description !!}</td>
                                    <td>{{ $bl->content }}</td>
                                    <td>
                                        @if ($bl->status == 0)
                                            Không hiển thị
                                        @else
                                            Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{ asset('uploads/blog/' . $bl->image) }}" alt=""
                                            height="150px" width="150px"></td>
                                    <td>
                                        <form action="{{ route('blog.destroy', $bl->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa blog này không?');"
                                                class="btn btn-danger">Xóa</button>
                                        </form>
                                        <a href="{{ route('blog.edit', $bl->id) }}" class="btn btn-warning">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$blog->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
@endsection
