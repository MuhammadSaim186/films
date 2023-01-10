<?php

namespace App\Http\Controllers;

use App\Films;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class FilmController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // Here we are fetching all films from modal class
        $films = Films::get();
        return view('home')->with(['films' => $films]);
    }

    public function show($slug)
    {
        $film = Films::with('Comments')->where('slug', $slug)->firstOrFail();
        return view('films.show', ['film' => $film]);
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        $film = new Films();
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // upload image
            $path = $request->file('image')->storeAs('public/films', $fileNameToStore);
            $film->Photo = $fileNameToStore;
        }

        $alreadyExist = Films::where(["Name" => $request->name])->first();
        // pre($alreadyExist);
        if ($alreadyExist) {
            session()->flash('error', 'Films Already Exist');
            return redirect('/films');
        }
        $film->Name = $request->name;
        $film->Description = $request->description;
        $film->Rating = $request->rating;
        $film->ReleaseDate = date("Y-m-d", strtotime($request->releaseDate));
        $film->TicketPrice = $request->ticketPrice;
        $film->Country = $request->country;
        $film->Genre = $request->genre;
        $film->slug = Str::slug($request->name);
        $film->save();
        session()->flash('success', 'Films Saved Successfully');
        return redirect('/films');
    }
}
