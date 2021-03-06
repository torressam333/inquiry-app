<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <hr>
                @if (!Auth::guest())
                <form action="{{route('questions.answers.store', $question->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control {{$errors->has('body') ? 'is-invalid': ''}}" name="body" rows="10"></textarea>
                        @if($errors->any())
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('body')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-outline-info">Submit</button>
                    </div>
                </form>
                @else
                    <div class="alert alert-warning">
                        <p class="card-body pb-1">You are not logged in. Please register or login to add answers to questions.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
