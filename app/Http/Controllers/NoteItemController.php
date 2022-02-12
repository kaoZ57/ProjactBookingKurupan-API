<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\note_item;
use Illuminate\Support\Facades\DB;

class NoteItemController extends Controller
{
    public function get()
    {
        // $note_item = note_item::all();
        $note_item = DB::table('note_item')
            ->select('note_item.*', 'items.name', 'items.item_type_id')
            ->join('items', 'note_item.item_id', '=', 'items.id')
            ->get();

        if ($note_item) {
            return response()->json([
                'message' => 'view Noteitems For you Success !',
                'note_item' => $note_item,
            ], 200);
        } else {
            return response()->json(['message' => 'Noteitems not found !'], 404);
        }
    }

    //GET_ID
    public function getID($id)
    {

        $note_item = DB::table('note_item')
            ->select('note_item.*', 'items.name', 'items.item_type_id')
            ->join('items', 'note_item.item_id', '=', 'items.id')
            ->where('note_item.id', '=', $id)
            ->get();

        if ($note_item) {
            return response()->json([
                'message' => 'view Noteitems For you Success !',
                'note_item' => $note_item,
            ], 200);
        } else {
            return response()->json(['message' => 'Noteitems not found !'], 404);
        }
    }

    //POST
    public function post(Request $request)
    {
        $request->validate([
            'note' => 'required|string|max:100',
            'item_id' => 'required|integer',
        ]);

        $item = note_item::create([
            'note' => $request['note'],
            'item_id' => $request['item_id'],
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
            'note' => 'required|string|max:255',
            'item_id' => 'required|integer',
        ]);

        $id = $request['id'];

        $setitem = note_item::find($id);

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
        $item = note_item::find($id);
        $item->delete();

        if ($item) {
            return response()->json([
                'message' => 'delete Success !',
            ], 200);
        } else {
            return response()->json(['message' => 'delete not found !'], 404);
        }
    }
}
