@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.treatment.index') }}">Treatments</a> /
    <a href="{{route('admin.treatment.section.index',['treatment_id'=>$treatment_id])}}">Sections</a> /
    <span> Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.treatment.section.add',['treatment_id'=>$treatment_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="col-md-12 mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="style_type">Style Type</label>
                    <input type="text" class="form-control" id="style_type" name="style_type">
                </div>
            </div>
            <div class="col-md-7">
                <div class="col-md-12 mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
