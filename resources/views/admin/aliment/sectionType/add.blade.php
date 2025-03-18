@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.aliment.sectionType.index') }}">Aliment Section Type</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.aliment.sectionType.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="icon">Icon <span style="color: red;">*</span></label>
                <input type="file" name="icon" id="icon" class="form-control dropify" accept="image/*" required>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="description">Description </label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
