@extends('layouts.app')

@section('title') Viaggio -  {{($trip->location)}} @endsection

@section('content')

    <section class="show">
        <div class="container">
            <h2 class="text-center py-3">{{$trip->location}}</h2>

        </div>
    </section>

@endsection