<?php

namespace App\Http\Controllers;

use App\Http\Requests\TitlesRequest;
use App\Models\ReviewService;
use App\Models\Title;
use App\Models\User;
use App\Services\ImdbService;
use App\Services\MetacriticService;
use App\Services\RottenTomatoesService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class TitleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $titles = Title::orderBy('rate_value', 'DESC')->orderBy('rate_count', 'DESC')->paginate();

        $total_users = User::count();
        $total_titles = Title::count();
        $min_rate = Title::min('rate_value');
        $max_rate = Title::max('rate_value');

        return view("dashboard", compact('titles', 'total_users', 'total_titles', 'min_rate', 'max_rate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $reviewServices = ReviewService::all();
        return view("titles.create", compact('reviewServices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TitlesRequest $request
     * @return RedirectResponse
     */
    public function store(TitlesRequest $request)
    {
        $imdb_url = $request->imdb_url;
        $rottent_tomatoes_url = $request->service[1];
        $metacritic_url = $request->service[2];

        $imdb_service = new ImdbService($imdb_url);
        $imdb_data = $imdb_service->fetch();
        $title = Title::updateOrCreate(
            ["imdb_url" => $imdb_url],
            [
                "name" => $imdb_data['title'],
                "rate_value" => $imdb_data['rating']['value'],
                "rate_count" => $imdb_data['rating']['count'],
                "year_start" => $imdb_data['years']['start'],
                "year_end" => $imdb_data['years']['end'],
                "genres" => $imdb_data['genres'],
                "poster" => $imdb_data['poster']
            ]
        );

        $rotten_tomatoes_service = new RottenTomatoesService($rottent_tomatoes_url);
        $rotten_tomatoes_data = $rotten_tomatoes_service->fetch();

        $metacritic_service = new MetacriticService($metacritic_url);
        $metacritic_data = $metacritic_service->fetch();

        $title->reviewServices()->sync([
            1 => [
                'url' => $metacritic_url,
                'score' => $rotten_tomatoes_data['score']
            ],
            2 => [
                'url' => $rottent_tomatoes_url,
                'score' => $metacritic_data['score'],
                'count' => $metacritic_data['reviews'],
            ]
        ]);

        $title->users()->syncWithoutDetaching(auth()->user());

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param Title $title
     * @return Application|Factory|View
     */
    public function show(Title $title)
    {
        return view('titles.show', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Title $title
     * @return Response
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Title $title
     * @return Response
     */
    public function update(Request $request, Title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Title $title
     * @return Response
     */
    public function destroy(Title $title)
    {
        //
    }
}
