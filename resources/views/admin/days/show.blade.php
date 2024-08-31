@extends('layouts.app')

@section('title') Giornata -  {{($day->title)}} @endsection

@section('content')

    <section class="days_show">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-2 my-auto">
                    <button><a href="{{ route('admin.stages.create', ['day' => $day->id]) }}">Aggiungi una tappa</a></button>

                </div>
                <div class="title text-center col-8 py-3 ">
                    <h2>{{($day->title)}}</h2>
                </div>
                <div class="col-2 my-auto">
                    <div class="d-flex justify-content-evenly  align-items-center gap-3">
                        <button><a href="{{route('admin.days.edit',$day)}}">Modifica</a></button>
                        <button data-bs-toggle="modal" data-bs-target="#modal-{{$day->id}}">Elimina</button>
                    </div>
                </div>
            </div>
            <div class="text-center pb-3">
                <h4>Parte di: <a href="{{route('admin.trips.show', $day->trip->id)}}">{{$day->trip->location}}</a></h4>
            </div>
        </div>
        <div class="container">
            <span>Data: {{$day->date}}</span>
                <span>
                    @if ($day->mood)
                    @if ($day->mood->id === 1)
                    <i class="fa-regular fa-face-smile"></i>
                    @elseif ($day->mood->id === 2)
                    <i class="fa-regular fa-face-sad-cry"></i>
                    @elseif ($day->mood->id === 3)
                    <i class="fa-regular fa-face-laugh-beam"></i>
                    @elseif ($day->mood->id === 4)
                    <i class="fa-regular fa-face-tired"></i>
                    @elseif ($day->mood->id === 5)
                    <i class="fa-regular fa-face-angry"></i>
                    @elseif ($day->mood->id === 6)
                    <i class="fa-regular fa-face-laugh-squint"></i>
                    @endif
                    @endif
                </span>
                <div>Riassunto: {{$day->description}}</div>
            </div>
        <div>
            <div class="container">
                <div class="row row-cols-1">
                    @foreach ($day->stages as $stage)
                    <div class="card mb-4 p-0">
                        {{-- <button data-bs-toggle="modal" data-bs-target="#modal-day-{{$day->id}}">Elimina</button> --}}
                        <div class="bg_image">
                            <div class="d-flex justify-content-between gap-3 mb-3">
                                <div class="d-flex gap-3">
                                    <a href="{{ route('admin.stages.show', $stage) }}" class="link-underline link-underline-opacity-0">
                                        <h5 class="card-title">{{ $stage->title }}</h5>
                                    </a>
                                    <p class="card-text">
                                        @if ($stage->mood)
                                        @if ($stage->mood->id === 1)
                                        <i class="fa-regular fa-face-smile"></i>
                                        @elseif ($stage->mood->id === 2)
                                        <i class="fa-regular fa-face-sad-cry"></i>
                                        @elseif ($stage->mood->id === 3)
                                        <i class="fa-regular fa-face-laugh-beam"></i>
                                        @elseif ($stage->mood->id === 4)
                                        <i class="fa-regular fa-face-tired"></i>
                                        @elseif ($stage->mood->id === 5)
                                        <i class="fa-regular fa-face-angry"></i>
                                        @elseif ($stage->mood->id === 6)
                                        <i class="fa-regular fa-face-laugh-squint"></i>
                                        @endif
                                        @endif
                                    </p>
                                </div>
                                {{-- <p class="card-text">{{ $day->date }}</p> --}}
                            </div>
                            <p class="card-text">{{ $stage->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            {{-- MODALE ELIMINAZIONE --}}
        <div class="modal" id="modal-{{$day->id}}" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Elimina</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                  <p>Vuoi eliminare questa giornata?</p>
                </div>
                <div class="modal-footer border-0">
                  <button type="button" class="" data-bs-dismiss="modal">No</button>
                  <form action="{{ route('admin.days.destroy', $day) }}" method="POST">
                            
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