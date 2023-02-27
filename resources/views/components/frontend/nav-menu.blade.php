<div class="">
    <ul class="menu-link">
        @foreach ($menus as $item)
            <li><a href="{{$item->menu_link}}">{{$item->menu_name}}</a></li>
        @endforeach
    </ul>
</div>