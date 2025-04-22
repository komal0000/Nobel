@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>Service Package Types</span>
@endsection
@section('css')
@endsection
@section('content')
    <form action="{{ route('admin.service.package.type.index', ['service_id' => $service_id]) }}" method="POST"
        class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="type">Package Type <span style="color: red;">*</span></label>
                <select name="type" id="type" class="form-control">
                    <option value="Type 1">Type 1</option>
                    <option value="Type 2">Type 2</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    @if (isset($types))
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Package Type</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr id="tr_{{ $type->id }}">
                        <td>
                            {{ $type->type }}
                        </td>
                        <td>
                            <button onclick="deleteType({{ $type->id }})" class="btn btn-sm btn-danger">Delete</button>
                            <a href="{{ route('admin.service.package.index', ['type_id' => $type->id]) }}"
                                class="btn btn-sm btn-info">Manage Packages</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Package Type</th>
                    <th>Manage</th>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
@section('js')
    <script>
        function deleteType(id) {
            axios.get("{{ route('admin.service.package.type.del', ['type_id' => 'ID']) }}".replace('ID', id))
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
