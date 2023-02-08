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
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="checkbox" name="category[]" value="1"> </td>
                            <td>Category one</td>
                            <td>Image here</td>
                            <td>2011/04/25</td>
                            <td>
                                <button class="btn p-2 px-3 badge text-bg-primary">Edit</button>
                                <button class="btn p-2 px-3 badge text-bg-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection