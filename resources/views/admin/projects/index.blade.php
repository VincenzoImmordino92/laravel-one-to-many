@extends('layouts.admin')

@section('content')

    <h1>Elenco progetti</h1>
    <div class="d-flex align-items-center">
        <h5>Inserisci nuovo Progetto --></h5>
        <a href="{{route('admin.projects.create')}}" class="btn btn-secondary m-2 d-inline-block"><i class="fa-solid fa-plus"></i></a>
    </div>


    @if(session("deleted"))
        <div class="alert alert-success" role="alert">
            {{session("deleted")}}
        </div>
    @endif


    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome Progetto</th>
            <th scope="col">Data di inizio</th>
            <th scope="col">Tipo</th>
            <th scope="col">Azioni</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
            <td>{{$project->id}}</td>
            <td>{{$project->title}}</td>
            <td>{{$project->start_date}}</td>
            <td>{{$project->type?->name ?? '-'}}</td>
            <td><a class="btn btn-success" href="{{route('admin.projects.show',$project)}}"><i class="fa-solid fa-eye"></i></a>
                <a class="btn btn-warning" href="{{route('admin.projects.edit',$project)}}"><i class="fa-solid fa-pencil"></i></a>
                @include('admin.partials.delete_button',[
                    'route' => route('admin.projects.destroy', $project),
                    'message' => 'Sei sicuro di voler eliminare questo Progetto?'
                ])
            </td>

            </tr>
            @endforeach
        </tbody>
    </table>

{{$projects->links()}}


@endsection
