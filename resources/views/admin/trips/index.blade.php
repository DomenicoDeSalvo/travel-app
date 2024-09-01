@extends('layouts.app')

@section('title', 'I miei viaggi')

@section('content')

    <section class="index">
        <div class="container">
            <div class="row row-cols-2  justify-content-end">
                <h1 class="title text-center col col-xl-8 py-5 ">I miei viaggi</h1>
                <div class="col col-xl-2 my-auto">
                    <button><a href="{{route('admin.trips.create')}}" class="px-0">Aggiungi viaggio</a></button>
                </div>
            </div>
        </div>

        <div class="container text-center">
            @if($trips->isEmpty())
                <div class="my-5 ">
                    <h3>Ancora nessun viaggio</h3>
                </div>
            @else
                <div class="row row-cols-lg-6 row-cols-md-4 row-cols-sm-3 row-cols-2">
                    @foreach ($trips as $trip)
                    <div class="col m-auto m-sm-0 d-flex align-items-stretch">
                        <div class="card flex-fill mb-3">
                            <div class="card-body">
                                <a href="{{route('admin.trips.show', $trip)}}" class="link-underline link-underline-opacity-0">
                                    <div class="hand fw-bold fs-3">{{$trip->location}}</div>
                                </a>
                                <div class="dates hand mt-4">
                                    <div class="mb-2">
                                        {{$trip->start_date}}  
                                    </div>
                                    <div class="mb-2">
                                        @if(is_null($trip->end_date))
                                            <span> In corso </span>
                                        @else
                                            {{$trip->end_date}}
                                        @endif
                                    </div>  
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