<section id="knowledge"  data-content="knowledge">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Knowledge Center
        </div>
        <div class="knowledge-tabs d-flex justify-content-center gap-3 mb-4">
            <div class="tab blogs active" data-tab="tab-1"><button>Blogs</button></div>
            <div class="tab videos" data-tab="tab-2"><button>Videos</button></div>
            <div class="tab studies" data-tab="tab-3"><button>Case Studies</button></div>
        </div>
        <div class="tab-content">
            @includeIf('front.cache.health.knowledge.blogs')
            @includeIf('front.cache.health.knowledge.video')
        </div>
    </div>
</section>

