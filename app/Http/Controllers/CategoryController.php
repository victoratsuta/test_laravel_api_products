<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Category::get()->toTree();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Category
     */
    public function store(Request $request)
    {
        $parent = Category::find($request->get('parent_id'));
        $node = new Category(
            [
                'name' => $request->get('name')
            ]
        );

        $parent->appendNode($node);
        $node->refresh();

        return $node;
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Category
     */
    public function show(Category $category)
    {
        return $category;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Category
     */
    public function update(Request $request, Category $category)
    {
        $parent = Category::find($request->get('parent_id'));

        $parent->appendNode($category);
        $category->update([
            'name' => $request->get('name')
        ]);

        $category->refresh();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([]);
    }
}
