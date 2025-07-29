@extends('layouts.app')

@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1 class="text-black">{{ $blog->title }}</h1>
                <nav class="d-flex align-items-center">
                    <span>Опубликовано {{ $blog->created_at->format('d.m.Y') }}</span>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="blog_info text-right">
                            <div class="post_tag">
                                <a href="#">{{ $blog->category->name }}</a>
                            </div>
                            <ul class="blog_meta list">
                                <li><a href="#">{{ $blog->author->name }}<i class="lnr lnr-user"></i></a></li>
                                <li><a href="#">{{ $blog->created_at->format('d M, Y') }}<i class="lnr lnr-calendar-full"></i></a></li>
                                <li><a href="#">{{ $blog->views }} просмотров<i class="lnr lnr-eye"></i></a></li>
                                <li><a href="#">{{ $blog->comments->count() }} комментариев<i class="lnr lnr-bubble"></i></a></li>
                            </ul>
                            <ul class="social-links">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 blog_details">
                        <h2>{{ $blog->title }}</h2>
                        <p class="excert">{{ $blog->excerpt }}</p>
                        {!! $blog->content !!}
                    </div>
                </div>

                <div class="navigation-area">
                    <div class="row">
                        @if($previous)
                        <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                            <div class="thumb">
                                <a href="{{ route('blog.show', $previous->slug) }}"><img class="img-fluid" src="{{ asset($previous->image) }}" alt=""></a>
                            </div>
                            <div class="arrow">
                                <a href="{{ route('blog.show', $previous->slug) }}"><span class="lnr text-white lnr-arrow-left"></span></a>
                            </div>
                            <div class="detials">
                                <p>Предыдущая статья</p>
                                <a href="{{ route('blog.show', $previous->slug) }}">
                                    <h4>{{ $previous->title }}</h4>
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        @if($next)
                        <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                            <div class="detials">
                                <p>Следующая статья</p>
                                <a href="{{ route('blog.show', $next->slug) }}">
                                    <h4>{{ $next->title }}</h4>
                                </a>
                            </div>
                            <div class="arrow">
                                <a href="{{ route('blog.show', $next->slug) }}"><span class="lnr text-white lnr-arrow-right"></span></a>
                            </div>
                            <div class="thumb">
                                <a href="{{ route('blog.show', $next->slug) }}"><img class="img-fluid" src="{{ asset($next->image) }}" alt=""></a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="comments-area">
                    <h4>{{ $blog->comments->count() }} Комментариев</h4>
                    @foreach($blog->comments as $comment)
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="{{ asset('img/blog/c'.rand(1,5).'.jpg') }}" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">{{ $comment->name }}</a></h5>
                                    <p class="date">{{ $comment->created_at->format('d M, Y \в H:i') }}</p>
                                    <p class="comment">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="comment-form">
                    <h4>Оставить комментарий</h4>
                    <form action="{{ route('blog.comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" name="name" placeholder="Ваше имя" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" name="email" placeholder="Ваш email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="comment" placeholder="Ваш комментарий" required></textarea>
                        </div>
                        <button type="submit" class="primary-btn submit_btn">Отправить</button>
                    </form>
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