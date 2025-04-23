@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <a href="{{ route('admin.service.faq.index', ['service_id' => $service->id]) }}">FAQs</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.service.faq.edit', ['faq_id' => $faq->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="question">Question <span style="color: red;">*</span></label>
                <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}"
                    required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="answer">Answer <span style="color: red;">*</span></label>
                <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
