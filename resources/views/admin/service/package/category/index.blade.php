@extends('admin.layout.app')
@section('title')
    <span>Package Categories</span>
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
    <form action="{{ route('admin.service.package.category.index') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6 ">
                <label for="title">Category Title <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>

    @if ($categories !== null)
        <table id="datatable" class="table table-striped" data-toggle="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr id="tr_{{ $category->id }}">
                        <td>
                            {{ $category->title }}
                        </td>
                        <td>
                            <button onclick="deleteCategory({{ $category->id }})"
                                class="btn btn-sm btn-danger">Delete</button>
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
        function deleteCategory(id) {
            axios.get("{{ route('admin.service.package.category.del', ['category_id' => 'ID']) }}".replace('ID', id))
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
