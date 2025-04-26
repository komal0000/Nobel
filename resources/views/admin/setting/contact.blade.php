@extends('admin.layout.app')
@section('css')
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }

        label {
            font-weight: 600;
            font-size: 1.1rem;
            /* margin-bottom: 5px; */
            color: black;
            margin-top: 5px;
            text-transform: capitalize;
        }

        .form-control,
        .tox {
            border-radius: 5px !important;
        }

        .gmap_canvas,
        #gmap_canvas {
            height: 400px;
            width: 100%;
        }
    </style>
@endsection
@section('title')
    <span>Contact</span>
@endsection
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('admin.setting.contact') }}" method="post" enctype="multipart/form-data" id="front-setting">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="d-flex justify-content-between align-items-center px-3 py-1">
                            <span>
                                Map
                            </span>
                            <input type="text" id="map" name="map" class="form-control w-25"
                                placeholder="Search Place" value="{{ $data->map }}">
                        </h4>
                        <hr class="m-0">
                        <div class="card-body d-flex justify-content-center" id="footer-4">
                            <div style="width: 800px;">
                                <div class="gmap_canvas">
                                    <iframe id="gmap_canvas" src="" frameborder="0" scrolling="no" marginheight="0"
                                        marginwidth="0"></iframe>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control"
                        value="{{ $data->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                        value="{{ $data->email }}">
                    </div>
                    <div class="col-md-6">
                        <label for="addr">Address</label>
                        <input name="addr" id="addr" class="form-control desc" value="{{ $data->addr }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="short_desc">Short Description</label>
                        <textarea name="short_desc" id="short_desc" class="form-control">{{ $data->short_desc }}</textarea>
                    </div>

                    <div class="col-12 py-3">
                        <div class="shadow p-3">
                            <h5 class="p-2">
                                Social Links
                            </h5>
                            <hr class="m-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" id="facebook" class="form-control"
                                        value="{{ $data->links->facebook ?? '' }}" >
                                </div>
                                <div class="col-md-6">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" name="twitter" id="twitter" class="form-control"
                                        value="{{ $data->links->twitter ?? '' }}" >
                                </div>
                                <div class="col-md-6">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" name="instagram" id="instagram" class="form-control"
                                        value="{{ $data->links->instagram ?? '' }}" >
                                </div>
                                <div class="col-md-6">
                                    <label for="youtube">YouTube</label>
                                    <input type="text" name="youtube" id="youtube" class="form-control"
                                        value="{{ $data->links->youtube ?? '' }}" >
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 py-3">
                        <div class="shadow p-2">
                            <h5 class="p-2 d-flex justify-content-between align-items-center">
                                <span>
                                    Individual Detail
                                </span>
                                <button class="btn btn-success" id="addOther">
                                    Add New
                                </button>
                            </h5>
                            <hr class="m-0">

                            <div class="p-2">
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>Name</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Desination</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Phone</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Email</strong>
                                    </div>
                                </div>
                                <div id="others">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <button class="btn btn-primary">Save Contact Page Setting</button>
                </div>

            </form>
        </div>
    </div>

    <span id="others-template" class="d-none">
        <hr class="my-2">

        <div class="row" id="other-xxx_id">
            <input type="hidden" name="others[]" value="xxx_id">
            <div class="col-md-3">
                <input type="text" value="xxx_name" name="name_xxx_id" id="name_xxx_id" class="form-control"
                    required>
            </div>
            <div class="col-md-3">
                <input type="text" value="xxx_desination" name="designation_xxx_id" id="designation_xxx_id"
                    class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="text" value="xxx_phone" name="phone_xxx_id" id="phone_xxx_id" class="form-control">
            </div>
            <div class="col-md-3">
                <input type="email" value="xxx_email" name="email_xxx_id" id="email_xxx_id" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger w-100" onclick="delOther(xxx_id)">Del</button>
            </div>
        </div>
    </span>
@endsection
@section('js')
    <script>
        const mapurl = "https://maps.google.com/maps?q=xxx_map&t=&z=13&ie=UTF8&iwloc=&output=embed";
        const _template = $('#others-template').html();
        const others = {!! json_encode($data->others) !!}

        function setMap(params) {
            $('#gmap_canvas').attr('src', mapurl.replace('xxx_map', params));
        }
        i = 0;

        function addOther() {
            let temp = _template.replaceAll('xxx_id', i);
            temp = temp.replaceAll('xxx_name', '');
            temp = temp.replaceAll('xxx_phone', '');
            temp = temp.replaceAll('xxx_email', '');
            temp = temp.replaceAll('xxx_desination', '');
            $('#others').append(temp);
            i += 1;
        }

        function delOther(id) {
            $('#other-' + id).remove();
        }
        $(function() {
            $('#others-template').remove();
            $('.photo').dropify();
            $('#addOther').click(function(e) {
                e.preventDefault();
                addOther();
            });
            $('#map').keydown(function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    setMap(this.value);
                }
            });
            others.forEach(other => {
                let temp = _template.replaceAll('xxx_id', i);
                temp = temp.replaceAll('xxx_name', other.name);
                temp = temp.replaceAll('xxx_phone', other.phone);
                temp = temp.replaceAll('xxx_email', other.email);
                temp = temp.replaceAll('xxx_desination', other.designation);
                $('#others').append(temp);
                i += 1;
            });
            setMap('{{ $data->map }}');
        });
    </script>
@endsection
