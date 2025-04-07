@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>{{ $service->title }}</span>
@endsection
@section('btn')
    <a href="{{ route('admin.service.faq.add', ['service_id' => $service->id]) }}" class="btn btn-primary">Add FAQ</a>
@endsection
@section('content')
    <table id="datatable" class="table table-striped" data-toggle="data-table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $faq)
                <tr>
                    <td>{{ $faq->question }}</td>
                    <td>{{ Str::limit($faq->answer, 100) }}</td>
                    <td>
                        <a href="{{ route('admin.service.faq.edit', ['faq_id' => $faq->id]) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin.service.faq.del', ['faq_id' => $faq->id]) }}"
                            class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
@endsection
