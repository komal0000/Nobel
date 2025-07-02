@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <a href="{{ route('admin.service.faq.index', ['service_id' => $service->id]) }}">FAQs</a> /
    <span>Add</span>
@endsection
@section('content')
    <form action="{{ route('admin.service.faq.add', ['service_id' => $service->id]) }}" method="POST">
        @csrf
        <div class="row">

            <div class="col-md-12 mb-3">
                <label for="question">Question <span style="color: red;">*</span></label>
                <input type="text" name="question" id="question" class="form-control" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="answer">Answer (30-40 words) <span style="color: red;">*</span></label>
                <textarea name="answer" id="answer" class="form-control" required></textarea>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
