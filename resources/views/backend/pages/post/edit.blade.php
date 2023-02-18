@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4 cagegory_create">
    <h1>Post Update</h1>
    {{-- <x-backend.breadcrumb/> --}}
    <div class="card w-50 m-auto ">
        <div class="card-header">{{ __('Update Post') }}</div>
        <div class="card-body">
            <div class="bg-white p-2">
                <form action="{{route('post.update', ['post' => $postData->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="post_title" class="form-label">Tittle</label>
                        <input type="text" class="form-control" name="title" id="post_title" value="{{$postData->title}}" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex gap-2 justify-content-start">
                            <div>
                                <label for="category">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option selected>Open this select menu</option>
                                    @foreach ($categorys as $cat)
                                    <option value="{{$cat->id}}" @if($cat->id == $postData->category_id) selected @endif>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                @php 
                                    $array2 = [
                                            [
                                                "id"=> 1,
                                                "name"=> "Tag One",
                                                "description"=> "Tag description",
                                                "status"=> 1,
                                                "deleted_at"=> null,
                                                "created_at"=> "2023-02-15T02:07:45.000000Z",
                                                "updated_at"=> "18-Feb-2023",
                                                
                                            ],
                                            [
                                                "id"=> 2,
                                                "name"=> "Tag two",
                                                "description"=> "Tag two description",
                                                "status"=> 1,
                                                "deleted_at"=> null,
                                                "created_at"=> "2023-02-15T02:08:01.000000Z",
                                                "updated_at"=> "15-Feb-2023",
                                            
                                            ]
                                        ];
                                    //print_r($array2)


                                        // $option = array_udiff_assoc($tags,  $array2, 'makeOptionForPostEditTag',);
                                        // print_r($option);

                                @endphp
                            <div>
                                <label for="post_tags">Tags</label>
                                <select class="form-select" id="post_tags" name="tags[]" size="4" multiple >
                                    <option>Open this select menu</option>
                                    @foreach ($tags as $tag)
                                        <option @if( in_array($tag->id , array_column($postData->tag->toArray(), 'id')) ) selected @endif>{{$tag->name}}</option>
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
                            @if ($postData->file)
                                <img src="{{$postData->file->view_path}}" id="uploadPreview" class="w-100">
                            @else
                                <img src="" id="uploadPreview" class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Post Content</label>
                        <textarea class="form-control" id="body" name="body" style="height: 250px;">{{$postData->body}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="meta_keywords">Meta Key Words (`,` Separated)</label>
                        <input class="form-control" name="meta_keywords" type="text" id="meta_keywords" value="{{implode(',', json_decode($postData->meta_keywords));}}">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" name="status" type="checkbox" value="1" id="status" @if($postData->status) checked @endif>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg px-5"> Update </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('backscript')
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
    </script>
@endsection