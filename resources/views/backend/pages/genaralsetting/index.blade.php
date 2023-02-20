@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Genaral Setting</h1>
    {{-- <x-backend.breadcrumb/> --}}
    <div class="card w-25 ">
        <div class="card-header">{{ __('Site Setting') }}</div>
        <div class="card-body">
            <form>
                 <div class="mb-3">
                    <label for="siteTitle" class="form-label">Site Title</label>
                    <input type="text" class="form-control" name="site_title" id="siteTitle" placeholder="Site Tittle">
                </div>
                <div class="mb-3">
                    <label for="siteTagline" class="form-label">Site Description</label>
                    <input type="text" class="form-control" name="site_tagline" id="siteTagline" placeholder="Site Description">
                </div>
                <div class="mb-3">
                    <label for="siteLogo" class="form-label">Site Logo</label>
                    <input type="file" class="form-control" name="site_tagline" id="siteLogo">
                    <div id="logoPreview">
                        <img src="" class="w-50">
                    </div>
                </div>
                <div class="mb-3">
                   <input type="submit" value="Save" class="btn btn-outline-primary px-4">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection