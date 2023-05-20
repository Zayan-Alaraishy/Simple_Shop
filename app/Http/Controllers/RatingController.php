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
        $loggedInUser = Auth::user();

        if (!$loggedInUser) {
            return back()->with('status', 'You are not authorized to create rating. Please log in.');
        }

        $validatedData["user_id"] = $loggedInUser->id;
        $Rating = $this->ratingService->createRating($validatedData);
        return back()->with('status', 'Thanks for the review!');

    }


    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validatedData = $request->validated();
        $loggedInUser = Auth::user();

        if (!$loggedInUser) {
            return back()->with('status', 'You are not authorized to update this rating. Please log in.');
        }
        
        if ($loggedInUser->id != $rating->user_id) {
            return back()->with('status', 'You are not authorized to update this rating.');
        }

        $ratingId = $rating->id;
        $rating = $this->ratingService->updateRating($ratingId, $validatedData);
        return response()->json($rating);

    }


    public function destroy(Rating $rating)
    {
        dd($rating);
        $loggedInUser = Auth::user();

        if (!$loggedInUser) {
            return back()->with('status', 'You are not authorized to delete this rating. Please log in.');
        }
        
        if ($loggedInUser->id != $rating->user_id) {
            return back()->with('status', 'You are not authorized to delete this rating.');
        }

        $ratingId = $rating->id;
        $this->ratingService->deleteRating($ratingId);

        return response()->json(null, 204);
    }


}