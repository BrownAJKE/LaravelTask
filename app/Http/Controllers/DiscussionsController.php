<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Notifications\ApprovedNotice;

class DiscussionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index', [

            'discussions' => Discussion::where('status', '=', true)->filterByChannels()->paginate(3)
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show', [
            'discussion' => $discussion
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function unapproved()
    {
        $discussions = Discussion::where('status', '=', false)->get();

        return view('discussions.unapproved', compact('discussions'));
    }

    public function approve(Discussion $discussion)
    {
       
        if($discussion->status == false)
        {
            //Approve disccussion
            $discussion->status = true;
            $discussion->save();
            //Notify user discussion approved
            $discussion->author->notify(new ApprovedNotice($discussion));

            return redirect()->back()->with('success', 'Notice approved successfully');
        }else
        {
            $discussion->status = false;
            $discussion->save();
            return redirect()->back()->with('success', 'Notice disapproved successfully');
        }
    }
}
