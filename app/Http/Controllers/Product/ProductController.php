<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductBulkStoreRequest;
use App\Http\Requests\Product\ProductBulkUpdateRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repository\ProductRepositoryInterface;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->all();
        $collection = ProductCollection::make($products);

        return response()->json($collection, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->productRepository->create($request->all());

        return response()->json($product, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductBulkStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkStore(ProductBulkStoreRequest $request)
    {
        $products = $this->productRepository->bulkStore(
            $request->input('products')
        );

        $collection = ProductCollection::make($products);

        return response()->json($collection, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = $this->productRepository->findById($product->id);
        $resource = ProductResource::make($product);

        return response()->json($resource, 200);
    }

    /**
     * Display product history.
     *
     * @param string  $product
     * @return \Illuminate\Http\Response
     */
    public function history(string $id)
    {
        $history = $this->productRepository->history($id);

        return response()->json($history, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductUpdateRequest t  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product = $this->productRepository->update($product->id, $request->all());

        return response()->json($product, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductBulkUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdate(ProductBulkUpdateRequest $request)
    {
        $products = $this->productRepository->bulkUpdate(
            $request->input('products')
        );

        $collection = ProductCollection::make($products);

        return response()->json($collection, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productRepository->deleteById($product->id);

        return response()->json([], 204);
    }
}
