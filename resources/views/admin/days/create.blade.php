@extends('layouts.app')

@section('title', 'Aggiungi giornata')

@section('content')
<section class="create my-5">

    <div class="container">
        <h3>Aggiungi una giornata</h3>
    </div>
    <div class="container">
        <form action="{{route('admin.days.store')}}" method="POST">
            @csrf

            <input type="hidden" id="trip_id" name="trip_id" value="{{$trip_id}}">
    
            <div class="form-group mb-4">
                <label for="title">Titolo *</label>
                <input type="text" required class="form-control" id="title" placeholder="Breve titolo" name="title" value="{{ old('title') }}" maxlength="255">
            </div>
    
            <div class="form-group mb-4">
                <label for="description">Descrizione *</label>
                <textarea name="description" required id="description" cols="80" rows="5" placeholder="Cosa è successo oggi" class="form-control">{{ old('description') }}</textarea>
            </div>
    
            <div class="row row-cols-2 mb-4">
                <div class="form-group">
                    <label for="date">Data *</label>
                    <input type="date" required class="form-control" id="date" name="date" placeholder="Che giorno è" value="{{ old('date') }}">
                </div>
                <div class="form-group">
                    <label for="mood_id">Umore del giorno</label>
                    <select class="form-control" name="mood_id" id="mood_id">
                    <option value=""> -- Come ti senti? -- </option>
                    @foreach($moods as $mood) 
                        <option @selected( $mood->id == old('mood_id') ) value="{{ $mood->id }}"> {{ $mood->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>          
            <div class="mb-4 fw-lighter">
                <p>
                    I campi contrassegnati con l'asterisco (*) sono obbligatori
                </p>
            </div>
              
            <button type="submit" >Aggiungi</button>
    
        </form>

</div>
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
   
</section>

@endsection