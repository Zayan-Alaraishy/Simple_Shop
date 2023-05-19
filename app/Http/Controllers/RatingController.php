<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Rating;
use App\Services\RatingService;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    private $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }


    public function store(StoreRatingRequest $request)
    {

        $validatedData = $request->validated();
        $userId = Auth::user()->id;
        $Rating = $this->ratingService->createRating($validatedData, $userId);
        return response()->json($Rating, 201);

    }


    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validatedData = $request->validated();
        $currentUser = Auth::user()->id;
        $ratingId = Auth::user()->id;
        $rating = $this->ratingService->updateRating($ratingId, $validatedData, $currentUser);
        return response()->json($rating);

    }


    public function destroy(Rating $rating)
    {
        $ratingId = $rating["id"];
        $currentUser = Auth::user()->id;
        $this->ratingService->deleteRating($ratingId, $currentUser);

        return response()->json(null, 204);
    }


}