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
                                @if($logo)
                                <img src="{{$logo->view_path}}" class="w-50">
                                @endif
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
                    <form action="{{route('gs.menuBilder')}}" method="POST">
                        @csrf
                        <table class="table table-striped table-hover" id="menuBuilder">
                            <thead>
                                <tr>
                                    <th colspan="3">Nav Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($menu_items)
                                @foreach ($menu_items as $menu)
                                <tr>
                                    <td>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="menuName" name="menu_names[]" value="{{$menu->menu_name}}" placeholder="Menu Name">
                                            <label for="menuName">Menu Name</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="menuLink" value="{{$menu->menu_link}}" name="menu_links[]" placeholder="Menu Link">
                                            <label for="menuLink">Menu Link</label>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger rowRemoveButton" type="button"><i class="fa-sharp fa-solid fa-xmark"></i></button>
                                        <input type="hidden" id='ordering' name="ordering[]" value="{{$menu->ordering}}">
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="btn btn-secondary" id="menuRowAdd">Add New</button>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
                <div class="card-footer text-muted">
                    Post menu url formate:  <code>/{slug}</code> <br/>
                    Tags menu url formate:  <code>/tags/{slug}</code> <br/>
                    Categories menu url formate:  <code>/categories/{slug}</code>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Available Menu
                </div>
                <div>
                    <div class="accordion accordion-flush" id="available_menu_sec">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Posts</button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#available_menu_sec">
                                <div class="accordion-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td>{{$post->title}}</td>
                                                    <td>{{$post->slug}}</td>
                                                    <td>
                                                        <a href="/{{$post->slug}}" target="new">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">Category</button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#available_menu_sec">
                                <div class="accordion-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $cat)
                                                <tr>
                                                    <td>{{$cat->name}}</td>
                                                    <td>{{$cat->slug}}</td>
                                                    <td>
                                                        <a href="/{{$cat->slug}}" target="new">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Tag</button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#available_menu_sec">
                                <div class="accordion-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tags as $tag)
                                                <tr>
                                                    <td>{{$tag->name}}</td>
                                                    <td>{{$tag->slug}}</td>
                                                    <td>
                                                        <a href="/{{$tag->slug}}" target="new">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
//Menu builder
const menuBulderTable = document.querySelector('#menuBuilder tbody');
const newRow = `
<tr>
    <td>
        <div class="form-floating">
            <input type="text" class="form-control" id="menuName" name="menu_names[]" placeholder="Menu Name">
            <label for="menuName">Menu Name</label>
        </div>
    </td>
    <td>
        <div class="form-floating">
            <input type="text" class="form-control" id="menuLink" name="menu_links[]" placeholder="Menu Link">
            <label for="menuLink">Menu Link</label>
        </div>
    </td>
    <td>
        <button class="btn btn-danger rowRemoveButton" type="button"><i class="fa-sharp fa-solid fa-xmark"></i></button>
        <input type="hidden" id="ordering" name="ordering[]" value="0">
    </td>
</tr>
`
document.querySelector("#menuRowAdd").addEventListener('click', (e) => {
menuBulderTable.insertAdjacentHTML('beforeend', newRow);
countTheRow();
})
function countTheRow(){
var rowCount = document.querySelectorAll('#menuBuilder tbody tr');
rowCount.forEach((el, i) => {
el.querySelector('#ordering').value = i;
})

}
document.addEventListener('click', (el) => {
if(el.target.matches('.rowRemoveButton')){
el.target.parentNode.parentNode.remove();
countTheRow();
}
})
</script>
@endsection