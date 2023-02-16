<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(5);
  
        return view('blogs.index',compact('blogs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
  
        Blog::create($request->all());
   
        return redirect()->route('blogs.index')
                        ->with('success','Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
  
        $blog->update($request->all());
  
        return redirect()->route('blogs.index')
                        ->with('success','Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
  
        return redirect()->route('blogs.index')
                        ->with('success','Blogs deleted successfully');
    }
}
