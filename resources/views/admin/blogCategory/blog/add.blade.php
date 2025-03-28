@extends('admin.layout.app')

@section('title')
    @if ($parent_id)
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1)
                Blogs Categories
            @elseif ($type == 2)
                News Categories
            @elseif($type == 3)
                Event Categories
            @else
                Update Categories
            @endif
        </a> /
        @php
            $parents = \App\Helper::getParentRoute($parent_id, 'blog_Categories', 'blogCategory', $type);
        @endphp
        @foreach ($parents as $parent)
            <a
                href="{{ route('admin.blogCategory.index', ['type' => $type, 'parent_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Category</span> /
        <span>{{ $blogCategory->title }}</span> /
        <a
            href="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory->id, 'type' => $type, 'parent_id' => $parent_id]) }}">
            @if ($type == 1)
                Blogs
            @elseif ($type == 2)
                News
            @elseif($type == 3)
                Events
            @else
                Updates
            @endif
        </a> /
        <span>Add</span>
    @else
        <a href="{{ route('admin.blogCategory.index', ['type' => $type]) }}">
            @if ($type == 1)
                Blogs Categories
            @elseif ($type == 2)
                News Categories
            @elseif($type == 3)
                Event Categories
            @else
                Update Categories
            @endif
        </a> /
        <span>{{ $blogCategory->title }}</span> /
        <a
            href="{{ route('admin.blogCategory.blog.index', ['blogCategory_id' => $blogCategory->id, 'type' => $type, 'parent_id' => $parent_id]) }}">
            @if ($type == 1)
                Blogs
            @elseif ($type == 2)
                News
            @elseif($type == 3)
                Events
            @else
                Updates
            @endif
        </a> /
        <span>Add</span>
    @endif
@endsection
@section('content')
    <form
        action="{{ route('admin.blogCategory.blog.add', ['blogCategory_id' => $blogCategory->id, 'type' => $type, 'parent_id' => $parent_id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="col-md-12 mb-3">
                    <div class="tab-pane mb-2" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <label for="video_link">Youtube link</label>
                        <input type="url" name="video_link" class="form-control " placeholder="Enter Youtube Url"
                            onchange="GetMedia(this)">
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
                <div class="col-md-12">
                    <label for="image">Image </label>
                    <input type="file" name="image" id="image" class="form-control dropify" accept="image/*">
                </div>
            </div>
            <div class="col-md-7">
                <div class="row d-flex align-items-end">
                    @if ($blogCategory->type == 4)
                        <div class="" style="display: none">
                            <div class="col-md-4 mb-2 d-flex align-items-center" style="display: none">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input me-2">
                                <label for="is_featured">Is Featured</label>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4 mb-2 d-flex align-items-center">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" class="form-check-input me-2">
                            <label for="is_featured">Is Featured</label>
                        </div>
                    @endif
                    <div class="col-md-8 mb-2">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="date">Date <span style="color: red;">*</span></label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    @if ($blogCategory->type == 4)
                    @else
                        <div class="col-md-6 mb-2">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>
                    @endif
                    <div class="col-md-12">
                        <label for="short_description">Short Description</label>
                        <input type="text" name="short_description" id="short_description" class="form-control">
                    </div>


                </div>

            </div>
            <div class="col-md-12 my-2">
                <label for="text_data">Text <span style="color: red;">*</span></label>
                <textarea type="text" name="text" id="text" class="form-control summernote" required></textarea>
            </div>
            <div class="col-md-12 my-2 d-flex justify-content-end">
                <button class="btn btn-success">
                    Save
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
