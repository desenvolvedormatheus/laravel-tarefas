<?php

namespace App\Http\Controllers;

use App\Models\tarefas;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarefas = Tarefas::orderBy('created_at', 'desc')->paginate(5);

        return view("tarefas", ["tarefas" => $tarefas]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        tarefas::create(['name' => $request->name, 'description' => $request->description]);

        return redirect()->route('tarefas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update(Request $request)
    {
        $tarefa = tarefas::find($request->id);
        $tarefa->done = $request->done;
        $tarefa->save();

        return redirect()->route('tarefas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        tarefas::destroy([$request->id]);

        return redirect()->route('tarefas.index');
    }
}
