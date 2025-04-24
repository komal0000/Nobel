@extends('admin.layout.app')

@section('title', 'Popup')

@section('btn')
    <a href="{{ route('admin.popup.add') }}" class="btn btn-primary"> Add New Popup </a>
@endsection

@section('content')
    <div class="row">
        @foreach($popups as $popup)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{asset($popup->image) }}" alt="{{ $popup->title ?? 'Popup image' }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="p-2">
                            @if($popup->is_active)
                                <a href="{{ route('admin.popup.deactivate',['popup_id'=>$popup->id]) }}" class="btn btn-sm btn-warning deactivate-btn">Deactivate</a>
                            @else
                                <a href="{{ route('admin.popup.activate',['popup_id'=>$popup->id]) }}" class="btn btn-sm btn-success activate-btn">Activate</a>
                            @endif
                            <a href="{{ route('admin.popup.edit', $popup->id) }}" class="btn btn-sm btn-info mr-1">Edit</a>
                            <a href="{{ route('admin.popup.del', $popup->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.activate-btn').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var url = btn.attr('href');

            axios.get(url)
            .then(function(response) {
                if (response.data.status === 'success') {
                    var deactivateUrl = url.replace('activate', 'deactivate');
                    var deactivateBtn = $('<a href="' + deactivateUrl + '" class="btn btn-sm btn-warning deactivate-btn">Deactivate</a>');
                    btn.replaceWith(deactivateBtn);
                    attachDeactivateHandler(deactivateBtn);
                    location.reload();

                }
            })
            .catch(function(error) {
                alert('Error activating popup');
                console.error(error);
            });
        });

        function attachDeactivateHandler(btn) {
            btn.click(function(e) {
                e.preventDefault();
                var deactivateBtn = $(this);
                var url = deactivateBtn.attr('href');

                axios.get(url)
                .then(function(response) {
                    if (response.data.status === 'success') {
                        var activateUrl = url.replace('deactivate', 'activate');
                        var activateBtn = $('<a href="' + activateUrl + '" class="btn btn-sm btn-success activate-btn">Activate</a>');
                        deactivateBtn.replaceWith(activateBtn);

                        $('.activate-btn').last().click(function(e) {
                            e.preventDefault();
                            var btn = $(this);
                            var url = btn.attr('href');
                        });
                        location.reload();
                    }
                })
                .catch(function(error) {
                    alert('Error deactivating popup');
                    console.error(error);
                });
            });
        }

        $('.deactivate-btn').each(function() {
            attachDeactivateHandler($(this));
        });
    });
</script>
@endsection
