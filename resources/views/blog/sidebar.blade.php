<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <form action="{{ route('blog.index') }}" method="GET">
            <div class="input-group">
                <input style="border-top-right-radius: 45px;border-bottom-right-radius: 45px;" type="text" class="form-control" name="search" placeholder="Поиск статей" value="{{ request('search') }}">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
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
            <img src="/storage/{{ $post->image }}" alt="{{ $post->title }}" style="width:80px;height:60px;object-fit:cover">
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
                <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="d-flex justify-content-between">
                    <p>{{ $category->name }}</p>
                    <p>{{ $category->blogs_count }}</p>
                </a>
            </li>
            @endforeach
        </ul>
    </aside>

</div>