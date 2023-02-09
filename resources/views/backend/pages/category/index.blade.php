@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cagegorys</h1>
    <a href="{{route('categorie.create')}}" class="btn btn-outline-primary">Add New</a>



    {{-- <x-backend.breadcrumb/> --}}
    <div class="card">
        <div class="card-header">{{ __('Cagegory list') }}</div>
        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorys as $cat)
                        <tr>
                            <td><input type="checkbox" class="checkbox" name="category[]" value="{{$cat->id}}"> </td>
                            <td>{{$cat->name}}</td>
                            <th>{{$cat->status}}</th>
                            <td>
                                <img src="{{$cat->file[0]->view_path}}" width="50" alt="cat image">
                            </td>
                            <td>{{$cat->updated_at}}</td>
                            <td>
                                {{-- <a class="btn p-2 px-3 badge text-bg-primary" data-id="{{$cat->id}}">Edit</a> --}}
                                <form action="{{route('categorie.destroy', $cat->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-2 px-3 badge text-bg-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection