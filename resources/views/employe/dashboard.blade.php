@extends('layout')

@section('title', 'Tableau de bord Employé')

@section('content')
    <h2>Tableau de bord Employé</h2>
    <p>Bienvenue, {{ auth()->user()->nom }} !</p>
@endsection
