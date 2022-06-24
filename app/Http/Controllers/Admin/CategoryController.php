<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();

        return view('admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = new Category();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // dd($file);
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/images/category', $filename);
            $category->image = $filename;
        };

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == True ? '1' : '0';
        $category->popular = $request->input('popular') == True ? '1' : '0';
        $category->save();

        // $category = Category::create([
        //     'name' => $request->input('name'),
        //     'slug' => $request->input('slug'),
        //     'description' => $request->input('description'),
        //     'status' => $request->input('status') == True ? '1' : '0',
        //     'popular' => $request->input('popular') == True ? '1' : '0'
        // ]);

        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit')->with('category', $category);
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
        $category = new Category();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/images/category', $filename);
            $category->image = $filename;
        };

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == True ? '1' : '0';
        $category->popular = $request->input('popular') == True ? '1' : '0';
        $category->update();

        // $category = Category::where('id', $id)->update([
        //     'name' => $request->input('name'),
        //     'slug' => $request->input('slug'),
        //     'description' => $request->input('description'),
        //     'status' => $request->input('status') == True ? '1' : '0',
        //     'popular' => $request->input('popular') == True ? '1' : '0'
        // ]);

        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/categories');
    }
}
