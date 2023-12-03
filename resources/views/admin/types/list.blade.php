@extends('layouts.admin')

@section('content')


<h1>Lista di Progetti per Tipo</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tipo</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
        <tr>
            <td>{{ $type->id }}</td>
            <td>{{ $type->name }}</td>
            <td>
                <ul>
                    <ul class="list-group">
                        @foreach ($type->projects as $project)
                        <li class="list-group-item"><a href="{{route('admin.projects.show', $project )}}">{{ $project->title }}</a>

                        </li>

                        @endforeach
                      </ul>
                </ul>
            </td>

        </tr>
            @endforeach
        </tbody>
    </table>

@endsection
