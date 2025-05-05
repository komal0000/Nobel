<div class="tab-panel active" id="tab-1">
    <div class="tab-slider">
        @foreach ($indexBlogs as $blog )
        <div class="each-card">
            <div class="img-wrapper">
                <img src="{{ asset($blog->image)}}" alt="Blog">
            </div>
            <div class="body">
                <div class="type mb-2">{{$blog->title}}</div>
                <div class="heading-xs mb-2">{{$blog->short_description}}</div>
                <x-hoverBtn href="{{ route('knowledge.blog.single', ['slug' => $blog->slug]) }}" class="para-wrap">Continue Reading</x-hoverBtn>
            </div>
        </div>
        @endforeach
    </div>
</div>
