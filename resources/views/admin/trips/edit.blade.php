@extends('layouts.app')

@section('title', '- Modifica viaggio')


@section('content')

    <section class="edit">
        <div class="container mt-5">
            <h3>Modifica viaggio</h3>
        </div>
        <div class="container">
            <form id="edit-form" action="{{route('admin.trips.update', $trip)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')       
               <div class="form-group mb-4">
                   <label for="location">Destinazione *</label>
                   <input type="text" required class="form-control" id="location" placeholder="Inserisci la destinazione del viaggio" name="location" value="{{ old('location', $trip->location) }}" maxlength="255">
               </div>
       
               <div class="form-group mb-4">
                    <label for="description">Descrizione *</label>
                    <textarea name="description" id="description" cols="80" rows="5" placeholder="Descrizione del viaggio" class="form-control">{{ old('description', $trip->description) }}</textarea>
               </div>

                <div class="row row-cols-2 mb-4">
                    <div class="form-group">
                        <label for="start_date">Data di inizio *</label>
                        <input type="date" required class="form-control" id="start_date" name="start_date" placeholder="Data inizio viaggio" value="{{ old('start_date', $trip->start_date) }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Data di fine</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Data fine viaggio" value="{{ old('end_date', $trip->end_date) }}">
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
           </div>
        </div>
   </section>

@endsection   