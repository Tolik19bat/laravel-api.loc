<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::with('category')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        return new Postresource(Post::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        
        // Обновление полей категории без валидации  
        $post->update($request->all());

        // Возвращаем ответ (например, JSON ответ)  
        response()->json(['message' => 'Категория успешно обновлена.', 'category' => $post], 200);

        return new PostResource($post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
         // Удаляем категорию из базы данных  
         $post->delete();

         // Возвращаем ответ (например, редирект или JSON ответ)  
         return response()->json(['message' => 'Категория успешно удалена.'], 200);
    
    }
}
