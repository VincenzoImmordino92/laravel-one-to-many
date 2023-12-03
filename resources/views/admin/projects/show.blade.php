@extends('layouts.admin')

@section('content')

    <h1>Nome Progetto:{{$project->title}}</h1>

    <a class="btn btn-secondary" href="{{route('admin.projects.index')}}">Torna alla Home</a>

    <a class="btn btn-warning" href="{{route('admin.projects.edit',$project)}}"><i class="fa-solid fa-pencil"></i></a>

    {{-- <form action="{{ route("admin.projects.destroy", $project) }}"
    method="POST"
    onsubmit="return confirm ('Sei sicuro di voler eliminare questo progetto?')"
    class="d-inline-block">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
    </form> --}}



    <div class="container_custom">
        <h3 class="title text-decoration-underline">{{$project->title}}</h3>
        @if($project->type)
        <p>Tipo: <strong>{{ $project->type?->name }}</strong></p>
        @endif
        <div class="w-50">
            <img class="img-fluid" src="{{asset('storage/'.$project->image) }}" alt="{{$project->title}}">
            <p>{{ $project->image_original_name }}</p>
        </div>

        <p>Data di Inizio Progetto{{$project->start_date}}</p>
        <p>Data di Fine Progetto{{$project->end_date}}</p>
        <div class="description">
            <p>{!! $project->description !!}</p>
            <p>{{$project->url}}</p>
        </div>

        <p></p>

    </div>

@endsection
