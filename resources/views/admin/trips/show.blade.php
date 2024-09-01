@extends('layouts.app')

@section('title') Viaggio -  {{ $trip->location }} @endsection

@section('content')

<section class="show">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-2 my-auto">
                <button><a href="{{ route('admin.days.create', ['trip' => $trip->id]) }}">Aggiungi giornata</a></button>
            </div>
            <h2 class="title text-center col-8 py-5">{{ $trip->location }}</h2>
            <div class="col-2 my-auto">
                <div class="d-flex justify-content-evenly align-items-center gap-3">
                    <button><a href="{{ route('admin.trips.edit', $trip) }}">Modifica</a></button>
                    <button data-bs-toggle="modal" data-bs-target="#modal-trip-{{$trip->id}}">Elimina</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1">
            @foreach ($trip->days as $day)
            <div class="card mb-4 p-0">
                <button data-bs-toggle="modal" data-bs-target="#modal-day-{{$day->id}}">Elimina</button>
                <div class="bg_image">
                    <div class="d-flex justify-content-between gap-3 mb-3">
                        <div class="d-flex gap-3">
                            <a href="{{ route('admin.days.show', $day) }}" class="link-underline link-underline-opacity-0">
                                <h5 class="card-title">{{ $day->title }}</h5>
                            </a>
                            <p class="card-text">
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
                            </p>
                        </div>
                        <p class="card-text">{{ $day->date }}</p>
                    </div>
                    <p class="card-text">{{ $day->description }}</p>
                </div>
            </div>

            {{-- MODALE ELIMINAZIONE GIORNATA --}}
            <div class="modal" id="modal-day-{{$day->id}}" tabindex="-1" aria-labelledby="modal-label-{{$day->id}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Elimina</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
            @endforeach
        </div> 
    </div>

    {{-- MODALE ELIMINAZIONE VIAGGIO --}}
    <div class="modal" id="modal-trip-{{$trip->id}}" tabindex="-1" aria-labelledby="modal-label-trip" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Elimina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
