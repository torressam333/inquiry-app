@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to
                                        all Questions</a>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="media">
                            <vote :model="{{$question}}" name="question"></vote>
                            <div class="media-body">
                                {!! $question->body_html !!}
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        @include('shared._author', [
                                             'model' => $question,
                                             'label' => 'asked'
                                         ])
                                        <user-info v-bind:model="{{$question}}" label="Asked"></user-info>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('answers._index', [
    /*Define variable that exist in child view ($answersCount & $answer)*/
    'answers'=> $question->answers,
    'answersCount' => $question->answers_count
])
        @include('answers._create')
    </div>
@endsection
