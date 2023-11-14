<?php

namespace App\Http\Controllers;

use App\Models\Boards;
use Illuminate\Http\Request;


class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            // 'boards' => Boards::where('user_id', Auth::id())->latest()->get(),
            'boards' => Boards::where('user_id', 1)->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'user_id' => 'required'
        ]);

        // $validateData['user_id'] = auth()->user()->id;

        $board = Boards::create($validateData);

        return response()->json([
            'board' => $board
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $board = Boards::find($id);

        if (!$board) {
            return response()->json([
                'message' => 'Board not found'
            ], 404);
        }
    
        return response()->json([
            'message' => 'Board updated successfully',
            'board' => $board
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $board = Boards::find($id);

        if (!$board) {
            return response()->json([
                'message' => 'Board not found'
            ], 404);
        }
        
    
        $board->nama = $request->nama;
        $board->save();
    
        return response()->json([
            'message' => 'Board updated successfully',
            'board' => $board
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $board = Boards::find($id);
        $board->delete();

        return response([
            'message' => 'Deleted succes.'
         ], 200);
    }
}
