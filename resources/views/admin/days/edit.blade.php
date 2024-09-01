@extends('layouts.app')

@section('title', '- Modifica giornata')


@section('content')

    <section class="edit">
        <div class="container">
            <h3>Modifica giornata</h3>
        </div>
        <div class="container">
            <form id="edit-form" action="{{route('admin.days.update', $day)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            
                <input type="hidden" id="trip_id" name="trip_id" value="{{old('trip_id' , $day->trip_id)}}">
                <div class="form-group mb-4">
                   <label for="title">Titolo *</label>
                   <input type="text" required class="form-control" id="title" placeholder="Breve titolo" name="title" value="{{ old('title', $day->title) }}" maxlength="255">
                </div>
       
                <div class="form-group mb-4">
                    <label for="description">Descrizione *</label>
                    <textarea name="description" id="description" cols="80" rows="5" placeholder="Descrizione del viaggio" class="form-control">{{ old('description', $day->description) }}</textarea>
                </div>

                <div class="row row-cols-2 mb-4">
                    <div class="form-group">
                        <label for="date">Data di inizio *</label>
                        <input type="date" required class="form-control" id="date" name="date" placeholder="Che giorno è" value="{{ old('date', $day->date) }}">
                    </div>
                    <div class="form-group">
                        <label for="mood_id">Umore del giorno</label>
                        <select class="form-control" name="mood_id" id="mood_id">
                          <option value=""> -- Come ti senti? -- </option>
                          @foreach($moods as $mood) 
                            <option @selected( $mood->id == old('mood_id', $day->mood_id) ) value="{{ $mood->id }}"> {{ $mood->name }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-4 fw-lighter">
                    <p>
                       I campi contrassegnati con l'asterisco (*) sono obbligatori
                    </p>
                </div>
                <button type="submit">Salva</button>
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
           <    /div>
        </div>
   </section>

@endsection   