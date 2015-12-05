@extends('layouts.master')

@section('content')

    <h1>Task List</h1>
    <p class="lead">Here's a list of all your tasks. <a href="{{ route('tasks.create') }}">Add a new one?</a></p>
    <hr>

    @if(Session::has('flash_message'))
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @foreach($tasks as $task)
        <h3>{{ $task->title }}</h3>
        <p>{{ $task->description}}</p>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">View Task</a>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit Task</a>
            </div>
            <div class="col-md-6 text-right">
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['tasks.destroy', $task->id]
                ]) !!}
                {!! Form::submit('Delete this task?', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
    @endforeach

@stop