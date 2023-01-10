@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('create') }}" id="register" class="ajaxForm nopopup"  role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputText">Film Name</label>
                            <input type="text" class="form-control" id="exampleInputText" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNumber">Release Date</label>
                            <input type="date" class="form-control" id="exampleInputNumber" name="releaseDate">
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Select Genre</label>
                            <select class="form-control" id="exampleSelect1" name="genre[]" multiple>
                                <option>Action</option>
                                <option>Adventure</option>
                                <option>Comedy</option>
                                <option>Crime</option>
                                <option>Drama</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect3">Select Country</label>
                            <select class="form-control" id="exampleSelect3" name="country">
                                <option>Pakistan</option>
                                <option>India</option>
                                <option>USA</option>
                                <option>UK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Select Rating</label>
                            <select class="form-control" id="exampleSelect2" name="rating">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNumber">Ticket Price</label>
                            <input type="number" class="form-control" id="exampleInputNumber" name="ticketPrice">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Description</label>
                            <textarea class="form-control" id="exampleTextarea" rows="4" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" class="form-control-file" id="exampleInputFile"
                                aria-describedby="fileHelp" name="image">
                            <small id="fileHelp" class="form-text text-muted">Please upload a file.</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </div>
            </div>
        @endsection
