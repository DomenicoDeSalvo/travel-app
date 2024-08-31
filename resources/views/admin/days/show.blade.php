@extends('layouts.app')

@section('title') Giornata -  {{($day->title)}} @endsection

@section('content')


 <div>{{$day->title}}</div>
 <div>{{$day->date}}</div>
 <div>{{$day->description}}</div>
 <div>{{$day->mood->name}}</div>



@endsection