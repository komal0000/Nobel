@extends('admin.layout.app')

@section('title', 'Popup')

@section('btn')
    <a href="{{ route('admin.popup.add') }}" class="btn btn-primary"> Add New Popup </a>
@endsection

@section('content')
    <div class="row">
        @foreach($popups as $popup)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ $popup->image }}" alt="{{ $popup->title ?? 'Popup image' }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 p-2">
                            <a href="{{ route('admin.popup.edit', $popup->id) }}" class="btn btn-sm btn-info mr-1"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.popup.del', $popup->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
