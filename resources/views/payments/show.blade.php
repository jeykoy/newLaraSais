@extends('layouts.main')

@section('content')
    {{dd($transaction->id)}}

    @foreach ($transaction->payments as $item)
        {{dd($transaction)}}
        {{$items->amount}}<br>
    @endforeach
@endsection