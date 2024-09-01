@extends('layouts.app')

@section('title') 
    Giornata -  {{ $day->title }} 
@endsection

@section('content')

<section class="days_show">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-2 my-auto">
                <button>
                    <a href="{{ route('admin.stages.create', ['day' => $day->id]) }}">Aggiungi una tappa</a>
                </button>
            </div>
            <div class="title text-center col-8 py-3">
                <h2>{{ $day->title }}</h2>
            </div>
            <div class="col-2 my-auto">
                <div class="d-flex justify-content-evenly align-items-center gap-3">
                    <button>
                        <a href="{{ route('admin.days.edit', $day) }}">Modifica</a>
                    </button>
                    <button data-bs-toggle="modal" data-bs-target="#modal-day-{{$day->id}}">Elimina</button>
                </div>
            </div>
        </div>
        <div class="text-center pb-3">
            <h4>Parte di: <a href="{{ route('admin.trips.show', $day->trip->id) }}">{{ $day->trip->location }}</a></h4>
        </div>
    </div>

    <div class="container">
        <span>Data: {{ $day->date }}</span>
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
        <div>Riassunto: {{ $day->description }}</div>
    </div>

    <div class="container">
        <div id="carouselStages{{ $day->id }}" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($day->stages as $stage)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="card mb-4 p-0">
                            <div class="bg_image">
                                <div class="d-flex justify-content-between gap-3 mb-3">
                                    <div class="d-flex gap-3">
                                        <h5 class="card-title">{{ $stage->title }}</h5>
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
                                </div>
                                <p class="card-text">{{ $stage->description }}</p>
                            </div>
                            <button>
                                <a href="{{ route('admin.stages.edit', $stage) }}">Modifica</a>
                            </button>
                            <button data-bs-toggle="modal" data-bs-target="#modal-stage-{{$stage->id}}">Elimina</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselStages{{ $day->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselStages{{ $day->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="d-flex align-items-start justify-content-between">
            <h3 class="text-center">Annotazioni del giorno</h3>
            <button>
                <a href="{{ route('admin.notes.create', ['day' => $day->id]) }}">Scrivi una nota</a>
            </button>
        </div>
        @if($day->notes->isEmpty())
            <div class="my-5">
                <h5>Ancora nessuna annotazione</h5>
            </div>
        @else
            <div id="carouselNotes{{ $day->id }}" class="carousel slide">
                <div class="carousel-inner">
                    @foreach ($day->notes->chunk(4) as $chunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $note)
                                    <div class="col-3 d-flex align-items-stretch">
                                        <div class="card flex-fill mb-3">
                                            <div class="card-body">
                                                <p>{{ $note->text }}</p>
                                                <div>
                                                    <button>
                                                        <a href="{{ route('admin.notes.edit', $note) }}">Modifica</a>
                                                    </button>
                                                    <button data-bs-toggle="modal" data-bs-target="#modal-note-{{$note->id}}">Elimina</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- MODALE ELIMINAZIONE NOTA --}}
                                    <div class="modal" id="modal-note-{{$note->id}}" tabindex="-1" aria-labelledby="modal-label-note" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Elimina Nota</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Vuoi eliminare questa nota?</p>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="" data-bs-dismiss="modal">No</button>
                                                    <form action="{{ route('admin.notes.destroy', $note) }}" method="POST">
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
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselNotes{{ $day->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselNotes{{ $day->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif
    </div>

    {{-- MODALE ELIMINAZIONE TAPPA --}}
    @foreach ($day->stages as $stage)
        <div class="modal" id="modal-stage-{{$stage->id}}" tabindex="-1" aria-labelledby="modal-label-{{$stage->id}}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Elimina Tappa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Vuoi eliminare questa tappa?</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="" data-bs-dismiss="modal">No</button>
                        <form action="{{ route('admin.stages.destroy', $stage) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg_orange">Sì</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- MODALE ELIMINAZIONE GIORNATA --}}
    <div class="modal" id="modal-day-{{$day->id}}" tabindex="-1" aria-labelledby="modal-label-day" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Elimina Giornata</h5>
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
</section>

@endsection
