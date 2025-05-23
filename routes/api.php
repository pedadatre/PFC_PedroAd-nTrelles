<?php   
use App\Http\Controllers\Api\RecipeApiController;

Route::get('/recipes/{recipe}', [RecipeApiController::class, 'show'])
     ->name('api.recipes.show');
