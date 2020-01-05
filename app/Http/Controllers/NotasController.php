<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotasController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $user = User::all()->find($user_id);
        $notas = $user->notas;
        return view('notas', [
            'notas' => $notas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nota = new Nota;
        $nota->fill($request->all());
        $nota->user_id = Auth::id();        
        $nota->save();
        return redirect()->route('notas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = Nota::findOrFail($id);
        return view('viewnota', ['nota' => $nota]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nota = Nota::findOrFail($id);        
        if ($nota->user_id == Auth::id()){
            $nota->fill($request->all());
            $nota->save();
            return redirect()->route('notas.show', $id);
        } else abort('403');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nota = Nota::find($id);
        if ($nota->user_id == Auth::id()) {
            $nota->delete();
            return redirect()->route('notas.index');
        } else abort('403');        
    }
}
