@extends('frontend.layouts.app')

{{-- {{dd($menu_items)}} --}}
@section('front-content')
	<div class="homePosts">
		@foreach ($posts as $post)
			<x-frontend.post-card :post="$post"/>
		@endforeach
	</div>



<x-frontend.load-more />
@endsection