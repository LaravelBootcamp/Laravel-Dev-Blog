<!-- About Me (Left Sidebar) Start -->
<div class="col-md-3 aboutUs">
    <div class="about-fixed">
        <div class="my-pic">
            {{-- <img src="{{asset('assets/frontend/images/pic/my-pic.png')}}" alt=""> --}}
            @if(getAuthor()->file)
            <img src="{{getAuthor()->file->view_path}}" alt="">
            @endif
            <a href="javascript:void(0)" class="collapsed" data-target="#menu" data-toggle="collapse"><i class="icon-menu menu"></i></a>
            <div id="menu" class="collapse">
                <ul class="menu-link">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('dashboard')}}">Admin</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
        
        <div class="my-detail">
            
            <div class="white-spacing">
                <h1>{{ getAuthor()->name }}</h1>
                <span>{{ getAuthor()->username }}</span>
            </div>
            
            <ul class="social-icon">
                <li><a href="https://facebook.com/devbipu" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://www.linkedin.com/in/devbipu" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="https://github.com/devbipu" target="_blank" class="github"><i class="fa fa-github"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- About Me (Left Sidebar) End -->
