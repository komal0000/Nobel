@extends('front.layout.app')

@section('title', 'Policy & Form')
@section('meta', 'Policy & Form page for the website')

@section('content')
    <section id="policy-banner">
        <picture>
            <img src="{{ asset('front/assets/img/policy-form/banner.jpg') }}" alt="Policy Banner" class="img-fluid w-100">
        </picture>
        <div class="banner-title">Policies & Forms</div>
    </section>
    @includeIf('front.cache.policy.index')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // More specific selector for desktop list and mobile tabs
            $('.desktop-list .type-2-tab, .info-container .type-2-tab').on('click', function(event) {
                // Find the closest parent container
                const componentContainer = $(this).closest('#policy-container');

                // Remove active states
                componentContainer.find('.type-2-tab').removeClass('active-btn');
                componentContainer.find('.type-2-tabs').removeClass('active');

                // Add active state to clicked button
                $(this).addClass('active-btn');

                // Get the target content ID
                const targetId = $(this).data('target');

                // Activate the corresponding content
                const targetContent = componentContainer.find(`.type-2-tabs[data-content="${targetId}"]`);

                if (targetContent.length) {
                    targetContent.addClass('active');
                    targetContent.find('.type-2-tab').addClass('active-btn');
                }
            });
        });
    </script>
@endpush
