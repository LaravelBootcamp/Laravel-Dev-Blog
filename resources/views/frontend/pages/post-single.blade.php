@extends('frontend.layouts.app')
@section('front-content')
<div class="col-md-12 blog-post">

		<div class="post-title">
			<h1>{{$post->title}}</h1>
		</div>
		
		
		<div class="post-info">
			 <span><a href="#" target="_blank">{{$post->category->name}} - </a></span>
			 <span>{{$post->created_at}} / by <a href="#" target="_blank">{{$post->user->name}}</a></span>
		</div>
		
		
		<div>
			{!! $post->body !!}
		</div>


		<div class="postTags margin-top-100">
			@foreach ($post->tag as $tag)
				<span>{{$tag->name}}</span>
			@endforeach
		</div>
	
		<x-frontend.author-info :author="$post->user"/>
	
	
	
		{{-- <x-frontend.related-post/> --}}
		{{-- <x-frontend.comment-template/> --}}

		
		
</div>
@endsection