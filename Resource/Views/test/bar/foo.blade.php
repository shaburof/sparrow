@extends('welcome')

@section('content')
<p>content</p>
    <p>{{ $foo ?? 'empty foo'}}</p>
@endsection
