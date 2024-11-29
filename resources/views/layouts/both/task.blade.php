@extends('layouts.master')

@section('title', 'Task Overview')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background" style="background-image: url('{{ asset('assets/img/tasks/task-1.jpg') }}');">
    <div class="container position-relative">
        <h1>Manage Your Project Tasks</h1>
        <nav class="breadcrumbs">
            <ol>
                <li>
                    <a>
                        Stay on top of your progress! Review and complete the tasks assigned to you, keeping the project
                        on track to success
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

<!-- Task Section -->
<section id="features" class="features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Your Tasks for "{{ $project->title }}"</h2>
        <p>Organize, update, and track each task to finish the project</p>
    </div>
    <!-- /Section Title -->

    <div class="container">

        <div class="task-head d-flex justify-content-end">
            <a href="#"><i
                    class="bi bi-hourglass-split"></i>{{ Carbon\Carbon::parse($project->deadline)->format('d M Y')}}</a>

            @if(auth()->user()->hasRole('freelancer'))
                <a href="{{ route('freelancer.create-task', $project->id) }}"><i class="bi bi-plus-lg"></i>CREATE
                    TASK</a>
            @elseif(auth()->user()->hasRole('client'))
                <a href="#"><i class="bi bi-person-fill"></i>{{ $project->client->name }}</a>

            @endif

        </div>

        <ul class="nav nav-tabs row g-2 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100"
            role="tablist">

            <li class="nav-item col-3" role="presentation">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1"
                    aria-selected="true" role="tab">
                    <h4>To Do</h4>
                </a>
            </li><!-- End tab nav item -->

            <li class="nav-item col-3" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2" aria-selected="false"
                    tabindex="-1" role="tab">
                    <h4>Process</h4>
                </a><!-- End tab nav item -->

            </li>
            <li class="nav-item col-3" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3" aria-selected="false"
                    tabindex="-1" role="tab">
                    <h4>Completed</h4>
                </a>
            </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            <!-- Iterasi task berdasarkan status -->
            @foreach (['to-do', 'process', 'completed'] as $status)
                <div class="tab-pane fade {{ $status == 'to-do' ? 'active show' : '' }}"
                    id="features-tab-{{ $loop->index + 1 }}" role="tabpanel">
                    <!-- Task Section -->
                    <section id="task" class="task section">
                        <div class="container">
                            @foreach ($tasks->where('status', $status) as $task)
                                <div class="task-items d-flex mb-3 align-items-center">
                                    <button type="button" class="btn-application" disabled>{{ $task->status }}</button>
                                    <div class="p-2 flex-grow-1">
                                        <p>{{ $task->desc }}</p>
                                    </div>
                                    <div class="social-links p-2 d-flex align-items-center">
                                        <a href="{{ route('comment', [$project->id, $task->id])}}"><i
                                                class="bi bi-chat-left-text"></i></a>

                                        @if(auth()->user()->hasRole('freelancer') && $project->status == 'in progress')
                                            <a href="{{ route('freelancer.update-task', [$project->id, $task->id]) }}"><i
                                                    class="bi bi-pencil-fill"></i></a>
                                            <form action="{{ route('freelancer.delete-task', [$project->id, $task->id]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this task?');"
                                                id="delete_task">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete"><i class="bi bi-trash3"></i></button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                            @if(auth()->user()->hasRole('client'))
                                <div class="d-flex justify-content-end">
                                    <form action="{{ route('client.statusCompleted', $project->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure complete this project?');">
                                        @csrf
                                        <button type="submit" class="btn-completed">Project
                                            Completed<i class="bi bi-check2-all"></i></button>
                                    </form>
                                </div>
                            @endif


                        </div>
                    </section>
                    <!-- /Task Section -->

                </div>
            @endforeach
            <!-- End iterasi task berdasarkan status -->



        </div>
    </div>
</section>
<!-- /Task Section -->



@endsection