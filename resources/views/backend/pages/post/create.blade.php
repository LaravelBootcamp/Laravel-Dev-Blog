@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4 cagegory_create">
    <h1 class="mt-4">Post Create</h1>
    {{-- <x-backend.breadcrumb/> --}}
    <div class="w-50 m-auto text-center">
        @if($errors->any())
            {!! implode('', $errors->all('<div class="text-bg-danger">:message</div>')) !!}
        @endif
    </div>
    <div class="card w-50 m-auto ">
        <div class="card-header">{{ __('Create Post') }}</div>
        <div class="card-body">
            <div class="bg-white p-2">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="post_title" class="form-label">Tittle</label>
                        <input type="text" class="form-control" name="title" id="post_title" value="" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex gap-2 justify-content-start">
                            <div>
                                <label for="category">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option selected value="0">Open this select menu</option>
                                    @foreach ($categorys as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="post_tags">Tags</label>
                                <select class="form-select" id="post_tags" name="tags[]" size="4" multiple >
                                    <option selected value="0">Open this select menu</option>
                                    @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                <span>Ctrl+click for multiple select</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Image</label>
                        <input type="file" value="" class="form-control" id="file" name="post_thumbnail">
                        <div>
                            <span id="removeImage" class="badge bg-danger float-end p-2 d-none" style="cursor: pointer;">x</span>
                            <img src="" id="uploadPreview" class="w-100">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="post_body" class="form-label">Post Content</label>
                        <textarea class="form-control" id="post_body" name="body" style="height: 450px;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="meta_keywords">Meta Key Words (`,` Separated)</label>
                        <input class="form-control" name="meta_keywords" type="text" id="meta_keywords">
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
@section('backscript')

{{-- Ck editor 4 --}}
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>    

<script type="text/javascript">
    const input = document.querySelector('#file')
    input.addEventListener('change', (ev) => {
        document.querySelector('#removeImage').classList.remove('d-none')
        let tempUrl = URL.createObjectURL(ev.target.files[0])
        document.querySelector('#uploadPreview').src = tempUrl;
    })
    document.querySelector('#removeImage').addEventListener('click', () => {
        document.querySelector('#uploadPreview').src = ''
        input.value="";
        document.querySelector('#removeImage').classList.add('d-none')
    })


    CKEDITOR.replace( 'post_body', {
        filebrowserUploadUrl:"{{ route('image.upload',['_token' => csrf_token()] )}}",
        filebrowserUploadMethod: "form",
        height: 350
    });
</script>
@endsection