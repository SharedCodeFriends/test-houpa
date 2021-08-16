<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sizes;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    private $sizes;

    public function __construct(Sizes $sizes)
    {
        $this->sizes = $sizes;
    }

    public function index()
    {
        try {
            $sizes = $this->sizes->all();
            if (count($sizes) == 0) {
                return response()->json(['message' => 'No sizes found'], 404);
            } else {
                return response()->json($sizes, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($id){
        try {
            $size = $this->sizes->find($id);
            if(!$size){
                return response()->json(['message' => 'Size not found'], 404);
            }else{
                return response()->json($size, 200);
            }
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request){
        try {
            $this->sizes->create($request->all());
            return response()->json(['message' => 'Size created'], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update($id, Request $request){
        try {
            $this->sizes->find($id)->update($request->all());
            return response()->json(['message' => 'Size updated'], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id){
        try {
            $this->sizes->find($id)->delete();
            return response()->json(['message' => 'Size deleted'], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
