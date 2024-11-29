@extends('layouts.master')

@section('title', 'Comment on Project')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background"
    style="background-image: url('{{ asset('assets/img/applications/comment-1.jpg') }}');">
    <div class="container position-relative">
        <h1>Stay Engaged with Your Project Tasks</h1>
        <nav class="breadcrumbs">
            <ol>
                <li>
                    <a>
                        Track, review, and collaborate on tasks to ensure every project milestone is achieved smoothly.
                    </a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Alert Success -->
@if(session('success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<!-- /Alert Success -->

<!-- Blog Comments Section -->
<section id="blog-comments" class="blog-comments section">

    <!-- Section Title -->
    <div class="container section-title mt-5" data-aos="fade-up">
        <h2>Ongoing Projects and Discussions</h2>
        <p>Interact, provide feedback, and manage conversations to keep projects moving in the right direction.</p>
    </div>
    <!-- End Section Title -->


    <div class="container">

        <h4 class="comments-count">{{ $comments->count() }} Comments</h4>
        @if ($comments->count())
            @foreach ($comments as $comment)
                <div id="comment" class="comment">
                    <div class="d-flex">
                        <div class="comment-img">
                            <img src="{{ asset('storage/pictures/' . ($comment->client->picture ?? $comment->freelancer->picture)) }}"
                                alt="">
                        </div>
                        <div>
                            <h5>{{ $comment->client->name ?? $comment->freelancer->name}}</h5>
                            <time>{{ Carbon\Carbon::parse($comment->time)->format('d M, Y') }}</time>
                            <p>
                                {{ $comment->comment }}
                            </p>
                        </div>
                    </div>
                </div><!-- End comment -->

            @endforeach
        @else
            <div class="col-12">
                <p>No comments available at the moment.</p>
            </div>
        @endif

    </div>

</section><!-- /Blog Comments Section -->

<!-- Comment Form Section -->
<section id="comment-form" class="comment-form section">

    <div class="container">

        <form action="{{ route('comment.store', [$project->id, $task->id]) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col d-flex form-group">
                    <input name="comment" type="text" class="form-control" placeholder="Enter your comment">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>

        </form>

    </div>
</section><!-- /Comment Form Section -->

@endsection