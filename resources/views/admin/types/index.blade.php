@extends('layouts.admin')

@section('content')
    <h1>Elenco Tipi</h1>

    <div class="row">
        <div class="col-6">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif


            <form action="{{ route('admin.types.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nuova Tecnologia" name="name">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Crea</button>
                </div>
            </form>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Azioni</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                      <tr>
                        <td>
                            <form
                              action="{{ route('admin.types.update', $type) }}"
                              method="POST"
                              id="form-edit-{{$type->id}}"
                            >
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-hidden" value="{{ $type->name }}" name="name" />
                            </form>
                        </td>
                        <td>

                        <button onclick="submitForm({{$type->id}})" class="btn btn-warning" id="button-addon2"><i class="fa-solid fa-pencil"></i></button>

                        @include('admin.partials.delete_button',[
                            'route' => route('admin.types.destroy', $type),
                            'message' => 'Sei sicuro di voler eliminare questo tipo?'
                        ])



                        </td>
                      </tr>
                    @endforeach


                </tbody>
              </table>
        </div>
    </div>

    <script>
        function submitForm(id){
            const form = document.getElementById('form-edit-'+ id);
            form.submit();
        }
    </script>
@endsection
