@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.video.type.index') }}">Video Types</a> /

    <span>{{ $videoType->title }}</span> /
    <span>Videos</span>
@endsection
@section('content')
    <div class="p-3 shadow">
        <div class="row">
            <input type="hidden" name="video_link" id="video_link" >
            <div class="col-md-12 mb-3">
                <div class="tab-pane pt-3 mb-2" id="video" role="tabpanel" aria-labelledby="video-tab">
                    <label for="youtube_link">Youtube link</label>
                    <input type="hidden" name="image" id="video-image">
                    <input type="url" class="form-control " placeholder="Enter Youtube Url" onchange="GetMedia(this)">
                    <div id="video-preview-panel" style="display: none;">
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <img class="w-100" id="video-image-preview" alt="">
                            </div>
                            <div class="col-3">
                                <iframe id="video-video-preview" class="w-100 h-100" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="col-md-12 mt-2 d-flex justify-content-end">
                <button class="btn btn-primary btn-sm" onclick="saveVideo()">
                    Save Video
                </button>
            </div>
        </div>
    </div>
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
                    $('#video_link').val(data.video_id);
                })
                .catch(err => {
                    console.error(err);
                })
        }

        function saveVideo() {
            const title = $('#title').val();
            const video_link = $('#video_link').val();
            axios.post('{{ route('admin.video.index', ['type_id' => $videoType->id]) }}', {
                    video_link: video_link,
                    title: title,
                })
                .then(res => {
                    if (res.data.success){
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        }
    </script>
@endsection
