@extends('layouts.app')

@section('title') 
    Giornata -  {{ $day->title }} 
@endsection

@section('content')

<section class="days_show">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-2 my-auto">
                <a href="{{ route('admin.stages.create', ['day' => $day->id]) }}" class="btn btn-primary">Aggiungi una tappa</a>
            </div>
            <div class="title text-center col-8 py-3">
                <h2>{{ $day->title }}</h2>
            </div>
            <div class="col-2 my-auto">
                <div class="d-flex justify-content-evenly align-items-center gap-3">
                    <a href="{{ route('admin.days.edit', $day) }}" class="btn btn-secondary">Modifica</a>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-day-{{$day->id}}">Elimina</button>
                </div>
            </div>
        </div>
        <div class="text-center pb-3">
            <h4>Parte di: <a href="{{ route('admin.trips.show', $day->trip->id) }}">{{ $day->trip->location }}</a></h4>
        </div>
    </div>

    <div class="container">
        <div>Data: {{ $day->date }}</div>
        <div>
            @if ($day->mood)
                @if ($day->mood->id === 1)
                    <i class="fa-regular fa-face-smile" aria-label="Happy"></i>
                @elseif ($day->mood->id === 2)
                    <i class="fa-regular fa-face-sad-cry" aria-label="Sad"></i>
                @elseif ($day->mood->id === 3)
                    <i class="fa-regular fa-face-laugh-beam" aria-label="Laugh"></i>
                @elseif ($day->mood->id === 4)
                    <i class="fa-regular fa-face-tired" aria-label="Tired"></i>
                @elseif ($day->mood->id === 5)
                    <i class="fa-regular fa-face-angry" aria-label="Angry"></i>
                @elseif ($day->mood->id === 6)
                    <i class="fa-regular fa-face-laugh-squint" aria-label="Laugh Squint"></i>
                @endif
            @endif
        </div>
        <div>Riassunto: {{ $day->description }}</div>
    </div>

    <!-- Carosello delle tappe -->
    <div class="container mb-5">
        <div id="carouselStages{{ $day->id }}" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @foreach ($day->stages as $stage)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="card mb-4 p-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $stage->title }}</h5>
                                <p class="card-text">
                                    @if ($stage->mood)
                                        <i class="fa-regular fa-face-{{ $stage->mood->icon_class }}"></i>
                                    @endif
                                </p>
                                <p class="card-text">{{ $stage->description }}</p>
                                <div class="text-center">

                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $stage->id }}">Galleria</button>
                                    <a href="{{ route('admin.stages.edit', $stage) }}" class="btn btn-secondary">Modifica</a>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-stage-{{$stage->id}}">Elimina</button>
                                </div>
                            </div>
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

    <!-- Carosello delle note -->
    <div class="container">
        <div class="d-flex align-items-start justify-content-between">
            <h3 class="text-center">Annotazioni del giorno</h3>
            <a href="{{ route('admin.notes.create', ['day' => $day->id]) }}" class="btn btn-primary">Scrivi una nota</a>
        </div>

        @if($day->notes->isEmpty())
            <div class="my-5">
                <h5>Ancora nessuna annotazione</h5>
            </div>
        @else
            <div id="carouselNotes{{ $day->id }}" class="carousel slide" data-bs-ride="false">
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
                                                    <a href="{{ route('admin.notes.edit', $note) }}" class="btn btn-secondary">Modifica</a>
                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-note-{{$note->id}}">Elimina</button>
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
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    <form action="{{ route('admin.notes.destroy', $note) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Sì</button>
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
                @if ($day->notes->count() > 4)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselNotes{{ $day->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselNotes{{ $day->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @endif
    </div>

    {{-- MODALE GALLERIA TAPPA --}}
    @foreach ($day->stages as $stage)
        <div class="modal fade" id="galleryModal{{ $stage->id }}" tabindex="-1" aria-labelledby="galleryModalLabel{{ $stage->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalLabel{{ $stage->id }}">Galleria di {{ $stage->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($stage->images->isEmpty())
                            <p>Nessuna immagine disponibile.</p>
                        @else
                            <div id="carouselStageImages{{ $stage->id }}" class="carousel slide" data-bs-ride="false">
                                <div class="carousel-inner">
                                    @foreach ($stage->images as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="Image for {{ $stage->title }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselStageImages{{ $stage->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselStageImages{{ $stage->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <form action="{{ route('admin.stages.destroy', $stage) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Sì</button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{ route('admin.days.destroy', $day) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Sì</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
