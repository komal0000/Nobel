@php
$data =
    App\Helper::getSetting('contact') ??
    (object) [
        'email' => '',
        'phone' => '',
    ];
@endphp
<header class="site-header" id="site-header">
    <div class="main-container">
        @includeIf('front.cache.home.logo')
        <nav class="navbar navbar-expand p-0" id="navbar">
            <div class="">
                <ul class="nav-ul">
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Speciality <i class="bi bi-chevron-down"></i>
                        </a>
                        @includeIf('front.cache.home.header')
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Health Library <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="{{ route('healthlibrary.index') }}" class="drop-item">Health Library</a>
                            </li>
                            <li>
                                <a href="{{ route('treatment.index') }}" class="drop-item">Treatments</a>
                            </li>
                            <li>
                                <a href="{{ route('technology.index') }}" class="drop-item">Technologies</a>
                            </li>
                            <li>
                                <a href="{{ route('aliment.index') }}" class="drop-item">Ailments</a>
                            </li>
                            <li class="navbar-item knowledge-drop" onclick="extendKnowledgeSubMenu(this, event)">
                                <a href="#" class="drop-item navbar-link knowledge-link d-flex justify-content-between">
                                    <span>Knowledge</span> <i class="bi bi-chevron-right"></i>
                                </a>
                                <ul class="knowledge-drop-menu">
                                    <li>
                                        <a href="{{ route('knowledge.blog.index') }}" class="drop-item">Blogs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('knowledge.video') }}" class="drop-item">Videos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('knowledge.casestudy.index') }}" class="drop-item">Case
                                            Studies</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('knowledge.newsletter') }}" class="drop-item">News Letter</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('event') }}" class="drop-item">Events</a>
                            </li>
                            <li>
                                <a href="{{ route('download.index') }}" class="drop-item">Downloads</a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Services <i class="bi bi-chevron-down"></i>
                        </a>
                        @includeIf('front.cache.home.headerService')
                    </li>
                    <li class="navbar-item">
                        <a href="{{ route('academicprogram.index') }}" class="navbar-link ">Academic Programs</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{ route('careers') }}" class="navbar-link ">Career</a>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Contact Us <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="{{ route('contact') }}" class="drop-item">Contact Us</a>
                            </li>
                            <li>
                                <a href="mailto:{{ $data->email }}" class="drop-item">{{ $data->email }}</a>
                            </li>
                            <li>
                                <a href="tel:+977 {{ $data->phone }}" class="drop-item">{{ $data->phone }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
       @includeIf('front.cache.home.mobileLogo')
    </div>
    <div class="sectionNavbarMainContainer d-none">
        <hr>
        <div class="main-container">
            <nav class="section-nav" id="section-nav">
                <div class="section-navbar-container">
                    <ul id="sectionLinks">

                    </ul>
                </div>
            </nav>
        </div>

    </div>
</header>