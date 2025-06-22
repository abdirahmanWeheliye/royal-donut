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
            'name' => 'required|string',
            'seal_of_approval' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        $id = DB::table('donuts')->insertGetId([
            'name' => $request->name,
            'seal_of_approval' => $request->seal_of_approval,
            'price' => $request->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(DB::table('donuts')->where('id', $id)->first(), 201);
    }

    public function destroy($id)
    {
        DB::table('donuts')->where('id', $id)->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
