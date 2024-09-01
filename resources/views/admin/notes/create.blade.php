@extends('layouts.app')

@section('title', 'Scrivi nota')

@section('content')
<section class="create my-5">

    <div class="container">
        <h3>Aggiungi una nota</h3>
    </div>
    <div class="container">
        <form action="{{route('admin.notes.store')}}" method="POST">
            @csrf

            <input type="hidden" id="day_id" name="day_id" value="{{$day_id}}">
    
    
            <div class="form-group mb-4">
                <label for="text">Nota *</label>
                <textarea name="text" required id="text" cols="80" rows="5" placeholder="Aggiungi nota" class="form-control">{{ old('text') }}</textarea>
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