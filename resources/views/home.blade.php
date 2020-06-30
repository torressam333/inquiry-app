@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <div class="form-group pt-4">
                        <a href="http://127.0.0.1:8000/" class="btn btn-md btn-outline-dark">All Questions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
