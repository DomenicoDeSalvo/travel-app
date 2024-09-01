@extends('layouts.app')

@section('title', '- Modifica tappa')

@section('content')

<section class="edit my-5">
    <div class="container">
        <h3 class="title">Modifica tappa</h3>
    </div>
    <div class="container">
        <form id="edit-form" action="{{route('admin.stages.update', $stage)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="day_id" name="day_id" value="{{old('day_id' , $stage->day_id)}}">
            
            <div class="form-group mb-4">
                <label for="title">Titolo *</label>
                <input type="text" required class="form-control" id="title" placeholder="Cosa hai visto" name="title" value="{{ old('title', $stage->title) }}" maxlength="255">
            </div>
    
            <div class="form-group mb-4">
                <label for="description">Descrizione *</label>
                <textarea name="description" id="description" cols="80" rows="5" placeholder="La tua esperienza" class="form-control">{{ old('description', $stage->description) }}</textarea>
            </div>

            <div class="row row-cols-2 mb-4">
                <div class="form-group">
                    <label for="mood_id">Umore</label>
                    <select class="form-control" name="mood_id" id="mood_id">
                        <option value=""> -- Come è andata? -- </option>
                        @foreach($moods as $mood)
                            <option @selected( $mood->id == old('mood_id', $stage->mood_id) ) value="{{ $mood->id }}"> {{ $mood->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Sezione per le immagini esistenti -->
            <div class="form-group mb-4">
                <label>Immagini esistenti</label>
                <div class="row">
                    @foreach($stage->images as $image)
                        <div class="col-3 mb-3">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image for {{ $stage->title }}" class="img-fluid">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                <label class="form-check-label" for="delete_image_{{ $image->id }}">
                                    Elimina
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Aggiungere nuove immagini -->
            <div class="form-group mb-4">
                <label for="images" class="form-label">Aggiungi nuove immagini</label>
                <input class="form-control" type="file" id="images" name="images[]" multiple>
                <small class="text-muted">Puoi caricare più di un'immagine.</small>
            </div>

            <div class="mb-4 fw-lighter">
                <p>
                    I campi contrassegnati con l'asterisco (*) sono obbligatori
                </p>
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>

        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
