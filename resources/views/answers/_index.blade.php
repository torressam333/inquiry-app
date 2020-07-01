@if($answersCount > 0)
    {{--https://vuejs.org/v2/api/#v-cloak--}}
    <div class="row mt-4" v-cloak>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $answersCount . " " . str_plural('Answer', $answersCount) }}</h2>
                    </div>
                    <hr>
                    @include ('layouts._messages')

                    @foreach ($answers as $answer)
                        @include('answers._answer', ['answer' => $answer])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info">
        <p class="card-body pb-1">There are currently no answers to this question. Be the first to provide one!</p>
    </div>
@endif

