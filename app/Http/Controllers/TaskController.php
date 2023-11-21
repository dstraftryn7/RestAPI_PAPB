<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $taskData = Tasks::all();
            return response()->json([
                'status code' => 200,
                'message' => 'berhasil mengambil task',
                'task' =>  $taskData,

            ], 200);

        } catch(ValidationException $e) {
            return response()->json([
                'status code' => 422,
                'message' => 'gagal mengambil anggota',
                'errors' => $e->errors(),
            ], 422);

        } catch(Exception $e){
            return response()->json([
                'status code' => 500,
                'message' => 'ada kesalahan!',
                'error' => $e
            ], 500);

        }
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
        try {
            $validateData = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
                'datetime' => 'required',
                'boards_id' => 'required',
                'user_id' => 'required'
            ]);

            $task = new Tasks;
            $task->title = $validateData['title'];
            $task->description = $validateData['description'];
            $task->status = $validateData['status'];
            $task->datetime = $validateData['datetime'];
            $task->boards_id = $validateData['boards_id'];
            $task->user_id = $validateData['user_id'];
            $task->save();


            $taskData = Tasks::where('boards_id', $validateData['boards_id'])->get();

            return response()->json([
                'status code' => 200,
                'message' => 'berhasil mengambil task',
                'task' =>  $taskData,

            ], 200);

        } catch(ValidationException $e){
            return response()->json([
                'status code' => 422,
                'message' => 'gagal mengambil anggota',
                'errors' => $e->errors(),
            ], 422);

        } catch(Exception $e){
            return response()->json([
                'status code' => 500,
                'message' => 'ada kesalahan!',
                'error' => $e
            ], 500);

        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Tasks::find($id);
        $task->delete();

        return response([
            'message' => 'Deleted succes.'
         ], 200);
    }


    public function getTodayTasks()
{
    $today = now()->format('Y-m-d');
    
    $tasks = Tasks::whereDate('due_date', $today)->get();

    return response()->json($tasks);
}

}
