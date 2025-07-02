@extends('admin.layout.app')
@section('title')
    <span>Health Library</span>
@endsection
@section('content')

    <form action="{{ route('admin.setting.healthLibrary') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @php
                $healthLibraryData = [];
                if (isset($healthLibrary) && $healthLibrary->value) {
                    $healthLibraryData = json_decode($healthLibrary->value, true) ?? [];
                }
            @endphp

            @for ($i = 0; $i < 4; $i++)
                @php
                    $item = $healthLibraryData[$i] ?? null;
                @endphp
                <div class="col-md-6 mb-4">
                    <div class="border p-3">
                        <h6 class="mb-3">Health Library Item {{ $i + 1 }}</h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title_{{ $i }}">Title <span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('items.' . $i . '.title') is-invalid @enderror"
                                    id="title_{{ $i }}" name="items[{{ $i }}][title]"
                                    value="{{ old('items.' . $i . '.title', $item['title'] ?? '') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="link_{{ $i }}">Link <span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('items.' . $i . '.link') is-invalid @enderror"
                                    id="link_{{ $i }}" name="items[{{ $i }}][link]"
                                    value="{{ old('items.' . $i . '.link', $item['link'] ?? '') }}" required>
                                @error('items.' . $i . '.link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="image_{{ $i }}">Image (960x720px or 1920x1440px) <span style="color: red;">*</span></label>
                                <input type="file" class="form-control dropify @error('items.' . $i . '.image') is-invalid @enderror"
                                    id="image_{{ $i }}" name="items[{{ $i }}][image]"
                                    accept="image/*"
                                    @if(!$item || !isset($item['image'])) required @endif
                                    @if(isset($item['image'])) data-default-file="{{ asset($item['image']) }}" @endif>

                                @if(isset($item['image']))
                                    <small class="text-muted">Current image: {{ basename($item['image']) }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>
        </div>
    </form>
@endsection
