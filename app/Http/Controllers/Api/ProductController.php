<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;


class ProductController extends Controller
{
    private $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        try {
            $product = $this->products->with(['colors','sizes','photos'])->get();

            if (count($product) == 0) {
                return response()->json(['message' => 'No products found'], 404);
            } else {
                return response()->json($product, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($slug)
    {
        try {
            $product = $this->products->where('slug', $slug)->with(['colors','sizes','photos'])->first();

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            } else {
                return response()->json($product, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $images = $request->file('photos');

            $product = $this->products->create([
                "name"          => $data['name'],
                "description"   => $data['description'],
                "price"         => $data['price'],
                "slug"          => Str::of(time() . " " . $data['name'])->slug('-')
            ]);

            if(isset($data['colors']) && count($data['colors']) > 0){
                $product->colors()->sync($data['colors']);
            }

            if(isset($data['sizes']) && count($data['sizes']) > 0){
                $product->sizes()->sync($data['sizes']);
            }

            $baseLocation = 'product';
            foreach ($images as $image) {
                $photoPath = $image->store($baseLocation, 's3');
                $product->photos()->create([
                    'path' => $photoPath,
                    'name' => $image->getClientOriginalName()
                ]);
            }

            return response()->json(['message' => 'Product created'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update($slug, Request $request)
    {
        try {
            $data = $request->all();
            $product = $this->products->where('slug', $slug)->first();
            $product->update([
                "name"          => $data['name'],
                "description"   => $data['description'],
                "price"         => $data['price']
            ]);

            if(isset($data['colors']) && count($data['colors']) > 0){
                $product->colors()->sync($data['colors']);
            }

            if(isset($data['sizes']) && count($data['sizes']) > 0){
                $product->sizes()->sync($data['sizes']);
            }

            return response()->json(['message' => 'Product updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($slug)
    {
        try {
            $product = $this->products->where('slug', $slug)->first();
            $product->delete();
            return response()->json(['message' => 'Product deleted'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
