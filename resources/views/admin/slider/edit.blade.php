@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.slider.index', $slider->id) }}">Sliders</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.slider.edit', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="desktop_image">Desktop Image (1920x480px) <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="desktop_image" name="desktop_image" accept="image/*" data-default-file="{{ asset($slider->desktop_image) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mobile_image">Mobile Image (960x720px or 1920x1440px) <span style="color: red;">*</span></label>
                        <input type="file" class="form-control dropify" id="mobile_image" name="mobile_image" accept="image/*" data-default-file="{{ asset($slider->mobile_image) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-4 mb-2">
                    <div class="form-check d-block">
                        <input type="hidden" name="has_link" value="0">
                        <input class="form-check-input" type="checkbox" onclick="toggle()" id="has_link" value="1" name="has_link" {{ $slider->has_link ? 'checked' : '' }}>
                        <label class="form-check-label" for="has_link">
                            Has Link
                        </label>
                    </div>
                </div>
                <div class="row" id="extra" style="display: {{ $slider->has_link ? 'block' : 'none' }}">
                    <div class="col-md-12 mb-3">
                        <label for="link_url">Link URL</label>
                        <input type="text" class="form-control" id="link_url" name="link_url" value="{{ $slider->link_url }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="link_text">Link Text</label>
                        <input type="text" class="form-control" id="link_text" name="link_text" value="{{ $slider->link_text }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    Update
                </button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        function toggle() {
            if ($('#has_link').is(':checked')) {
                $('#extra').show();
            } else {
                $('#extra').hide();
            }
        }
    </script>
@endsection
