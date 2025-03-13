@extends('admin.layout.app')
@section('title')
    <span>Technology Section Types</span>
@endsection
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
    <form action="{{ route('admin.technology.sectiontype.index') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="title">Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
                <label for="short_description">Short Description <span style="color: red;">*</span></label>
                <input type="text" name="short_description" id="short_description" class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    @if ($techSectionTypes !== null)
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Short Description</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($techSectionTypes as $type)
                    <tr id="tr_{{ $type->id }}">
                        <td>
                            <input type="text" name="title" id="title_{{ $type->id }}"
                                class="form-control update_input" value="{{ $type->title }}">
                        </td>
                        <td>
                            <input type="text" name="short_description" id="short_description_{{ $type->id }}"
                                class="form-control update_input" value="{{ $type->short_description }}">
                        </td>
                        <td>
                            <button onclick="editType({{ $type->id }})" class="btn btn-sm btn-warning">Update</button>
                            <button onclick="deleteType({{ $type->id }})" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Year</th>
                    <th>Short Description</th>
                    <th>Manage</th>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
@section('js')
    <script>
        function editType(id) {
            const title = $(`#title_${id}`).val();
            const short_description = $(`#short_description_${id}`).val();

            axios.post("{{ route('admin.technology.sectiontype.edit', ['type_id' => 'ID']) }}".replace('ID', id), {
                    title: title,
                    short_description: short_description,
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

        function deleteType(id) {
            axios.get("{{ route('admin.technology.sectiontype.del', ['type_id' => 'ID']) }}".replace('ID', id))
                .then(res => {
                    if (res.status === 200) {
                        $(`#tr_${id}`).remove();
                    }
                })
                .catch(err => {

                })
        }
    </script>
@endsection
