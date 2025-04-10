@extends('admin.layout.app')
@section('title')
    <span>Gallery Type</span>
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
    <form action="{{ route('admin.gallery.type.index') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <label for="name">Type Name <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    @if ($gallery_types !== null)
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Type Name</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gallery_types as $type)
                    <tr id="tr_{{ $type->id }}">
                        <td>
                            <input type="text" name="title" id="title_{{ $type->id }}"
                                class="form-control update_input" value="{{ $type->title }}">
                        </td>
                        <td>
                            <button onclick="editType({{ $type->id }})" class="btn btn-sm btn-warning">Update</button>
                            <button onclick="deleteType({{ $type->id }})" class="btn btn-sm btn-danger">Delete</button>
                            <a href="{{route('admin.gallery.index',['type_id'=>$type->id])}}" class="btn btn-sm btn-info">Manage Gallery</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Type Name</th>
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

            axios.post("{{ route('admin.gallery.type.edit', ['type_id' => 'ID']) }}".replace('ID', id), {
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

        function deleteType(id) {
            axios.get("{{ route('admin.gallery.type.del', ['type_id' => 'ID']) }}".replace('ID', id))
                .then(res => {
                    if (res.data.success) {
                        $(`#tr_${id}`).remove();
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error(err);
                })
        }
    </script>
@endsection
