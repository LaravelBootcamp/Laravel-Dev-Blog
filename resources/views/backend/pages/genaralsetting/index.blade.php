@extends('backend.layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Genaral Setting</h1>
    {{-- <x-backend.breadcrumb/> --}}
    <div class="row gap-3">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header">{{ __('Site Setting') }}</div>
                <div class="card-body">
                    <form action="{{route('gs.siteSettingUpdate')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <div class="mb-3">
                            <label for="siteTitle" class="form-label">Site Title</label>
                            <input type="text" class="form-control" name="site_title" id="siteTitle" value="{{$siteInfo['site_title']}}" placeholder="Site Tittle">
                        </div>
                        <div class="mb-3">
                            <label for="siteTagline" class="form-label">Site Description</label>
                            <input type="text" class="form-control" name="site_tagline" value="{{$siteInfo['site_tagline']}}" id="siteTagline" placeholder="Site Description">
                        </div>
                        <div class="mb-3">
                            <label for="siteLogo" class="form-label">Site Logo</label>
                            <input type="file" class="form-control" name="site_logo" id="siteLogo">
                            <div id="logoPreview">
                                <img src="{{$logo->view_path}}" class="w-50">
                            </div>
                        </div>
                        <div class="mb-3">
                           <input type="submit" value="Save" class="btn btn-outline-primary px-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
             <div class="card">
                <div class="card-header">{{ __('Menu Setting') }}</div>
                <div class="card-body">
                    <h4>Menu setting</h4>
                </div>
            </div>
        </div>
       
    </div>
    
</div>
@endsection

@section('backscript')

    <script type="text/javascript">
        var imgPrev = document.querySelector('#logoPreview img');
        document.querySelector('#siteLogo').addEventListener('change', (e) => {
            imgPrev.src = URL.createObjectURL(e.target.files[0]);
        });

    </script>

@endsection