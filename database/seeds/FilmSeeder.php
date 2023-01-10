<?php

use App\Comment;
use App\Films;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $films = [
            [
                'Name' => 'Film 1',
                'Description' => 'Description for Film 1',
                'ReleaseDate' => '2022-01-01',
                'Rating' => 3,
                'TicketPrice' => 500,
                'Country' => "USA",
                'Genre' => "Drama",
                "Slug" => Str::slug("Film 1"),
                "Photo" => "sc_1673371325.png"
            ],
            [
                'Name' => 'Film 2',
                'Description' => 'Description for Film 2',
                'ReleaseDate' => '2022-02-01',
                'Rating' => "5",
                'TicketPrice' => 600,
                'Country' => "India",
                'Genre' => "Comedy",
                "Slug" => Str::slug("Film 2"),
                "Photo" => "sc_1673371325.png"
            ],
            [
                'Name' => 'Film 3',
                'Description' => 'Description for Film 3',
                'ReleaseDate' => '2022-03-01',
                'Rating' => "4",
                'TicketPrice' => 700,
                'Country' => "Pakistan",
                'Genre' => "Action",
                "Slug" => Str::slug("Film 3"),
                "Photo" => "sc_1673371325.png"
            ],
        ];

        foreach ($films as $filmData) {
            $film = Films::create($filmData);

            Comment::create([
                'FilmId' => $film->id,
                'Comment' => 'This is a comment for ' . $film->title,
                'UserId' => 1,
                'Name' => "saim"
            ]);
        }
    }
}
