@extends('layouts.app')

@section('title') Viaggio -  {{ $trip->location }} @endsection

@section('content')

<section class="show">
    <div class="container text-center">
        <h2 class="title text-center mt-4 mb-2">{{ $trip->location }}</h2>
        <div class=" my-auto">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                <button><a href="{{ route('admin.days.create', ['trip' => $trip->id]) }}">Aggiungi giornata</a></button>
                <div>
                    <button><a href="{{ route('admin.trips.edit', $trip) }}">Modifica</a></button>
                    <button data-bs-toggle="modal" data-bs-target="#modal-trip-{{$trip->id}}"class="bg_orange">Elimina</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1">
            @foreach ($trip->days as $day)
            <div class="card mb-4 p-0">
                <div class="bg_image">
                    <div class="d-flex justify-content-between gap-3 mb-3">
                        <div class="d-flex gap-3">
                            <a href="{{ route('admin.days.show', $day) }}" class="link-underline link-underline-opacity-0">
                                <h5 class="card-title hand">{{ $day->title }}</h5>
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
                        <p class="card-text">{{ \Carbon\Carbon::parse($day->date)->format('d-m-Y') }}</p>
                    </div>
                    <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
                        <p class="card-text hand">{{ $day->description }}</p>
                        <div class="d-flex flex-column gap-2">
                            <button><a href="{{ route('admin.days.edit', $day) }}">Modifica</a></button>
                            <button data-bs-toggle="modal" data-bs-target="#modal-day-{{$day->id}}"class="bg_orange">Elimina</button>
                        </div>
                    </div>
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

