@extends('layouts.app')

@section('content')
    <div style="font-size: 50px; text-align: center; color: rgb(56, 44, 44);margin-bottom: 20px">
        <h1 style="border: solid 1px rgb(134, 136, 4); ">
            Blog Page
        </h1>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-primary d-flex align-items-center bg-red-900" role="alert">
            <svg class="bi flex-shrink-0 me-2 bg-red-900" width="24" height="24" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />Deleted
            </svg>
            <div>
                {{ session()->get('message') }}
            </div>
        </div>
    @endif
    <div class="tm-home-img-container" style="height: 400px">
        <img src="tm-img-1010x336-1.jpg" alt="Image" class="hidden-lg-up img-fluid">
    </div>

    <section class="tm-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-xs-center">
                    <h2 class="tm-gold-text tm-title">Introduction</h2>
                    <p class="tm-subtitle">Suspendisse ut magna vel velit cursus tempor ut nec nunc. Mauris vehicula, augue
                        in tincidunt porta, purus ipsum blandit massa.</p>
                </div>
            </div>
            @if (Auth::check())
                <div style="margin-left: 200px; width: 150px; ">
                    <button class="btn-danger">
                        <a href="/blog/create" style="text-decoration: none; color: white" class="text-uppercase">Add New
                            Post</a>

                    </button>
                </div>
            @endif
            <div style="margin-left: 50px">


                @foreach ($posts as $post)
                    <div class="row tm-margin-t-big">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6"
                            style="margin-left: 25%; margin-right: 30%; margin-top: 60px">
                            <div class="tm-2-col-left" style="margin-left: auto; margin-right: auto; width: 100%; ">

                                <div>
                                    <h3 class="tm-gold-text tm-title">{{ $post->title }}</h3>
                                    <img src="/image_for_web/{{ $post->image }}" alt="Image"
                                        class="tm-margin-b-40 img-fluid">

                                </div>

                                Created by :<span style="color: red">{{ $post->user->name }}</span><br>
                                Created at :<span
                                    style="color: red">{{ date('d-m-Y', strtotime($post->updated_at)) }}</span>


                                <div>
                                    <p>
                                        {{ $post->content }}
                                    </p>

                                    <div>
                                        <a href="/blog/{{ $post->id }}" class="btn btn-info text-uppercase">Read
                                            More</a>
                                    </div>
                                    <hr style="border-top: 3px solid black">
                                </div>

                                <div>
                                    <form action="blog.index" method="post">
                                        <div>
                                            <label style="color: red; font-size: 20px">Comments</label>
                                            <textarea name="comment" id="comment" placeholder="Write Comment" class="form-control" style="width: 100%"></textarea>
                                        </div>
                                        <br>
                                        <button class="btn btn-primary" type="submit">
                                            Comment
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div> <!-- row -->
                @endforeach
            </div>


        </div>
    </section>
@endsection
