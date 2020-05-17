@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Editing answer for question:
                            <strong>{{$question->title}}</strong>
                        </h3>
                    </div>
                    <hr>
                    <form action="{{route('questions.answers.update',[$question->id, $answer->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                        <textarea
                            class="form-control {{$errors->has('body') ? 'is-invalid': ''}}"
                            name="body"
                            rows="10">{{old('body', $answer->body)}}</textarea>
                            @if($errors->any())
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('body')}}</strong>
                                </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-outline-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
