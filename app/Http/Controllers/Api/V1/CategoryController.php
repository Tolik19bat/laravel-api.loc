<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        // Обновление полей категории без валидации  
        $category->title = $request->input('title');
        // Добавьте здесь обновление других полей, если необходимо  

        // Сохраняем изменения в базе данных  
        $category->save();

        // Возвращаем ответ (например, JSON ответ)  
        response()->json(['message' => 'Категория успешно обновлена.', 'category' => $category], 200);
        return  new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Удаляем категорию из базы данных  
        $category->delete();

        // Возвращаем ответ (например, редирект или JSON ответ)  
        return response()->json(['message' => 'Категория успешно удалена.'], 200);
    }
}
