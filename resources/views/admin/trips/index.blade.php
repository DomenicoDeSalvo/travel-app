@extends('layouts.app')

@section('title', 'I miei viaggi')

@section('content')

    <section class="index">
        <div class="container">
            <div class="row justify-content-end">
                <h1 class="title text-center col-8 py-5 ">I miei viaggi</h1>
                <button class="col-2 my-auto"><a href="{{route('admin.trips.create')}}" class="link-underline link-underline-opacity-0">Aggiungi viaggio</a></button>
            </div>
        </div>

        <div class="container text-center">
            @if($trips->isEmpty())
                <div class="my-5 ">
                    <h3>Ancora nessun viaggio</h3>
                </div>
            @else
                <div class="row row-cols-4">
                    @foreach ($trips as $trip)
                    <div class="col m-auto m-sm-0 d-flex align-items-stretch">
                        <div class="card flex-fill mb-3">
                            <a href="{{route('admin.trips.show', $trip)}}" class="thumb link-underline link-underline-opacity-0">
                                @if(is_null($trip->thumb))
                                    <img src="{{asset('/img/Logo.png')}}" alt="{{$trip->location}}">
                                @else
                                <figure>
                                    <img src="{{asset('storage/'.$trip->thumb)}}" alt="{{$trip->location}}">
                                </figure>
                                @endif
                            </a>
                            <div class="card-body">
                                <a href="{{route('admin.trips.show', $trip)}}" class="link-underline link-underline-opacity-0">
                                    <div class="fw-bold fs-3">{{$trip->location}}</div>
                                </a>
                                <div class="dates">
                                    <span>
                                        {{$trip->start_date}} - 
                                    </span>
                                    <span>
                                        @if(is_null($trip->end_date))
                                            <span> In corso </span>
                                        @else
                                            {{$trip->end_date}}
                                        @endif
                                    </span>  
                                </div>
                            </div>
                          </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection