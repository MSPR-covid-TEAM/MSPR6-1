<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StatsPandemie;
use Illuminate\Http\Request;

class StatsPandemieController extends Controller
{
    public function index(Request $request)
    {
        $stats = StatsPandemie::all();

        // if ($request->has('fields')) {
        //     $fields = explode(',', $request->input('fields'));
        //     $stats = StatsPandemie::all($fields);
        // }

        return response()->json($stats);
    }

    // Lire un post par son ID
    public function show($id)
    {
        $stat = StatsPandemie::findOrFail($id);
        return response()->json($stat);
    }

    // Ajouter un nouveau post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $stat = StatsPandemie::create($request->all());
        return response()->json($stat, 201);
    }

    // Mettre à jour un post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
        ]);

        $stat = StatsPandemie::findOrFail($id);
        $stat->update($request->all());

        return response()->json($stat);
    }

    // Supprimer un post
    public function destroy($id)
    {
        $stat = StatsPandemie::findOrFail($id);
        $stat->delete();

        return response()->json(null, 204);
    }
}
