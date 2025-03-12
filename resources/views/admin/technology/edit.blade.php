@extends('admin.layout.app')
@section('title')
<a href="{{route('admin.technology.index')}}">Technologies</a> /
<span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.technology.edit', $technology->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $technology->title }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="speciality_id">Speciality</label>
                <select name="speciality_id" id="speciality_id" class="form-control">
                    @foreach ($specialities as $speciality)
                        <option value="{{ $speciality->id }}" {{ $speciality->id == $technology->speciality_id ? 'selected' : '' }}>{{ $speciality->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="short_description">Short Description <span style="color: red;">*</span></label>
                <input type="text" name="short_description" id="short_description" class="form-control" value="{{ $technology->short_description }}">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">
                    Update
                </button>
            </div>
        </div>
    </form>
@endsection
