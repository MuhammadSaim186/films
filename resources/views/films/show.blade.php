@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            @if (session('success') || session('error'))
                <div class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
                    {{ session('success') ? session('success') : session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="{{ asset('public/storage/films/' . $film->Photo) }}" alt=""
                            style="object-fit:cover;width:100%;height:200px">
                        <div class="card-body">
                            <p class="card-text">Film Name : {{ $film->Name }}</p>
                            <p class="card-text">Description : {{ $film->Description }}</p>
                            <p class="card-text">Release Date : {{ $film->ReleaseDate }}</p>
                            <p class="card-text">Country : {{ $film->Country }}</p>
                            <p class="card-text">Rating : {{ $film->Rating }}</p>
                            <p class="card-text">Ticket Price : {{ $film->TicketPrice }}</p>
                            <p class="card-text">Genre : {{ $film->Genre }}</p>
                            <h3>All Comments</h3>
                            <div class="comments-section">
                                @foreach ($film->Comments as $comment)
                                    <div class="card comment-box mb-3 p-2">
                                        <div class="comment-header">
                                            <h6 class="username">{{ $comment->Name }}</h6>
                                            <span class="date">{{ get_full_time($film->created_at) }}</span>
                                        </div>
                                        <p class="comment">{{ $comment->Comment }}</p>
                                    </div>
                                @endforeach
                            </div>

                            @if (Auth::user())
                                <form action="{{ route('storeComment') }}" method="post">
                                    @CSRF
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter your name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" id="comment" rows="3" placeholder="Enter your comment" name="comment"></textarea>
                                        <input type="hidden" name="slug" value="{{ $film->Slug }}" />
                                        <input type="hidden" name="film_id" value="{{ $film->id }}" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
