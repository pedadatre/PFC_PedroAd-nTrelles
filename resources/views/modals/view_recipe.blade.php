<div
  x-data="{ recipe: null, showView: false, likes: 0 }"
  @open-view-modal.window="({ detail }) => {
    fetch(`/api/recipes/${detail.id}`)
      .then(res => res.json())
      .then(data => {
        recipe = data;
        likes = data.likes_count;
      });
    showView = true;
  }"
  @recipe-liked.window="detail => {
    if (recipe && detail.id === recipe.id) likes = detail.likes_count;
  }"
  x-show="showView"
  @keydown.escape.window="showView = false"
  x-cloak
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
>
  <div class="bg-white p-6 rounded shadow-lg w-1/2 max-h-screen overflow-auto">
    <template x-if="recipe">
      <div>
        <h2 class="text-2xl mb-2" x-text="recipe.title"></h2>
        <p class="mb-1">
          By <a :href="`/profile/${recipe.user.id}`" x-text="recipe.user.name"></a>
        </p>
        <img :src="recipe.image_url" class="mb-4">
        <h3>Ingredients</h3>
        <p x-text="recipe.ingredients"></p>
        <h3>Instructions</h3>
        <p x-text="recipe.instructions"></p>
        <div class="mt-4 flex items-start space-x-4">
          <!-- Aquí usamos la variable `likes` en lugar de recipe.likes_count -->
          <button @click="likeRecipe(recipe.id)">
            Like (<span x-text="likes"></span>)
          </button>
          <div class="flex-1">
            <h4>Comments</h4>
            <template x-for="c in recipe.comments" :key="c.id">
              <div class="border p-2 mb-1">
                <p>
                  <strong x-text="c.user.name"></strong>:
                  <span x-text="c.content"></span>
                </p>
              </div>
            </template>
          </div>
        </div>
      </div>
    </template>
    <div class="flex justify-end mt-4">
      <button @click="showView = false" class="btn-secondary">Close</button>
    </div>
  </div>
</div>
