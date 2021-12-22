@extends('layout')

@section('tittle')
Utwórz kategorie
@endsection

@section('body')
<form method="POST" action="{{ route('category.create') }}">
   {{ csrf_field() }}
   <label> Nazwa: </label>
   <br>
   <input type="text" name="name" required>

   <br>
   <br>

   <input type="submit" value="Dodaj">
</form>
@endsection
