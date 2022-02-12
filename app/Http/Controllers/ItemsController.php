<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    //GET
    public function get()
    {
        $itemdata = DB::table('items')
            ->select('items.*', 'items_types.name as typename')
            ->join('items_types', 'items.item_type_id', '=', 'items_types.id')
            ->get();

        if ($itemdata) {
            return response()->json([
                'message' => 'view items For you Success !',
                'item' => $itemdata
            ], 200);
        } else {
            return response()->json(['message' => 'items not found !'], 404);
        }
    }

    //GET_ID
    public function getID($id)
    {
        $itemdata = DB::table('items')
            ->select('items.*', 'items_types.name as typename')
            ->join('items_types', 'items.item_type_id', '=', 'items_types.id')
            ->where('items.id', '=', $id)
            ->get();

        if ($itemdata) {
            return response()->json([
                'message' => 'view items For you Success !',
                'item' => $itemdata
            ], 200);
        } else {
            return response()->json(['message' => 'items not found !'], 404);
        }
    }

    //POST
    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'item_type_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'is_active' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $item = items::create([
            'name' => $request['name'],
            'item_type_id' => $request['item_type_id'],
            'description' => $request['description'],
            'is_active' => $request['is_active'],
            'quantity' => $request['quantity'],
        ]);

        return response()->json([
            'item' => $item,
        ], 200);

        if ($item) {
            return response()->json([
                'message' => 'post Success !',
                'item' => $item,
            ], 200);
        } else {
            return response()->json(['message' => 'post not found !'], 404);
        }
    }


    //UPDATE
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'item_type_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'is_active' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $id = $request['id'];

        $setitem = items::find($id);

        $setitem->update($request->all());

        return response()->json([
            'data' => $setitem,
        ]);

        if ($setitem) {
            return response()->json([
                'message' => 'update Success !',
                'data' => $setitem,
            ], 200);
        } else {
            return response()->json(['message' => 'update not found !'], 404);
        }
    }

    //DALETE
    public function delete($id)
    {
        $item_id = items::find($id);
        $item_id->delete();

        if ($item_id) {
            return response()->json([
                'message' => 'delete Success !',
            ], 200);
        } else {
            return response()->json(['message' => 'delete not found !'], 404);
        }
    }
}
