@extends('layout')

@section('title', 'Tableau de bord Responsable')

@section('content')
    <h2>Tableau de bord Responsable</h2>
    <p>Bienvenue, {{ auth()->user()->nom }} !</p>
@endsection
