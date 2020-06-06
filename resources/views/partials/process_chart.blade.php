@extends('app')

@section('content')
    {{$process}}

    {!! $chart->container() !!}

@endsection