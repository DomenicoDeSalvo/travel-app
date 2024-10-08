@extends('layouts.app')

@section('title', 'Aggiungi viaggio')

@section('content')
<section class="create my-5">

    <div class="container">
        <h3 class="title">Aggiungi un viaggio</h3>
    </div>
    <div class="container">
        <form action="{{route('admin.trips.store')}}" method="POST"
        enctype="multipart/form-data" >
            @csrf
    
            <div class="form-group mb-4">
                <label for="location">Destinazione *</label>
                <input type="text" required class="form-control" id="location" placeholder="Inserisci la destinazione del viaggio" name="location" value="{{ old('location') }}" maxlength="255">
            </div>
    
              <div class="form-group mb-4">
                <label for="description">Descrizione *</label>
                <textarea name="description" required id="description" cols="80" rows="5" placeholder="Descrizione del viaggio" class="form-control">{{ old('description') }}</textarea>
              </div>
    
            <div class="row row-cols-2 mb-4">
                <div class="form-group">
                    <label for="start_date">Data di inizio *</label>
                    <input type="date" required class="form-control" id="start_date" name="start_date" placeholder="Data inizio viaggio" value="{{ old('start_date') }}">
                </div>
                <div class="form-group">
                    <label for="end_date">Data di fine</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Data fine viaggio" value="{{ old('end_date') }}">
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