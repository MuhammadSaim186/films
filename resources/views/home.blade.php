@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            @if (session('success') || session('error'))
                <div class="alert alert-{{ (session('success')) ? 'success' : 'danger' }}">
                    {{ (session('success')) ? session('success') : session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 mb-3">
                    <a href="{{ route('create') }}" class="btn btn-primary">Add Film</a>
                </div>
                @foreach ($films as $film)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="{{ asset('public/storage/films/' . $film->Photo) }}" alt=""
                                style="object-fit:cover;" width="100" height="100">
                            <div class="card-body">
                                <p class="card-text">{{ $film->Name }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-outline-secondary"
                                            href="{{ route('film', $film->Slug) }}">View</a>
                                        {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                                    </div>
                                    {{-- <small class="text-muted">9 mins</small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
