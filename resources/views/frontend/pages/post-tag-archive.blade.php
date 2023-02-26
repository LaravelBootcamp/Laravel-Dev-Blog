@extends('frontend.layouts.app')


@section('front-content')
	<div class="homePosts">
		@foreach ($tagPosts as $post)
			<x-frontend.post-card :post="$post"/>
		@endforeach

	</div>



<x-frontend.load-more />
@endsection