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
                <div class="card-header">Liệt kê nick</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('nick.create') }}" class="btn btn-success">Thêm nick</a>
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên nick</th>
                                <th scope="col">Thư viện ảnh</th>
                                <th scope="col">Mã số</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Hiển thị</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Game</th>
                                <th scope="col">Thuộc tính</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nick as $key => $acc)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $acc->title }}</td>
                                    <td><a href="{{ route('gallery.edit', $acc->id) }}" class="btn btn-primary btn-sm">Thêm
                                            thư viện ảnh</a>
                                        @if ($acc->gallery_count == 0)
                                            <span class="badge badege-dark">0 ảnh</span>
                                    </td>
                                @else
                                    <span class="badge badege-dark">{{ $acc->gallery_count }} ảnh</span></td>
                            @endif

                            <td>#{{ $acc->ms }}</td>
                            <td>{{ $acc->description }}</td>
                            <td>
                                @if ($acc->status == 0)
                                    Không hiển thị
                                @else
                                    Hiển thị
                                @endif
                            </td>
                            <td><img src="{{ asset('uploads/nick' . $acc->image) }}" alt="" height="150px"
                                    width="150px"></td>
                            <td>{{ $acc->category->title }}</td>
                            <td>
                                @php
                                    $attribute = json_decode($acc->attribute, true);
                                @endphp
                                @foreach ($attribute as $attri)
                                    <span class="badge badege-dark">{{ $attri }}</span>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('nick.destroy', $acc->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button onclick="return confirm('Bạn có muốn xóa nick này không?');"
                                        class="btn btn-danger">Xóa</button>
                                </form>
                                <a href="{{ route('nick.edit', $acc->id) }}" class="btn btn-warning">Sửa</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $nick->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
