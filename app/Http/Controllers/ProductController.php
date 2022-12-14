<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ProductNotBelongsToUser;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{


        public function __construct()
        {
            // trazi autentikaciju za sve osim index i show stranicu
            $this->middleware('auth:api')->except('index', 'show');
        }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return ProductCollection::collection(Product::paginate(10));
        
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->detail=$request->description;
        $product->price = $request->price;
        $product->stock=$request->stock;
        $product->category_id=$request->category_id;
        $product->discount=$request->discount;
        // $product->user_id=$request->user_id;
        $product->user_id= Auth::id();

        $product->save();

        // 201 code --> created

        return response([
            'data'=>new ProductResource($product), Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {


        $this->productUserCheck($product);


        $request['detail'] = $request->description;
        unset($request['description']);
        $product->update($request->all());

        return response([
            'data'=>new ProductResource($product), Response::HTTP_CREATED
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productUserCheck($product);
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function productUserCheck(Product $product)
    {
        if(Auth::id()!=$product->user_id)
        {
            throw new ProductNotBelongsToUser;
        }
    }
}
