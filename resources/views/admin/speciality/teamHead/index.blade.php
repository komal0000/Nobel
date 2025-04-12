@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.speciality.index') }}">Speciality</a> /
    <span>Team Head</span>
@endsection
@section('content')
    <form action="{{ route('admin.speciality.teamHead.index', ['speciality_id' => $speciality->id]) }}" method="POST"
        class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="doctor_id">Doctor</label>
                <select name="doctor_id" id="doctor_id" class="form-control">
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
    <div class="mt-3">
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teamHeads as $teamHead)
                    <tr id="teamHead_{{ $teamHead->id }}">
                        <td>{{ $teamHead->name }}</td>
                        <td>
                            <button class="btn btn-danger"
                                onclick="teamHeadDel({{ $teamHead->id }}, {{ $speciality->id }})">Delete</button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script>
        function teamHeadDel(id, speciality_id) {
            axios.get(
                    "{{ route('admin.speciality.teamHead.del', ['team_head_id' => ':ID', 'speciality_id' => ':SPEC_ID']) }}"
                    .replace(':ID', id)
                    .replace(':SPEC_ID', speciality_id))
                .then(function(response) {
                    (response.data.status === 'success')
                    $('#teamHead_' + id).remove();

                })
                .catch(function(error) {
                    alert('Error deleting team head.');
                    console.error(error);
                });
        }
    </script>
@endsection
