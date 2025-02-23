@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Alignment</a> /
    <a href="{{route('admin.aliment.type.index',['aliment_id'=>$aliment_id])}}">Section Types</a> /
    <span>Add</span>
@endsection
@section('content')
    <div class="p-4">
        <form action="{{route('admin.aliment.type.add',['aliment_id'=>$aliment_id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="icon">Icon</label>
                    <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12" d-flex align-items-end>
                            <button class="btn btn-success btn-sm">
                                Save
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
