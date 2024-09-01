@extends('layouts.app')

@section('title', '- Modifica nota')


@section('content')

    <section class="edit my-5">
        <div class="container ">
            <h3 class="title">Modifica nota</h3>
        </div>
        <div class="container">
            <form id="edit-form" action="{{route('admin.notes.update', $note)}}" method="POST">
            @csrf
            @method('PUT') 
                <input type="hidden" id="day_id" name="day_id" value="{{old('day_id' , $note->day_id)}}">
                
                <div class="form-group mb-4">
                    <label for="text">Nota *</label>
                    <textarea name="text" id="text" cols="80" rows="5" placeholder="Scrivi una nota" class="form-control">{{ old('text', $note->text) }}</textarea>
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