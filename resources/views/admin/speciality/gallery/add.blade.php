@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helpers\Helper::getSpecialityRoutes($parent_speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Specialties</span>/
        <span>{{ $speciality->title }}</span> /
        <a
            href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id, 'parent_speciality_id' => $parent_speciality_id]) }}">Galleries</a>
        /
        <span>Add</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        <span>{{ $speciality->title }}</span> /
        <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id]) }}">Galleries</a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form
        action="{{ route('admin.speciality.gallery.add', ['speciality_id' => $speciality->id, 'parent_speciality_id' => $parent_speciality_id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="icon">Icon <span style="color: red;">*</span></label>
                <input type="file" class="form-control dropify" id="icon" name="icon" accept="image/*">
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-2">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="description">Description <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
