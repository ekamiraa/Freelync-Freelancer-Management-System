@extends('layouts.master')

@section('title', 'Update Task')

@section('content')
<!-- Page Title -->
<div class="page-title dark-background" style="background-image: url('{{ asset('assets/img/tasks/task-2.jpg') }}');">
    <div class="container position-relative">
        <h1>Manage Your Project Tasks</h1>
        <nav class="breadcrumbs">
            <ol>
                <li>
                    <a>
                        Stay on top of your progress! Review and complete the tasks assigned to you, keeping the project
                        on track to success.
                    </a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Task Form Section -->
<section id="general-form" class="general-form section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Update Task</h2>
    </div>
    <!-- /Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="{{ route('freelancer.update-task.update', [$project->id, $task->id]) }}" method="POST"
            class="php-email-form" data-aos="fade-up" data-aos-delay="400">
            @csrf
            @method('PUT')
            <div class="row gy-4">

                <div class="col-md-12">
                    <label for="desc" class="label-control">Description :</label>
                    <input type="text" name="desc" class="form-control" value="{{ old('desc', $task->desc) }}" required>
                </div>

                <div class=" col-md-12">
                    <label for="status" class="label-control">Status :</label>
                    <!-- Change to select dropdown -->
                    <select name="status" class="form-select">
                        <option value="To-Do" {{$task->status == 'to-do' ? 'selected' : ''}}>To-Do</option>
                        <option value="Process" {{$task->status == 'process' ? 'selected' : ''}}>Process</option>
                        <option value="Completed" {{$task->status == 'completed' ? 'selected' : ''}}>Completed</option>
                    </select>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit">Update Task</button>
                </div>

            </div>
        </form>

    </div>

</section>
<!-- /Task Form Section -->
@endsection