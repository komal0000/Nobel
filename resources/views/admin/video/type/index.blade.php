@extends('admin.layout.app')
@section('title')
    <span>Video Type</span>
@endsection
@section('css')
@section('css')
    <style>
        .update_input {
            border: none;
            padding: 0px;
            background-color: #F2F2F2;
        }

        .update_input:focus {
            background-color: #F2F2F2;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('admin.video.type.index') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-2 d-flex">
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-check-input" type="checkbox" name="home_video" id="home_video"
                            {{ old('home_video') ? 'checked' : '' }} style="margin: 0px 3px 6px"
                            onclick="this.value = this.checked ? 1 : 0">
                        <label for="title">Home Video</label>
                    </div>
                    <div class="col-md-12 mt-2">
                        <input class="form-check-input" type="checkbox" name="doctor_video" id="doctor_video"
                            {{ old('doctor_video') ? 'checked' : '' }} style="margin: 0px 3px 6px"
                            onclick="this.value = this.checked ? 1 : 0; toggleDoctorSelect();">
                        <label for="doctor_video">Doctor Video</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="display: none" id="doctor_select_div">
                <label for="doctor_id">Doctor</label>
                <select name="doctor_id" id="doctor_id" class="form-control">
                     <option selected disabled>Select</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mt-2 d-flex align-items-end">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
    @if ($videoTypes !== null)
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videoTypes as $type)
                    <tr id="tr_{{ $type->id }}">
                        <td>
                            {{ $type->title }}
                        </td>
                        <td>
                            @if ($type->home_video == 1)
                                Home Videos
                            @elseif($type->doctor_id != null)
                            @php
                            $doctor = App\Models\Doctor::where('id', $type->doctor_id)->first();
                            @endphp
                                Doctor Videos ({{$doctor->title}})
                            @else
                                Normal Videos
                            @endif
                        </td>
                        <td>
                            <button onclick="deleteVideo({{ $type->id }})" class="btn btn-sm btn-danger">Delete</button>
                            <a href="{{ route('admin.video.index', ['type_id' => $type->id]) }}"
                                class="btn btn-sm btn-info">Manage video</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Manage</th>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
@section('js')
    <script>
        function editVideo(id) {
            const title = $(`#title_${id}`).val();
            axios.post("{{ route('admin.video.type.edit', ['type_id' => 'ID']) }}".replace('ID', id), {
                    title: title,
                })
                .then(res => {
                    if (res.data.success) {
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        }

        function deleteVideo(id) {
            axios.get("{{ route('admin.video.type.del', ['type_id' => 'ID']) }}".replace('ID', id))
                .then(res => {
                    if (res.data.success) {
                        $(`#tr_${id}`).remove();
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error(err)
                })
        }

        function toggleDoctorSelect() {
            const doctorSelect = document.getElementById('doctor_select_div');
            const isChecked = document.getElementById('doctor_video').checked;
            doctorSelect.style.display = isChecked ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleDoctorSelect();
        });
    </script>
@endsection
