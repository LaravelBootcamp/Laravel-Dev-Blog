@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4">
    <div class="d-flex my-3 align-items-center g-2">
        <h3 class="m-0 mr-2">Posts</h3>
        <a href="{{route('post.create')}}" class="btn btn-outline-primary btn-sm d-inline-block mx-2">Add New</a>
        <a href="{{route('trashPostShow')}}" class="btn btn-outline-danger btn-sm d-inline-block ml-2">Trash</a>
    </div>

    {{-- <x-backend.breadcrumb/> --}}
    <div class="card">
        <div class="card-header">{{ __('Post list') }}</div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" id="status_show" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div>
                <form action="{{route('bulkPostAction')}}" method="POST">
                    @csrf
                <div class="d-flex gap-2 justify-content-start float-start">
                    <select class="form-select" name="actionType"  id="action_select-1" onchange="checkAction(this, 2)">
                        <option value="0">Select Action</option>
                        <option value="1">Move to Trash</option>
                        <option value="2">Delete Permanently</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm px-2">Apply</button>
                </div>
                <table class="table table-striped table-hover" id="posts">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input" id="checkAll-1" onclick="checkAllRow(this, 2)">
                            </th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td><input type="checkbox" class="rowSelect form-check-input" name="posts[]" value="{{$post->id}}"> </td>
                            <th width="20%">{{$post->title}}</th>
                            <td>
                                @if(isset($post->file))
                                <img src="{{$post->file->view_path}}" width="50" alt="post image">
                                @endif
                            </td>
                            <th><p>{{$post->body}}</p></th>
                            <td width="10%">{{$post->updated_at}}</td>
                            <td>
                                <a href="{{route('post.edit', ['post' => $post->id])}}" class="btn btn-sm btn-outline-primary">Edit </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input"  id="checkAll-2" value="" onclick="checkAllRow(this, 1)">
                            </th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-flex gap-2 justify-content-start float-start">
                    <select class="form-select" name="actionType" id="action_select-2" onchange="checkAction(this, 1)">
                        <option value="0">Select Action</option>
                        <option value="1">Move to Trash</option>
                        <option value="2">Delete Permanently</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm px-2">Apply</button>
                </div>
                </form>
                <div class="d-flex">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('backscript')
    <script type="text/javascript">
        const btnWrap = document.querySelectorAll('.rowSelect');
        function checkAllRow(event, id){
            if(event.checked){
                document.querySelector(`#checkAll-${id}`).checked = true
                btnWrap.forEach((el) => {
                    el.checked = true
                })
            }else{
                document.querySelector(`#checkAll-${id}`).checked = false
                btnWrap.forEach((el) => {
                    el.checked = false
                })
            }
        }

        function checkAction(el, t){
            document.querySelector(`#action_select-${t}`).value = el.value;
        }

        setTimeout(() => {
            document.querySelector('#status_show').classList.add('d-none');
        }, 5000)
    </script>
@endsection