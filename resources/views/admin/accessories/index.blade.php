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
                <div class="card-header">Liệt kê accessories</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('accessories.create') }}" class="btn btn-success">Thêm accessories</a>
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên phụ kiện</th>
                                <th scope="col">Hiển thị</th>
                                <th scope="col">Game</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accessories as $key => $acc)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $acc->title }}</td>
                                    <td>
                                        @if ($acc->status == 0)
                                            Không hiển thị
                                        @else
                                            Hiển thị
                                        @endif
                                    </td>
                                    <td>{{$acc->category->title}}</td>
                                    <td>
                                        <form action="{{ route('accessories.destroy', $acc->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa accessories này không?');"
                                                class="btn btn-danger">Xóa</button>
                                        </form>
                                        <a href="{{ route('accessories.edit', $acc->id) }}" class="btn btn-warning">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$accessories->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
@endsection
