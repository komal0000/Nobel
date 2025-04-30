@extends('admin.layout.app')

@section('title')

    @php
        $typeNames = [];
        foreach (\App\Helper::blog_types as $key => $value) {
            $typeNames[$key] = ucfirst(str_replace('_', ' ', $value));
        }
    @endphp
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $blogCategory->type]) }}">
            {{ isset($typeNames[$blogCategory->type]) ? $typeNames[$blogCategory->type] . ' Categories' : 'Categories' }}
        </a> /
        @php
            $parents = \App\Helper::getParentRoute($parent_id, 'blog_categories', 'blogCategory', $blogCategory->type);
        @endphp
        @foreach ($parents as $parent)
            <a
                href="{{ route('admin.blogCategory.index', ['type' => $blogCategory->type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Category</span> /
        <span>{{ $blogCategory->title }}</span> /
        <a
            href="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory->id, 'type' => $blogCategory->type, 'parent_id' => $parent_id]) }}">
            {{ isset($typeNames[$blogCategory->type]) ? rtrim($typeNames[$blogCategory->type], 's') : 'Content' }}
        </a> /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $blogCategory->type]) }}">
            {{ isset($typeNames[$blogCategory->type]) ? $typeNames[$blogCategory->type] . ' Categories' : 'Categories' }}
        </a> /
        <span>{{ $blogCategory->title }}</span> /
        <a
            href="{{ route('admin.blogCategory.blog.index', ['blogCategory_id' => $blogCategory->id, 'type' => $blogCategory->type, 'parent_id' => $parent_id]) }}">
            {{ isset($typeNames[$blogCategory->type]) ? rtrim($typeNames[$blogCategory->type], 's') : 'Content' }}
        </a> /
        <span>Edit</span>
    @endif
@endsection

@section('content')

    <form action="{{ route('admin.blogCategory.blog.edit', ['blog_id' => $blog->id, 'parent_id' => $parent_id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="col-md-12 mb-3">
                    <div class="tab-pane mb-2" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <label for="video_link">Youtube link</label>
                        <input type="url" name="video_link" class="form-control" value="{{ $blog->video_link }}"
                            placeholder="Enter Youtube Url" onchange="GetMedia(this)">
                        <div id="video-preview-panel" style="display: none;">
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <iframe id="video-video-preview" class="w-100" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="image"></label>
                            @php
                                $imageLabels = [
                                    1 => 'Image 4:3',
                                    2 => 'Image 4:3',
                                    3 => 'Image 4:3',
                                    4 => 'Icon',
                                    5 => 'Image 4:3',
                                    6 => 'PDF',
                                ];
                                $isRequired = in_array($blogCategory->type, [1, 2, 3, 5, 6]);
                            @endphp

                            {{ $imageLabels[$blogCategory->type] ?? 'Image' }}
                            @if ($isRequired)
                                <span style="color: red;">*</span>
                            @endif
                            @if ($blogCategory->type != 6)
                                <input type="file" name="image" id="image" class="form-control dropify"
                                    accept="image/*" data-default-file="{{ asset($blog->image) }}">
                            @endif
                            @if ($blogCategory->type == 6)
                                <input type="file" name="pdf" id="pdf" class="form-control dropify"
                                    accept="application/pdf" data-default-file="{{ asset($blog->image) }}">
                            @endif

                    </div>
                    @if ($blogCategory->type == 6)
                    @else
                        <div class="col-md-6">
                            <label for="single_page_image">Single Page Image</label>
                            <input type="file" name="single_page_image" id="single_page_image"
                                class="form-control dropify" accept="image/*"
                                data-default-file="{{ asset($blog->single_page_image) }}">
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-7">
                <div class="row d-flex align-items-end">
                    @if ($blogCategory->type == 4)
                        <div class="" style="display: none">
                            <div class="col-md-4 mb-2 d-flex align-items-center" style="display: none">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input me-2"
                                    @if ($blog->is_featured) checked @endif>
                                <label for="is_featured">Is Featured</label>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4 mb-2 d-flex align-items-center">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" class="form-check-input me-2"
                                @if ($blog->is_featured) checked @endif>
                            <label for="is_featured">Is Featured</label>
                        </div>
                    @endif
                    <div class="col-md-8 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ $blog->title }}" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="date">Date <span style="color: red;">*</span></label>
                        <input type="date" name="date" id="date" class="form-control"
                            value="{{ \App\Helper::convertIntegerToDate($blog->date) }}">
                    </div>
                    @if ($blogCategory->type == 4)
                    @else
                        <div class="col-md-6 mb-2">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                value="{{ $blog->location }}">
                        </div>
                    @endif
                    @if ($blogCategory->type == 5)
                        <div class="col-md-6">
                            <label for="submitted_by">Submitted By</label>
                            <input type="text" name="submitted_by" id="submitted_by" class="form-control"
                                value="{{ $blog->submitted_by }}">
                        </div>
                        <div class="col-md-6">
                            <label for="position">Position</label>
                            <input type="text" name="position" id="position" class="form-control"
                                value="{{ $blog->position }}">
                        </div>
                    @else
                        <div class="col-md-12">
                            <label for="short_description">Short Description @if ($blogCategory->type == 6)
                                @else
                                    <span style="color: red;">*</span>
                                @endif
                            </label>
                            <input type="text" name="short_description" id="short_description" class="form-control"
                                value="{{ $blog->short_description }}">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 my-2">
            <label for="text_data">Text </label>
            <textarea type="text" name="text" id="text" class="form-control summernote">{{ $blog->text }}</textarea>
        </div>
        <div class="col-md-12 my-2 d-flex justify-content-end">
            <button class="btn btn-success">
                Update
            </button>
        </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        const GetMedia = (ele) => {
            getYoutubeData(ele.value)
                .then((data) => {
                    console.log(data);
                    $('#video-image-preview').attr('src', data.image);
                    $('#video-video-preview').attr('src', data.embed);
                    $('#video-preview-panel').show();
                    $('#title').val(data.title);
                })
                .catch(err => {
                    console.error(err);
                })
        }
    </script>
@endsection
