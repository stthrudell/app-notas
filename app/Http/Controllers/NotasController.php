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
        $nota = Nota::find($id);
        if ($nota == null) {
            abort(404);
        }
        $user = $nota->user;
        
        $user_logged = Auth::id();
        $isPublic = '';
        $isPrivate = '';

        if($nota->is_public == 1) {
            $isPublic = 'selected';
        } else {
            $isPrivate = 'selected';
        }

        return view('viewnota', [
            'nota' => $nota,
            'user' => $user,
            'user_logged' => $user_logged,
            'isPublic' => $isPublic,
            'isPrivate' => $isPrivate
        ]);
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
        $nota = Nota::find($id);        
        $nota->title = $request->title;
        $nota->text = $request->text;
        $nota->is_public = $request->is_public;
        $nota->save();

        return redirect()->route('notas.show', $id);
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
        $nota->delete();
        return redirect()->route('notas.index');
    }
}
