@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4">
    <div class="d-flex my-3 align-items-center g-2">
        <h3 class="m-0 mr-2">Cagegorys</h3>
        <a href="{{route('categorie.create')}}" class="btn btn-outline-primary btn-sm d-inline-block mx-2">Add New</a>
        <a href="{{route('trushCats')}}" class="btn btn-outline-danger btn-sm d-inline-block ml-2">Trash</a>
    </div>

    {{-- <x-backend.breadcrumb/> --}}
    <div class="card">
        <div class="card-header">{{ __('Cagegory list') }}</div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" id="status_show" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div>
                <form action="{{route('bulkCatDelete')}}" method="POST">
                    @csrf
                <div class="d-flex gap-2 justify-content-start float-start">
                    <select class="form-select" name="actionType"  id="action_select-1" onchange="checkAction(this, 2)">
                        <option value="0">Select Action</option>
                        <option value="1">Category Move to Trash</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm px-2">Apply</button>
                </div>
                <table class="table table-striped table-hover" id="categorys">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input" id="checkAll-1" onclick="checkAllRow(this, 2)">
                            </th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorys as $cat)
                        <tr>
                            <td><input type="checkbox" class="rowSelect form-check-input" name="category[]" value="{{$cat->id}}"> </td>
                            <td>{{$cat->name}}</td>
                            <td>{{$cat->slug}}</td>
                            <th>{{$cat->status}}</th>
                            <td>
                                @if(isset($cat->file))
                                <img src="{{$cat->file->view_path}}" width="50" alt="cat image">
                                @endif
                            </td>
                            <th><p>{{$cat->description}}</p></th>
                            <td>{{$cat->updated_at}}</td>
                            <td>
                                <a href="{{route('categorie.edit', ['categorie' => $cat->id])}}" class="btn btn-sm btn-outline-primary">Edit </a>
                                {{-- <a class="btn p-2 px-3 badge text-bg-primary" data-id="{{$cat->id}}">Edit</a>
                                <form action="{{route('categorie.destroy', $cat->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-2 px-3 badge text-bg-danger">Delete</button>
                                </form> --}}
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
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
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
                        <option value="1">Category Move to Trash</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm px-2">Apply</button>
                </div>
                </form>
                <div class="d-flex">
                    {!! $categorys->links() !!}
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