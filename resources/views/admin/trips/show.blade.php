@extends('layouts.app')

@section('title') Viaggio -  {{($trip->location)}} @endsection

@section('content')

    <section class="show">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-2 my-auto">
                    <button><a href="{{route('admin.days.create',$trip)}}">Aggiungi tappa</a></button>
                </div>
                <h2 class="title text-center col-8 py-5 ">{{($trip->location)}}</h2>
                <div class="col-2 my-auto">
                    <div class="d-flex justify-content-evenly  align-items-center gap-3">
                        <button><a href="{{route('admin.trips.edit',$trip)}}">Modifica</a></button>
                        <button data-bs-toggle="modal" data-bs-target="#modal-{{$trip->id}}">Elimina</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- MODALE ELIMINAZIONE --}}
        <div class="modal" id="modal-{{$trip->id}}" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Elimina</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                  <p>Vuoi eliminare questo viaggio?</p>
                </div>
                <div class="modal-footer border-0">
                  <button type="button" class="" data-bs-dismiss="modal">No</button>
                  <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST">
                            
                    @csrf
                    @method('DELETE')
        
                    <button class="bg_orange">Sì</button>
                
                    </form> 
                </div>
              </div>
            </div>
        </div>
    </section>

@endsection