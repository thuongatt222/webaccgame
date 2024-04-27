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
                <div class="card-header">Liệt kê danh mục game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('category.create') }}" class="btn btn-success">Thêm danh mục game</a>
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên thư mục</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hiển thị</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $cate)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $cate->title }}</td>
                                    <td>{{ $cate->slug }}</td>
                                    <td>{{ $cate->description }}</td>
                                    <td>
                                        @if ($cate->status == 0)
                                            Không hiển thị
                                        @else
                                            Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{ asset('uploads/category/' . $cate->image) }}" alt=""
                                            height="150px" width="150px"></td>
                                    <td>
                                        <form action="{{ route('category.destroy', $cate->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa danh mục game này không?');"
                                                class="btn btn-danger">Xóa</button>
                                        </form>
                                        <a href="{{ route('category.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$category->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
@endsection
