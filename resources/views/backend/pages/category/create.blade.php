@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4 cagegory_create">
    <h1 class="mt-4">Cagegorys</h1>
    {{-- <x-backend.breadcrumb/> --}}
    <div class="card w-25 ">
        <div class="card-header">{{ __('Create Cagegory') }}</div>
        <div class="card-body">
            <div class="bg-white p-2">
                <form action="{{route('categorie.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="cat_name" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Image</label>
                        <input type="file" value="" class="form-control" id="file" name="category_image">
                    </div>
                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input" name="status" type="checkbox" value="1" id="status" checked>
                      <label class="form-check-label" for="status">Active</label>
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-lg px-5"> Save </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
