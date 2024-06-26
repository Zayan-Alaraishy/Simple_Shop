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
        $user = Auth::user();
        $validatedData["user_id"] = $user->id;
        $Rating = $this->ratingService->createRating($validatedData);
        return back()->with('status', 'Thanks for the review!');

    }


    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $validatedData = $request->validated();
        $user = Auth::user();

        if (!$user->can('update', $rating)) {
            return back()->with('status', 'You are not authorized to update this rating.');
        }

        $ratingId = $rating->id;
        $rating = $this->ratingService->updateRating($ratingId, $validatedData);
        return response()->json($rating);

    }


    public function destroy(Rating $rating)
    {
        $user = Auth::user();

        if (!$user->can('destroy', $rating)) {
            return back()->with('status', 'You are not authorized to delete this rating.');
        }

        $ratingId = $rating->id;
        $this->ratingService->deleteRating($ratingId);

        return response()->json(null, 204);
    }


}