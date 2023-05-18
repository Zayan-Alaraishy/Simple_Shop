<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        $validatedData = $request->validated();
        // Create or update the rating record
        $rating = Rating::create(
            [
                'product_id' => $validatedData['product_id'],
                'user_id' => Auth::user()->id,
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment']
            ],
        );

        // TOOD:Redirect back or show a success message
        // return redirect('/products'); //->back()->with('success', 'Rating submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}