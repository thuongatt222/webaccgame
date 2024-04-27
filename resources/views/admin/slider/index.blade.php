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
                <div class="card-header">Liệt kê slider</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('slider.create') }}" class="btn btn-success">Thêm slider</a>
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên thư mục</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hiển thị</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slider as $key => $sli)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $sli->title }}</td>
                                    <td>{{ $sli->description }}</td>
                                    <td>
                                        @if ($sli->status == 0)
                                            Không hiển thị
                                        @else
                                            Hiển thị
                                        @endif
                                    </td>
                                    <td><img src="{{ asset('uploads/slider/' . $sli->image) }}" alt=""
                                            height="150px" width="300px"></td>
                                    <td>
                                        <form action="{{ route('slider.destroy', $sli->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa slider này không?');"
                                                class="btn btn-danger">Xóa</button>
                                        </form>
                                        <a href="{{ route('slider.edit', $sli->id) }}" class="btn btn-warning">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$slider->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
@endsection
