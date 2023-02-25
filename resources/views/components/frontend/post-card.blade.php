@if($post->file)
    <div class="col-md-12 blog-post">
        <div>
            <div class="post-image">
                <img src="{{$post->file->view_path}}" alt="">
            </div>
            <div class="posts-content-wrap">
                <div class="post-title">
                    <a href="{{route('post.single', ['slug'=> $post->slug])}}">
                        <h2> {{$post->title}} </h2>
                    </a>
                </div>
                <div class="post-info">
                    <span><a href="#" target="_blank">{{$post->category->name}} - </a></span>
                    <span>{{$post->created_at}} / by <a href="#" target="_blank">{{$post->user->name}}</a></span>
                </div>
                <p>{!! makePostExcept($post->body, 30,) !!}</p>
                <a href="{{route('post.single', ['slug'=> $post->slug])}}" class="button button-style button-anim fa fa-long-arrow-right"><span>Read More</span></a>
            </div>
        </div>
    </div>
@else

    <div class="col-md-12 blog-post">
        <div style="padding: 20px">
            <div class="post-title">
                <a href="{{route('post.single', ['slug'=> $post->slug])}}">
                    <h2>{{$post->title}}</h2>
                </a>
            </div>  
            <div class="post-info">
                <span>{{$post->created_at}} / by <a href="#" target="_blank">{{$post->user->name}}</a></span>
            </div>  
            <p>{!! makePostExcept($post->body) !!}</p>                                   
            <a href="{{route('post.single', ['slug'=> $post->slug])}}" class="button button-style button-anim fa fa-long-arrow-right"><span>Read More</span></a>
        </div>
       
    </div>

@endif