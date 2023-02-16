@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4 cagegory_create">
    <h1 class="mt-4">Post Create</h1>
    {{-- <x-backend.breadcrumb/> --}}
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
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div>
                                <label for="post_tags">Tags</label>
                                <select class="form-select" id="post_tags" name="tags[]" size="4" multiple >
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Image</label>
                        <input type="file" value="" class="form-control" id="file" name="category_image">
                        <div>
                            <img src="" id="uploadPreview">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Post Content</label>
                        <textarea class="form-control" id="body" name="body" style="height: 250px;"></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="metakeywords">Meta Key Words (`,` Separated)</label>
                      <input class="form-control" name="metakeywords" type="text" id="metakeywords">
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
