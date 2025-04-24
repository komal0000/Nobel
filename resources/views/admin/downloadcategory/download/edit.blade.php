@extends('admin.layout.app')
@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.downloadCategory.index') }}">Download Categories</a> /
        @php
            $parents = \App\Helpers\Helper::getParentRoute($parent_id, 'download_Categories', 'downloadCategory');

        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.downloadCategory.index', ['parent_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach
        <span>Sub Category</span> /
        <a
            href="{{ route('admin.downloadCategory.download.index', ['category' => $downloadCategory->id, 'parent_id' => $parent_id]) }}">Downloads</a>
        /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.downloadCategory.index') }}">Download Categories</a> /
        <a href="{{ route('admin.downloadCategory.download.index', ['category' => $downloadCategory->id]) }}">Downloads</a> /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <form
        action="{{ route('admin.downloadCategory.download.edit', ['category' => $downloadCategory->id, 'download' => $download->id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-6">
                <div class="col-md-12">
                    <label for="link">Pdf <span style="color: red;">*</span></label>
                    <input type="file" name="link" id="link" class="form-control dropify"
                        accept=".pdf,application/pdf" data-default-file="{{ asset($download->link) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $download->title }}"
                        required>
                </div>
                <div class="row d-flex align-items-end">
                    <div class="col-md-8">
                        <label for="uploaded_date">Uploaded Date <span style="color: red;">*</span></label>
                        <input type="date" name="uploaded_date" id="uploaded_date" class="form-control" value="{{ $download->uploaded_date }}" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
