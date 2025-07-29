<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <form action="{{ route('blog.index') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" style="    border-radius: 45px !important;" placeholder="Поиск статей" value="{{ request('search') }}">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                </span>
            </div>
        </form>
        <div class="br"></div>
    </aside>

    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title">Популярные статьи</h3>
        @foreach($popularPosts as $post)
        <div class="media post_item">
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="width:80px;height:60px;object-fit:cover">
            <div class="media-body">
                <a href="{{ route('blog.show', $post->slug) }}">
                    <h3>{{ Str::limit($post->title, 40) }}</h3>
                </a>
                <p>{{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>
        @endforeach
        <div class="br"></div>
    </aside>

    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Категории</h4>
        <ul class="list cat-list">
            @foreach($categories as $category)
            <li>
                <a href="#" class="d-flex justify-content-between">
                    <p>{{ $category->name }}</p>
                    <p>{{ $category->blogs_count }}</p>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="br"></div>
    </aside>

    <aside class="single-sidebar-widget tag_cloud_widget">
        <h4 class="widget_title">Теги</h4>
        <ul class="list">
            @foreach($categories as $category)
            <li><a href="#">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </aside>
</div>