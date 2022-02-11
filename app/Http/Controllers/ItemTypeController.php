<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items_type;

class ItemTypeController extends Controller
{
    //GET
    public function get()
    {
        $item_id = items_type::all();

        if ($item_id) {
            return response()->json([
                'message' => 'view ItemType For you Success !',
                'item' => $item_id
            ], 200);
        } else {
            return response()->json(['message' => 'ItemType not found !'], 404);
        }
    }

    //GET_ID
    public function getID($id)
    {

        $item_id = items_type::find($id);

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
        ]);

        $item = items_type::create([
            'name' => $request['name'],
        ]);

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

        ]);

        $id = $request['id'];

        $setitem = items_type::find($id);

        $setitem->update($request->all());

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
        $item_id = items_type::find($id);
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
