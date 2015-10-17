@extends('layouts.master')

@section('content')

    <h1>Welcome</h1>
    <p class="lead">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vulputate mauris non velit eleifend, ac congue odio feugiat. Duis vitae urna interdum, sodales magna quis, condimentum mauris. In id tortor erat. Proin libero dolor, interdum a auctor sed, auctor ut neque. Vivamus sed libero magna. Sed at purus lobortis, accumsan neque sed, facilisis nibh. Proin quis congue lectus, vel mollis lectus. In ligula risus, semper ut libero id, rutrum lobortis lorem. Aenean lacus elit, viverra nec lacinia ac, elementum vitae ex. Cras non ante sit amet libero pharetra tincidunt. Pellentesque massa purus, iaculis sed dictum et, rutrum nec quam.
    </p>
    <hr>

    <a href="{{ route('tasks.index') }}" class="btn btn-info">View Tasks</a>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>

@stop