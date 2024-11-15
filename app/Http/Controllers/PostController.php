<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Posts; 
use App\Models\Category; 


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = Posts::with('user')->with('category')->get();
            
            return response()->json(['success' => true,'data' => $posts]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al traer los posts',
                'error' => $e->getMessage()
            ], 500);
        }
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function listCategory($categoryId)
    {
        try {
            $category = Category::find($categoryId);
            if(empty($category))
            return response()->json(['success' => false, 'message' => 'No existe la categoria'], 500);

            $posts = $category->posts;

            return response()->json(['success' => true,'data' => $posts]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al traer los posts',
                'error' => $e->getMessage()
            ], 500);
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'categoryid' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        try {

            $post = Posts::create([
                'title' => $request->title,
                'content' => $request->content,
                'categoryid' => $request->categoryid,
                'userid' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'data' => $post
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el Post.',
                'error' => $e->getMessage()
            ], 500);
        }
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
