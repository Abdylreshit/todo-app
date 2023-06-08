<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tag;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TodoController extends Controller {


    public function index(Request $request)
    {
        $user = $request->user();

        $todos = $user->todos()
            ->with(['images', 'tags'])
            ->where('user_id', $user->id)
            ->when($request->filled('q'), function ($query) use ($request){
                return $query->where('title', 'LIKE', "%{$request->q}%")
                    ->orWhere('description', 'LIKE', "%{$request->q}%");
            })
            ->when($request->filled('tags'), function ($query) use ($request){
                return $query->whereHas('tags', fn($q)=>$q->whereIn('id', $request->tags));
            })
            ->paginate(10)
            ->appends(request()->query());

        $tags = $user->tags()->get();

        return view('home')->with(compact('todos', 'tags'));
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        $todo = $user->todos()->create($data);

        $view = view('action', compact('todo'))->render();

        return $view;
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $todo = $user->todos()->findOrFail($request->todo_id);

        $todo->update($request->all());

        $view = view('action', compact('todo'))->render();

        return $view;
    }

    public function delete(Request $request)
    {
        $user = $request->user();

        $todo = $user->todos()->findOrFail($request->todo_id);

        foreach ($todo->images as $image) {
            Storage::disk('public')->delete(Str::replace('storage', '', $image->path));
        }

        $todo->delete();

        return redirect()->route('todo.index')->with(['success' => 'deleted']);
    }

    public function attachImages(Request $request)
    {
        $user = $request->user();

        $todo = $user->todos()->findOrFail($request->todo_id);

        if($request->hasfile('images')){
            foreach($request->file('images') as $file){
                $fileName   = time() . $file->getClientOriginalName();
                Storage::disk('public')->put('images/' . $fileName, File::get($file));

                $todo->images()->create([
                    'path' => "storage/images/{$fileName}"
                ]);
            }
        }

        return redirect()->back()->with(['success' => 'attached']);
    }

    public function showImage(Request $request)
    {
        $user = $request->user();

        $image = $user->images()->with('todo')->findOrFail($request->image_id);

        return view('image', compact('image'));
    }

    public function updateImage(Request $request)
    {
        $user = $request->user();

        $image = $user->images()->findOrFail($request->image_id);

        $file = $request->file('image');
        $fileName   = time() . $file->getClientOriginalName();
        Storage::disk('public')->delete(Str::replace('storage', '', $image->path));
        Storage::disk('public')->put('images/' . $fileName, File::get($file));

        $image->update([
            'path' => "storage/images/{$fileName}"
        ]);

        return redirect()->back()->with(['success' => 'updated']);
    }

    public function deleteImage(Request $request)
    {
        $user = $request->user();

        $image = $user->images()->findOrFail($request->image_id);

        Storage::disk('public')->delete(Str::replace('storage', '', $image->path));

        $image->delete();

        return redirect()->route('todo.index')->with(['success' => 'deleted']);
    }

    public function attachTag(Request $request)
    {
        $user = $request->user();

        $todo = $user->todos()->findOrFail($request->todo_id);

        $tag = $user->tags()->create([
            'name' => $request->name
        ]);

        $todo->tags()->attach($tag);

        return redirect()->back()->with(['success' => 'attached']);
    }

}
