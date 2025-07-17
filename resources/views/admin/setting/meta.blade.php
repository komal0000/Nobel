@extends('admin.layout.app')
@section('title')
    <span>Meta Data</span>
@endsection
@section('content')
    <form action="{{ route('admin.setting.metaData') }}" method="post">
        @csrf
        <div class="col-md-12 my-2">
            <label for="description" class="form-label">Description (~40 words) <span style="color: red;">*</span> </label>
            <input type="text" name="description" id="description" class="form-control" required
                value="{{ old('description', default: $values['description'] ?? '') }}">

        </div>
        <div class="col-md-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success">
                Save
            </button>
        </div>
    </form>
@endsection
