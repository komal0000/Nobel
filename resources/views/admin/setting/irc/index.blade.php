@extends('admin.layout.app')
@section('title')
    <span>IRC</span>
@endsection
@section('content')
    <form action="{{ route('admin.setting.irc') }}" method="post">
        @csrf
        <div class="col-md-6 my-2">
            <label for="ircTitle" class="form-label">Title <span style="color: red;">*</span></label>
            <input type="text" name="title" id="ircTitle" class="form-control" required
                value="{{ old('title', $irc->title ?? '') }}">
        </div>
        <div class="col-md-12 my-2">
            <label for="description" class="form-label">Description <span style="color: red;">*</span> </label>
            <textarea type="text" name="description" id="description" class="form-control summernote" required>
               {{ old('description', $irc->description ?? '') }}
            </textarea>
        </div>
        <div class="col-md-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success">
                Save
            </button>
        </div>
    </form>
@endsection
