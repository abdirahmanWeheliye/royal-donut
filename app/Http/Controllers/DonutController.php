<?php

namespace App\Http\Controllers;

use App\Models\Donut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonutController extends Controller
{
    public function index()
    {
        return response()->json(Donut::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'seal_of_approval' => 'required|integer|min:1|max:5',
            'price' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('donut-images', 'public');
        }

        $donut = Donut::create([
            'name' => $request->name,
            'seal_of_approval' => $request->seal_of_approval,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return response()->json($donut, 201);
    }

    public function destroy($id)
    {
        DB::table('donuts')->where('id', $id)->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
