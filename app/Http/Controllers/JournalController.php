<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Group $group)
    {


//        return view('journals.show', compact('group'));
//        echo 'JournalC';
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $subjects = Subject::all();


        dump(average($subjects->find(1)->users->where('group_id', $group->id))) ;
        dd($subjects->find(1)->users()->where('group_id', $group->id));

//        dd($subjects->find(1)->users()->where('group_id', $group->id)->avg('grade'));
        dd($subjects->find(1)->users()->where('group_id', $group->id)->avg('grade'));

        return view('journals.show', compact('group', 'subjects'));
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
        //
    }
}
