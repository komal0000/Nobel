@extends('front.layout.app')

@section('title', 'All Academic')
@section('meta', 'All Academic page for the website')

@section('content')
@includeIf('front.cache.academic.programs')
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Initialize GLightbox
            const lightBox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true
            });

            // Dropdown Toggle
            $('.default-select').on('click', function(e) {
                e.stopPropagation();
                $('#select-wrap').toggleClass('active');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function() {
                $('#select-wrap').removeClass('active');
            });

            // Prevent dropdown from closing when clicking inside
            $('#select-wrap').on('click', function(e) {
                e.stopPropagation();
            });

            // Dropdown Selection
            $('#select-list li').on('click', function() {
                const selectedText = $(this).text();
                const selectedValue = $(this).data('value') || 'All';

                // Update dropdown display
                $('.default-item').text(selectedText);
                $('#find-doc-speciality-input').val(selectedValue);
                $('#select-wrap').removeClass('active');

                // Reset and filter videos
                resetLoadMore();
                filterVideos();
            });

            // Search Input Event
            $('#search-all-video').on('keyup', function() {
                resetLoadMore();
                filterVideos();
            });

            // Reset Load More Function
            function resetLoadMore() {
                currentLoadCount = 6;
                $('#load-more-all').show();
            }

            // Filter Videos Function
            function filterVideos() {
                const searchTerm = $('#search-all-video').val().toLowerCase();
                const selectedCategory = $('#find-doc-speciality-input').val() || 'All';

                // Hide all cards first
                $('.all-card').hide();

                // Filter cards based on search and category
                const filteredCards = $('.all-card').filter(function() {
                    const title = $(this).find('.video-title').text().toLowerCase();
                    const cardCategory = $(this).data('content');

                    const matchesSearch = !searchTerm || title.includes(searchTerm);
                    const matchesCategory = selectedCategory === 'All' || cardCategory === selectedCategory;

                    return matchesSearch && matchesCategory;
                });

                // Show first batch of cards
                filteredCards.slice(0, 6).show();

                // Manage Load More button
                if (filteredCards.length <= 6) {
                    $('#load-more-all').hide();
                } else {
                    $('#load-more-all').show();
                }

                return filteredCards;
            }

            // Load More Functionality
            let cardsPerLoad = 3;
            let currentLoadCount = 6;

            $('#load-more-all').on('click', function() {
                const searchTerm = $('#search-all-video').val().toLowerCase();
                const selectedCategory = $('#find-doc-speciality-input').val() || 'All';

                // Filter cards based on current search and category
                const filteredCards = $('.all-card').filter(function() {
                    const title = $(this).find('.video-title').text().toLowerCase();
                    const cardCategory = $(this).data('content');

                    const matchesSearch = !searchTerm || title.includes(searchTerm);
                    const matchesCategory = selectedCategory === 'All' || cardCategory ===
                        selectedCategory;

                    return matchesSearch && matchesCategory;
                });

                // Find hidden cards that match current filter
                const hiddenCards = filteredCards.filter(':hidden');

                // Show next batch of hidden cards
                hiddenCards.slice(0, cardsPerLoad).show();
                currentLoadCount += cardsPerLoad;

                // Hide Load More button if all cards are shown
                if (currentLoadCount >= filteredCards.length) {
                    $('#load-more-all').hide();
                }
            });

            // Initial load: show default cards and setup
            resetLoadMore();
            filterVideos();
        });
    </script>
@endsection
