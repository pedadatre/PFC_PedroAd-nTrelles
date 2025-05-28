<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Recipe;

class RecipeApiController extends Controller
{
    public function show(Recipe $recipe)
    {
        $recipe->load(['user:id,name','comments.user:id,name','likes']);
        return response()->json([
          'id'           => $recipe->id,
          'title'        => $recipe->title,
          'description'  => $recipe->description,
          'ingredients'  => $recipe->ingredients,
          'instructions' => $recipe->instructions,
          'image_url'    => $recipe->image_url,
          'user'         => $recipe->user,
          'likes_count'  => $recipe->likes->count(),
          'comments'     => $recipe->comments->map(fn($c)=>[
            'id'=>$c->id,'content'=>$c->content,
            'user'=>['id'=>$c->user->id,'name'=>$c->user->name]
          ]),
        ]);
    }
}
