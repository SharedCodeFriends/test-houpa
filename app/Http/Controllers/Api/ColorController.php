<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Colors;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    private $colors;

    public function __construct(Colors $colors){
        $this->colors = $colors;
    }

    public function index(){
        try{
            $colors = $this->colors->all();

            if(count($colors) == 0){
                return response()->json(['error' => 'No colors found'], 404);
            }else{
                return response()->json($colors,200);
            }
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id){
        try{
            $color = $this->colors->find($id);
            if(!$color){
                return response()->json(['error' => 'Color not found'], 404);
            }else{
                return response()->json($color,200);
            }
        }catch(\Exception $e){
            return
            response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request){
        try{
            $this->colors->create($request->all());
            return response()->json(['message' => 'Color created'], 201);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update($id, Request $request){
        try{
            $this->colors->find($id)->update($request->all());
            return response()->json(['message' => 'Color updated'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id){
        try{
            $this->colors->find($id)->delete();
            return response()->json(['message' => 'Color deleted'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
