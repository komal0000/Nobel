@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.slider.type.index') }}">Slider Types</a> /
    <span>Sliders</span>
@endsection
@section('btn')
    <a href="{{ route('admin.slider.add', ['type_id' => $sliderType->id]) }}" class="btn btn-primary">Add</a>
@endsection

@section('content')
    <div class="p-4">
        <div class="row">
            @foreach ($sliders as $slider)
                <div class="col-md-4 mb-4">
                    <div class="border rounded p-2 mb-2">
                        <div class="image">
                            <img src="{{ asset($slider->mobile_image) }}" alt="Slider Image" height="100px"
                                class="img-fluid">
                        </div>
                        <br>
                        <div class="option">
                            <a href="{{ route('admin.slider.edit', ['slider_id' => $slider->id]) }}"
                                class="btn btn-warning">Edit</a>
                            <a href="{{ route('admin.slider.del', ['slider_id' => $slider->id]) }}"
                                class="btn btn-danger">Delete</a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
@endsection
