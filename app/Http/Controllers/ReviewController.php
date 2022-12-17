<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\UserNotLoggedIn;
use App\Exceptions\ReviewNotBelongsToUser;
use Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        // collection jer za 1 proizvod postoji vise reviews
        return ReviewResource::collection($product->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Product $product)
    {
        // $this->reviewUserCheck();
       
        $review = new Review();
       
        $review->star = $request->star;
        $review->review = $request->review;
        $review->product_id = $product->id;
        $review->user_id = Auth::id();
        $product->reviews()->save($review);

        return response([
            'data'=>new ReviewResource($review)
        ], Response::HTTP_CREATED);
    

    
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request,Product $product, Review $review)
    {

        $this->checkUser($review);

        $review->update($request->all());
        
        return response([
            'data'=>new ReviewResource($review)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {

        if(auth()->check()) {
        // if the review doesn't belong to user...
        if(auth()->user()->id!=$review->user_id)
        {
            throw new ReviewNotBelongsToUser;
        }
        $review->delete();
       

        return response([
            null
        ], Response::HTTP_NO_CONTENT);
    }
    throw new UserNotLoggedIn;
}

    public function reviewUserCheck() {
        $users = User::all();
        foreach($users as $user)
        {
            if(Auth::id() == $user->id)
            return true;
        }

        throw new UserNotLoggedIn;
    }


    public function checkUser(Review $review){
        if($review->user_id !=Auth::id())
        {
            throw new ReviewNotBelongsToUser;
        }

    }
   
}
