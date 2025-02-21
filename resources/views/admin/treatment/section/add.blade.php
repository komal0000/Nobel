@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
    <a href="{{route('admin.treatment.section.index',['treatment_id'=>$treatment_id])}}">Sections</a> /
    <span> Add Section</span>
@endsection
@section('content')
    <form action="{{ route('admin.treatment.section.add',['treatment_id'=>$treatment_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="col-md-8 mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label for="style_type">Style Type</label>
                <input type="text" class="form-control" id="style_type" name="style_type">
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    Add Section
                </button>
            </div>
        </div>
    </form>
@endsection
