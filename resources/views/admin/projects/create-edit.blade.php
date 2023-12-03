@extends('layouts.admin')

@section('content')

    <h1>{{ $title }}</h1>


    {{-- $errors->any() restituisce true se almeno un errore è presente nel form --}}
    {{-- $errors->all() restituisce tutti gli errori che sono all'interno del nostro array --}}
    @if($errors->any())
    <div class="alert alert-danger col-6" role="alert">
        Devi riempire i Campi
    </div>
    @endif

    <div class="row">
        <div class="col-6">
            <form  action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method( $method)
            <div class="my-2">
                <label for="title" class="form-label">Nome Progetto *</label>
                <input
                        type="text"
                        class="form-control
                        @error('title')
                        is-invalid
                        @enderror"
                        id="title"
                        name="title"
                        value="{{old('title', $project?->title)}}">

                @error('title')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="my-2">
                <label for="type_id" class="form-label">Tipo</label>
                <select name="type_id" class="form-select" id="type_id">
                    <option value="">Seleziona il Tipo di Progetto</option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}" {{old('type_id', $project?->type_id) === $type->id?'selected':''}}>{{ $type->name }}</option>

                    @endforeach

                </select>
            </div>

            <div class="my-2">
                <label for="image" class="form-label">Immagine</label>
                <input
                        type="file"
                        onchange="showImage(event)"
                        class="form-control
                        @error('image')
                        is-invalid
                        @enderror"
                        id="image"
                        name="image"
                        value="{{old('image', $project?->image)}}">

                @error('image')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                {{-- in caso di errore del caricamento dell'immagine carico il placeholder --}}
                <img id="thumb" width="150" onerror="this.src='/img/Placeholder.png'" src="{{ asset('storage/'. $project?->image) }}">


            </div>

            <div class="my-2">
                <label for="start_date" class="form-label">Data di Inizio *</label>
                <input
                        type="date"
                        class="form-control
                        @error('start_date')
                        is-invalid
                        @enderror"
                        id="start_date"
                        name="start_date"
                        value="{{old('start_date', $project?->start_date)}}">

                @error('start_date')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="my-2">
                <label for="end_date" class="form-label">Data di Fine</label>
                <input
                        type="date"
                        class="form-control
                        @error('end_date')
                        is-invalid
                        @enderror"
                        id="end_date"
                        name="end_date"
                        value="{{old('end_date',$project?->end_date)}}">

                @error('end_date')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="my-2">
                <label for="description" class="form-label">Descrizione *</label>
                <textarea
                        rows="4" cols="50"
                        class="form-control
                        @error('description')
                        is-invalid
                        @enderror"
                        id="description"
                        name="description">{{old('description',$project?->description)}}</textarea>

                @error('description')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="my-2">
                <label for="url" class="form-label">Link/URL *</label>
                <input
                        type="text"
                        class="form-control
                        @error('url')
                        is-invalid
                        @enderror"
                        id="url"
                        name="url"
                        value="{{old('url',$project?->description)}}">

                @error('url')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Invio</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <a href="{{route('admin.projects.index')}}" class="btn btn-dark my-1">Torna alla Pagina precedente</a>

            </form>
        </div>
    </div>

    <script>
        function showImage(event){
            const thumb = document.getElementById('thumb');
            //associo a src l'immagine caricata
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }

    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );


    </script>

@endsection
