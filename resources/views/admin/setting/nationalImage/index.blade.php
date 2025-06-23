@extends('admin.layout.app')
@section('title')
    National Image
@endsection
@section('btn')
    <a href="{{ route('admin.setting.nationalImage.add') }}" class="btn btn-primary">Add</a>
@endsection

@section('content')
    <div class="p-4">
        @if ($data)
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="border rounded p-2 mb-2">
                        <div class="image">
                            <img src="{{ asset($data['desktopImage']) }}" alt="Slider Image" height="100px" class="img-fluid">
                        </div>
                        <br>
                        <div class="option">
                            <a href="{{ route('admin.setting.nationalImage.edit') }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('admin.setting.nationalImage.del') }}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
@endsection
