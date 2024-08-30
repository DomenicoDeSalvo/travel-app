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
                            @if(is_null($trip->thumb))
                                <div> poi ci penso </div>
                            @else
                                <img src="{{$trip->thumb}}" alt="{{$trip->location}}">
                            @endif
                            <div class="card-body">
                                <div class="fw-bold fs-3">
                                    {{$trip->location}}
                                </div>
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