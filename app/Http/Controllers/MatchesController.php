<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatchesRequest;
use App\Matches;

class MatchesController extends Controller
{
    public function index()
    {
        $matches = Matches::latest()->get();

        return response()->json($matches);
    }

    public function store(MatchesRequest $request)
    {
        $matches = Matches::create($request->all());

        return response()->json($matches, 201);
    }

    public function show($id)
    {
        $matches = Matches::findOrFail($id);

        return response()->json($matches);
    }

    public function update(MatchesRequest $request, $id)
    {
        $matches = Matches::findOrFail($id);
        $matches->update($request->all());

        return response()->json($matches, 200);
    }

    public function destroy($id)
    {
        Matches::destroy($id);

        return response()->json(null, 204);
    }
}
