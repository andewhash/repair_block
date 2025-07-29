@extends('layouts.app')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Блог</h1>
                <nav class="d-flex align-items-center">
                    <span class="text-white">Последние статьи и новости</span>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Area =================-->
<section class="blog_area mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    @foreach($blogs as $blog)
                    <article class="row blog_item">
                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <a href="#">{{ $blog->category->name }}</a>
                                </div>
                                <ul class="blog_meta list">
                                    <li><a href="#">{{ $blog->author->name }}<i class="lnr lnr-user"></i></a></li>
                                    <li><a href="#">{{ $blog->created_at->format('d M, Y') }}<i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="#">{{ $blog->views }} просмотров<i class="lnr lnr-eye"></i></a></li>
                                    <li><a href="#">{{ $blog->comments_count }} комментариев<i class="lnr lnr-bubble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="blog_post">
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                                <div class="blog_details">
                                    <a href="{{ route('blog.show', $blog->slug) }}">
                                        <h2>{{ $blog->title }}</h2>
                                    </a>
                                    <p>{{ $blog->excerpt }}</p>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="white_bg_btn">Читать далее</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach

                    {{ $blogs->links('vendor.pagination.custom') }}
                </div>
            </div>
            <div class="col-lg-4">
                @include('blog.sidebar', ['popularPosts' => $popularPosts, 'categories' => $categories])
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->
@endsection