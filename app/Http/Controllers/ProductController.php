<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use function response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Product[]|Collection
     */
    public function index()
    {
        return Product::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();

        $file = $request->file("image");
        $file->storeAs('public/images', $imageName, 'local');

        $data = array_merge($request->all(), ["image" => $imageName]);

        return response()->json(Product::create($data));

    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();

        $file = $request->file("image");
        $file->storeAs('public/images', $imageName, 'local');

        $data = array_merge($request->all(), ["image" => $imageName]);
        $product->update($data);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return bool|null
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([]);
    }
}
