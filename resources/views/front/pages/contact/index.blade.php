@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.contact')
@endsection

@section('content')
    @includeIf('front.cache.contact.index')
    @includeIf('front.cache.contact.map')
@endsection
@section('js')
   <script>

$('#feedback-form').on('submit', function (event) {
    event.preventDefault(); // prevent page refresh

    const formData = new FormData(this);
    const $contactBtn = $('#contact-us-submit-btn');

    $contactBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
    $contactBtn.css('opacity', '0.5');

    const newEntry = {
        name: formData.get('name'),
        phoneNumber: formData.get('phoneNumber'),
        email: formData.get('email'),
        message: formData.get('message')
    };

    console.log('New Entry:', newEntry);
    $.ajax({
        url: this.action,
        type: 'POST',
        data: {
            data: [
                {
                    details: newEntry
                }
            ]
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            alert(response.message);
            location.reload();
        },
        error: function (error) {
            console.log(error);
            alert('Error saving!');
        }
    });
});


   </script>
@endsection
