<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryProduct;
use Illuminate\Http\Request;

class InventoryProductController extends Controller
{
    private $inventory;

    public function __construct(InventoryProduct $inventory){
        $this->inventory = $inventory;
    }

    public function index(){
        try{
            $inventory = $this->inventory->all();

            if(count($inventory) == 0){
                return response()->json(['message' => 'No inventory found'], 404);
            }else{
                return response()->json($inventory, 200);
            }
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($id){
        try{
            $inventory = $this->inventory->find($id);
            if(!$inventory){
                return response()->json(['message' => 'Inventory not found'], 404);
            }else{
                return response()->json($inventory, 200);
            }
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request){
        try{
            $this->inventory->create($request->all());
            return response()->json(['message' => 'Inventory created'], 201);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update($id, Request $request){
        try{
            $this->inventory->find($id)->update($request->all());
            return response()->json(['message' => 'Inventory updated'], 200);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id){
        try{
            $this->inventory->find($id)->delete();
            return response()->json(['message' => 'Inventory deleted'], 200);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
