@extends('layouts.app')

@section('title') 
    Giornata -  {{ $day->title }} 
@endsection

@section('content')

<section class="days_show my-5">
    <div class="container ">
        <h2 class="title mt-4 mb-2">{{ $day->title }}</h2>
        <h4 class="pb-3">Parte di: <a class="trip" href="{{ route('admin.trips.show', $day->trip->id) }}">{{ $day->trip->location }}</a></h4>
        <div class="my-auto">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                <button><a href="{{ route('admin.stages.create', ['day' => $day->id]) }}">Aggiungi una tappa</a></button>
            <div>
                <button><a href="{{ route('admin.days.edit', $day) }}">Modifica</a></button>
                <button class="bg_orange" data-bs-toggle="modal" data-bs-target="#modal-day-{{$day->id}}">Elimina</button>
            </div>
        </div>
    </div>

    <!-- Contenitore per carosello delle tappe e le note -->
    <div class="container">
        <div class="row">
            <!-- Carosello delle tappe -->
            <div class="col-lg-12">
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
        </div>

        <!-- Note con scrollbar orizzontale -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <h5 class="mb-4">Annotazioni del giorno</h5>
                <button class="mb-3">
                    <a href="{{ route('admin.notes.create', ['day' => $day->id]) }}">Scrivi una nota</a>
                </button>
                @if($day->notes->isEmpty())
                    <p>Ancora nessuna annotazione</p>
                @else
                    <div class="slides" >
                        @foreach ($day->notes as $note)
                            <div class="note d-inline-block mb-3 p-3">
                                <p class="hand">{{ $note->text }}</p>
                                <div class="d-flex justify-content-between">
                                    <button>
                                        <a href="{{ route('admin.notes.edit', $note) }}">Modifica</a>
                                    </button>
                                    <button class="bg_orange" data-bs-toggle="modal" data-bs-target="#modal-note-{{$note->id}}">Elimina</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
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
        <div class="modal fade" id="modal-stage-{{$stage->id}}" tabindex="-1" aria-labelledby="modal-label-{{$stage->id}}" aria-hidden="true">
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
                        <button type="button" data-bs-dismiss="modal">No</button>
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

    {{-- MODALE ELIMINAZIONE NOTA --}}
    @foreach ($day->notes as $note)
        <div class="modal fade" id="modal-note-{{$note->id}}" tabindex="-1" aria-labelledby="modal-label-note" aria-hidden="true">
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
                        <button type="button"  data-bs-dismiss="modal">No</button>
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

    {{-- MODALE ELIMINAZIONE GIORNATA --}}
    <div class="modal fade" id="modal-day-{{$day->id}}" tabindex="-1" aria-labelledby="modal-label-day" aria-hidden="true">
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
                    <button type="button" data-bs-dismiss="modal">No</button>
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
