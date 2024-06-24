@extends('base')

@section('title')
My profile - InternHub
@endsection

@section('content')
<div class="afficher-resultat">
    <h2>Votre note</h2>
    <h3>{{$tester->note}}</h3>
</div>
@endsection


