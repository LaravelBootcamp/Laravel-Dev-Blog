@extends('backend.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex my-3 align-items-center g-2">
        <h3 class="m-0 mr-2">Trashed Tags</h3>
        {{-- <a href="{{route('categorie.create')}}" class="btn btn-outline-primary btn-sm d-inline-block ml-2">Add New</a> --}}
    </div>


    {{-- <x-backend.breadcrumb/> --}}
    <div class="card">
        <div class="card-header">{{ __('Trashed Tags list') }}</div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div>
                <form action="{{route('trashedTagsHandle')}}" method="POST">
                    @csrf
                <div class="d-flex gap-2 justify-content-start float-start">
                    <select class="form-select" name="actionType"  id="action_select-1" onchange="checkAction(this, 2)">
                        <option value="0">Select Action</option>
                        <option value="1">Restore Tag</option>
                        <option value="2">Permanently Delete Tag</option>
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
                            <th>Status</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                        <tr>
                            <td><input type="checkbox" class="rowSelect form-check-input" name="tags[]" value="{{$tag->id}}"> </td>
                            <td>{{$tag->name}}</td>
                            <th>{{$tag->status}}</th>
                            <td>{{$tag->updated_at}}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input"  id="checkAll-2" value="" onclick="checkAllRow(this, 1)">
                            </th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Updated At</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="d-flex gap-2 justify-content-start float-start">
                    <select class="form-select" name="actionType" id="action_select-2" onchange="checkAction(this, 1)">
                        <option value="0">Select Action</option>
                        <option value="1">Restore Tag</option>
                        <option value="2">Permanently Delete Tag</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm px-2">Apply</button>
                </div>
                </form>
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
    </script>
@endsection