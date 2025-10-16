@extends('admin.layout.app')
@section('title', 'Feedbacks')

@section('content')
    {{-- @dump($value) --}}
    <form action="{{ route('admin.setting.feedback') }}" method="POST">
        @csrf

        @if ($values !== null)
            <table id="datatable" class="table table-striped" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($values as $value)
                        <tr id="tr_{{ $value['id'] }}">
                            <td>
                                {{ $value['details']['name'] }}
                            </td>
                            <td>
                                {{ $value['details']['phoneNumber'] }}
                            </td>
                            <td>
                                {{ $value['details']['email'] }}
                            </td>
                            <td>
                                {{ $value['details']['message'] }}
                            </td>
                            <td>
                                <button onclick="deleteFeedback(event, {{ $value['id'] }})"
                                    class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Manage</th>
                    </tr>
                </tfoot>
            </table>
        @endif
    </form>
@endsection
@section('js')
    <script>
        let feedbackData = @json($values);

        function deleteFeedback(event, id) {
            event.preventDefault();

            feedbackData = feedbackData.filter(item => item.id !== id);
            const row = document.getElementById('tr_' + id);
            axios.post("{{ route('admin.setting.feedback') }}", {
                    data: feedbackData,
                    _token: '{{ csrf_token() }}'
                })
                .then(res => {
                    row.remove();
                    location.reload();
                })
                .catch(error => {
                    console.error('Failed to save the data: ', error)
                })

        }
    </script>
@endsection
