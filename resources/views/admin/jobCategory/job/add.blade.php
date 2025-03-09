@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.jobCategory.index') }}">Job Categories</a> /
    <a href="{{route('admin.jobCategory.job.index',['jobCategory_id'=>$jobCategory->id])}}">Jobs</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.jobCategory.job.add', $jobCategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-2">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="col-md-3 mb-2">
                <label for="type">Type <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="type" name="type">
            </div>
            <div class="col-md-3 mb-2">
                <label for="location">Location <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            <div class="col-md-3 mb-2">
                <label for="date">Date <span style="color: red;">*</span></label>
                <input type="date" class="form-control" id="date" name="date">
            </div>

            <div class="col-md-6 mb-2">
                <label for="qualification">Qualification <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="qualification" name="qualification">
            </div>
            <div class="col-md-6 mb-2">
                <label for="experience">Experience <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="experience" name="experience">
            </div>
            <div class="col-md-12 mb-3">
                <label for="description">Description <span style="color: red;">*</span></label>
                <textarea class="form-control summernote" id="description" name="description"></textarea>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
