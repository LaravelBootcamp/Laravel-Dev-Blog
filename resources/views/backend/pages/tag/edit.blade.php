@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4 cagegory_create">
    <h1 class="mt-4">Create Tag</h1>
    {{-- <x-backend.breadcrumb/> --}}
    <div class="card w-25 ">
        <div class="card-header">{{ __('Create Tag') }}</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('status'))
            <div class="alert alert-success" id="status_show" role="alert">
                {{ session('status') }}
            </div>
        @endif
 
        <div class="card-body">
            <div class="bg-white p-2">
                <form action="{{route('tag.update', ['tag' => $tag->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{$tag->name}}" placeholder="Name">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea class="form-control" name="description" placeholder="Tag description" id="description" style="height: 100px">{{$tag->description}}</textarea>
                        <label for="description">Description</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" name="status" type="checkbox" value="1" id="status" @if($tag->status == 1) checked @endif>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-lg px-5"> Save </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
