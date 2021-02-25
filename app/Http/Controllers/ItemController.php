<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();
        return $items;
    }

    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item["name"];
        $newItem->save();

        return $newItem;
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;
        }

        return "Item not found";
    }

    public function destroy($id)
    {
        $existingItem = Item::find($id);

        if ($existingItem) {
            $existingItem->delete();
            return "Item successfully deleted.";
        }

        return "Item not found";
    }
}
