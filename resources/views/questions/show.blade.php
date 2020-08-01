@extends('layouts.app')

@section('content')
    <div class="container">
       <question :question="{{$question}}"></question>
        {{--Specify question property and pass quesiton instance to it--}}
        <answers :question="{{$question}}"></answers>
    </div>
@endsection
