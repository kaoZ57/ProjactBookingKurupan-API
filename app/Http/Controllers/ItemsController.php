<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;

class ItemsController extends Controller
{
    //GET
    public function getItems()
    {
        $item_id = items::all();

        if ($item_id) {
            return response()->json([
                'message' => 'view Booking For you Success !',
                'item' => $item_id
            ], 200);
        } else {
            return response()->json(['message' => 'Booking not found !'], 404);
        }
    }

    public function getItemsID($id)
    {

        $item_id = items::find($id);

        if ($item_id) {
            return response()->json([
                'message' => 'view Booking For you Success !',
                'item' => $item_id
            ], 200);
        } else {
            return response()->json(['message' => 'Booking not found !'], 404);
        }
    }

    //POST
    public function postItems(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'item_type_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'is_active' => 'required|integer',
        ]);

        $item = items::create([
            'name' => $request['name'],
            'item_type_id' => $request['item_type_id'],
            'description' => $request['description'],
            'is_active' => $request['is_active'],
        ]);

        return response()->json([
            'item' => $item,
        ], 200);
    }


    //UPDATE
    public function updateItems(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'item_type_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'is_active' => 'required|integer',
        ]);

        $id = $request['id'];

        $setitem = items::find($id);

        $setitem->update($request->all());

        return response()->json([
            'data' => $setitem,
        ]);
    }

    //DALETE
    public function deleteItems($request)
    {

        $item_id = items::find($request);
        $item_id->delete();
    }
}
