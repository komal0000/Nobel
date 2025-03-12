@extends('admin.layout.app')
@section('title')
<a href="{{route('admin.technology.index')}}">Technologies</a> /
<span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.technology.add') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="speciality_id">Speciality</label>
                <select name="speciality_id" id="speciality_id" class="form-control">
                    @foreach ($specialities as $speciality)
                        <option value="{{ $speciality->id }}">{{ $speciality->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="short_description">Short Description <span style="color: red;">*</span></label>
                <input type="text" name="short_description" id="short_description" class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
