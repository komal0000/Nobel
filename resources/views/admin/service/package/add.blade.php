@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <a href="{{ route('admin.service.package.type.index', ['service_id' => $packageType->service_id]) }}">Service Package
        Types</a> /
    <span>{{ $packageType->type }}</span> /
    <span>Add Package</span>
@endsection
@section('content')
    <form action="{{ route('admin.service.package.add', ['type_id' => $packageType->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($packageType->type == 'Type 1')
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12 mb-3">
                        <label for="image">Package Image <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="price">Price <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($packageCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="labtest">Lab Test</label>
                            <input type="number" class="form-control" id="labtest" name="labtest">
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="price">Price <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="price" name="price" required>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="description">Description</label>
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
