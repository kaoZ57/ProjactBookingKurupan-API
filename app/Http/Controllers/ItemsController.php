<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;
use App\Models\items_type;

class ItemsController extends Controller
{
    //GET
    public function get()
    {
        $item = items::all();
        // $items_type = items_type::all();
        // $data = items::with('items_type')->where('item_type_id', '=', 2)->latest('id')->get();
        //$data = items::with('items_type')->latest('id')->get();

        if ($item) {
            return response()->json([
                'message' => 'view items For you Success !',
                'item' => $item,
                // 'items_type' => $items_type
            ], 200);
        } else {
            return response()->json(['message' => 'items not found !'], 404);
        }
    }

    //GET_ID
    public function getID($id)
    {
        $item_id = items::find($id);

        if ($item_id) {
            return response()->json([
                'message' => 'view items For you Success !',
                'item' => $item_id
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
