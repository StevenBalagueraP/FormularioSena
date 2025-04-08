<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Help;
use Inertia\Inertia;

class HelpController extends Controller
{
    public function index()
    {
        $helps=Help::get();
        return Inertia::render('Help/Index', [
            'status' => session('status'),
            'helps' => $helps,
        
        
        ]);
    }
    public function create()
    {
        return Inertia::render('Help/Create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $help=Help::find($id);
        $help->update($request->all());
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $help=Help::find($id);
        $help->delete();
        
    }
}