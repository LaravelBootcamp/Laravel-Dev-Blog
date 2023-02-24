@extends('frontend.layouts.app')
@section('front-content')
<div class="col-md-12 blog-post">

		<div class="post-title">
			<h1>How to make your company website based on bootstrap framework on localhost?</h1>
		</div>
		
		
		<div class="post-info">
			<span>November 23, 2016 / by <a href="#" target="_blank">Alex Parker</a></span>
		</div>
		
		
		{{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at quam at orci commodo hendrerit vitae nec eros. Vestibulum neque est, imperdiet nec tortor nec, tempor semper metus. <b>Cras vel tempus velit</b>, et accumsan nisi. Duis laoreet pretium ultricies. Curabitur rhoncus auctor nunc congue sodales. Sed posuere nisi ipsum, eget dignissim nunc dapibus eget. Aenean elementum <b><a href="javascript:void(0)" data-toggle="popover" data-placement="top" data-content="You can write any text here">Click me</a></b> sollicitudin sapien ut sapien fermentum aliquet mollis. Curabitur ac quam orci sodales quam ut tempor. <b data-toggle="tooltip" data-placement="top" title="You can write any text here.">Hover me</b> suspendisse, gravida in augue in, interdum bibendum dui. Suspendisse sit amet justo sit amet diam fringilla commodo. Praesent ac magna at metus malesuada tincidunt non ac arcu. Nunc gravida eu felis vel elementum. Vestibulum sodales quam ut tempor tempor. Donec sollicitudin sapien ut sapien fermentum, non ultricies nulla gravida.</p>
		
		
		<div class="post-image margin-top-40 margin-bottom-40">
			<img src="{{asset('assets/frontend/images/blog/1.jpg')}}" alt="">
			<p>Image source from <a href="#" target="_blank">Link</a></p>
		</div>
		
		
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at quam at orci commodo hendrerit vitae nec eros. Vestibulum neque est, imperdiet nec tortor nec, tempor semper metus. Cras vel tempus velit, et accumsan nisi. Duis laoreet pretium ultricies. Curabitur rhoncus auctor nunc congue sodale Sed posuere nisi ipsum.</p>
		 --}}


		 <p><img alt="" src="/storage/image/2023/02/1676902451_trainingclassroom.jpg" style="height:450px; width:600px" /></p>
		<h3><strong>This is Heading of the post content</strong></h3>

		<p>&nbsp;</p>

		<p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available on <a href="https://github.com/devbipu">Github</a>.</p>

		<ol>
			<li>Topic one</li>
			<li>Topic two</li>
		</ol>

		<p>&nbsp;</p>
		
	
		<x-frontend.author-info />
	
	
	
		<x-frontend.related-post/>
		<x-frontend.comment-template/>

		
		
</div>
@endsection