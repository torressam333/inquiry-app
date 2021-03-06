<div class="media post">
    <div class="d-flex flex-column counters">
        <div class="vote">
            <strong>{{$question->votes_count}}</strong> {{str_plural('vote', $question->votes_count)}}
        </div>
        <div class="status {{$question->status}}">
            <strong>{{$question->answers_count}}</strong> {{str_plural('answer', $question->answers_count)}}
        </div>
        <div class="view">
            {{$question->views}} {{Str::plural('view', $question->views)}}
        </div>
    </div>
    <div class="media-body">
        <div class="d-flex align-items-center">
            <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
            <div class="ml-auto" style="min-width:150px">
                @can('update-question', $question)
                    <a href="{{route('questions.edit', $question->id)}}" class="btn btn-sm btn-outline-dark">
                        Edit
                    </a>
                @endcan
                {{--Delete--}}
                <form class="form-delete" action="{{route('questions.destroy', $question->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    @can('delete-question', $question)
                        <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this question?')"
                        >Delete
                        </button>
                    @endcan
                </form>
            </div>
        </div>
        <p class="lead">
            Asked by <a href="{{$question->user->url}}">{{$question->user->name}}</a>
            <small class="text-muted">Creation Date: {{$question->created_date}}</small><br>
            <small class="text-muted">Last Updated: {{$question->updated_date}}</small>
        </p>
        <div class="excerpt">{{$question->excerpt}}</div>
    </div>
</div>
