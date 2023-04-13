<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Policies\AdPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ads = Ad::latest()->get();
        return view("ads.index", compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = ['غسيل سيارات', "غسيل منازل", "غسيل سجادات"];
        return view('ads.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'category' => ['required'],
            'image_path' => ['required', 'image'],
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['image_path'] = request('image_path')->store('uploads', 'public');

        // return dd($data);
        Ad::create($data);


        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return view('ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        if ($ad == null) {
            abort(404);
        }
        $this->authorize('update', $ad);
        return view('ads.edit', compact(['ad']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {

        if ($ad == null) {
            abort(404);
        }
        $this->authorize('update', $ad);

        $data = request()->validate([

            'title' => 'string',
            'body' => ['required'],
            'category' => ['required'],
            'image_path' => 'image|nullable'
        ]);

        $imagePath = null;

        if (request('image_path') != null) {
            $imagePath = request('image_path')->store('uploads', 'public');
        } else if ($ad->image_path != null) {

            $imagePath = $ad->image_path;
        } else {
            abort(401);
        }

        $ad->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'category' => $data['category'],
            'image_path' => $imagePath,
        ]);

        // return redirect(auth()->user()->username);
        return redirect("/ads/" . $ad->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        if ($ad == null) {
            abort(404);
        }
        $this->authorize('delete', $ad);

        $ad->delete();
        Storage::delete("public/" . $ad->image_path);

        return redirect('/');
    }
}
