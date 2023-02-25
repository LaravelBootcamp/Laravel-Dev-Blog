<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Meta Tag -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <!-- SEO -->
        <meta name="description" content="150 words">
        <meta name="author" content="uipasta">
        <meta name="url" content="http://www.yourdomainname.com">
        <meta name="copyright" content="company name">
        <meta name="robots" content="index,follow">
        
        
        <title>{{getSetting('site_title')}} - {{getSetting('site_tagline')}}</title>
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="images/favicon/favicon.ico">
        <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="images/favicon/apple-touch-icon.png">
        
        <!-- All CSS Plugins -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/plugin.css')}}">
        
        <!-- Main CSS Stylesheet -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/css/style.css')}}">
        
        <!-- Google Web Fonts  -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">
        
        
        <!-- HTML5 shiv and Respond.js support IE8 or Older for HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        
        
        <!-- Preloader Start -->
        <div class="preloader">
            <div class="rounder"></div>
        </div>
        <!-- Preloader End -->
        
        @include('frontend.inc.header')
        
        <div id="main">
            <div class="container">
                <div class="row">
                    @include('frontend.inc.sidebar')
                    
                    
                    <!-- Blog Post (Right Sidebar) Start -->
                    <div class="col-md-9">
                        <div class="col-md-12 page-body">
                            <div class="row">
                                
                                <div class="subHeader">
                                    <div class="col1">
                                        <h2>{{getSetting('site_title')}}</h2>
                                        <p>{{getSetting('site_tagline')}}</p>
                                    </div>
                                    <div class="col2">
                                        <a href="mailto:devbipu@gmail.com"><i class="icon-envelope"></i></a>
                                    </div>
                                </div>

                                <div class="col-md-12 content-page">
                                    @yield('front-content')
                                </div>

                                <div class="mt-2">
                                    <x-frontend.newsletter-subscribe/>
                                </div>
                            </div>
                        </div>
                        @include('frontend.inc.footer')
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <!-- Back to Top Start -->
        <a href="#" class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>
        <!-- Back to Top End -->
        
        <!-- All Javascript Plugins  -->
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/plugin.js')}}"></script>
        
        <!-- Main Javascript File  -->
        <script type="text/javascript" src="{{asset('assets/frontend/js/scripts.js')}}"></script>
        
    </body>
</html>