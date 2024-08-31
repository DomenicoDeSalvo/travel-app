@extends('layouts.app')

@section('title', 'Aggiungi tappa')

@section('content')
<section class="create">

    <div class="container">
        <h3>Aggiungi una tappa</h3>
    </div>
    <div class="container">
        <form action="{{route('admin.stages.store')}}" method="POST">
            @csrf

            <input type="hidden" id="day_id" name="day_id" value="{{$day_id}}">
    
            <div class="form-group mb-4">
                <label for="title">Titolo *</label>
                <input type="text" required class="form-control" id="title" placeholder="Cosa hai visto" name="title" value="{{ old('title') }}" maxlength="255">
            </div>
    
              <div class="form-group mb-4">
                <label for="description">Descrizione *</label>
                <textarea name="description" required id="description" cols="80" rows="5" placeholder="La tua esperienza" class="form-control">{{ old('description') }}</textarea>
              </div>
    
            <div class="row row-cols-2 mb-4">
                <div class="form-group mb-4">
                    <label for="thumb" class="form-label">Anteprima</label>
                    <input class="form-control" type="file" id="thumb" name="thumb" >
                </div>
                <div class="form-group">
                    <label for="mood_id">Umore</label>
                    <select class="form-control" name="mood_id" id="mood_id">
                    <option value=""> -- Come è andata? -- </option>
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