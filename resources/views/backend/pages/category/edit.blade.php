@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4 cagegory_create">
    <h1 class="mt-4">Cagegorys</h1>
    {{-- <x-backend.breadcrumb/> --}}
    <div class="card w-25 ">
        <div class="card-header">{{ __('Edit Cagegory') }}</div>
        <div class="card-body">
            <div class="bg-white p-2">
                <form action="{{route('categorie.update', ['categorie' => $category->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="cat_name" value="{{$category->name}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Image</label>
                        <input type="file" value="" class="form-control" id="file" name="category_image">
                    </div>
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Description</label>
                        <textarea type="text" class="form-control" name="description" id="cat_name" value="{{$category->description}}"></textarea>
                    </div>
                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input" name="status" type="checkbox" 
                      value="{{$category->status}}" id="status" @if($category->status == 1) checked @endif>
                      <label class="form-check-label" for="status">Active</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        @if($category->file)
                            <img id="cat_preview_image" src="{{ $category->file->view_path}}" width="100">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-lg px-5"> Save </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



@section('backscript')
    <script type="text/javascript">
        document.querySelector('input[type="file"]').addEventListener('change', (event) => {
            let url = URL.createObjectURL(event.target.files[0]);

            document.querySelector("#cat_preview_image").setAttribute('src', url);
            // console.log(document.querySelector('input[type="file"]').files[0].mozFullPath);
        })
    </script>
@endsection