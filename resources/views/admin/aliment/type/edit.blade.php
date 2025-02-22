@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.index') }}">Alignment</a> /
    <a href="{{route('admin.aliment.type.index',['aliment_id'=>$alimentType->aliment_id])}}">Types</a> /
    <span>Edit</span>
@endsection
@section('content')
    <div class="p-4">
        <form action="{{route('admin.aliment.type.edit', ['type_id' => $alimentType->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="icon">Icon</label>
                    <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*" data-default-file="{{Storage::url($alimentType->icon)}}">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $alimentType->title }}">
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $alimentType->description }}</textarea>
                        </div>
                        <div class="col-md-12" d-flex align-items-end>
                            <button class="btn btn-primary btn-sm">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
