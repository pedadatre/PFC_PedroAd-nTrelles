<div x-data="{ showCreate: false }"
     @open-create-modal.window="showCreate = true"
     x-show="showCreate" 
     x-cloak
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 overflow-hidden">
        <div class="bg-gray-100 px-6 py-4 border-b">
            <h2 class="text-2xl font-bold">Crear Nueva Receta</h2>
        </div>
        
        <form action="{{ route('recipes.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea name="description" required rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ingredientes</label>
                    <textarea name="ingredients" required rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            placeholder="Un ingrediente por línea"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Instrucciones</label>
                    <textarea name="instructions" required rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            placeholder="Escribe los pasos..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">URL de la imagen</label>
                    <input type="url" name="image_url"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                           placeholder="https://...">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" @click="showCreate = false"
                        class="px-4 py-2 border rounded-md hover:bg-gray-100">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                    Crear Receta
                </button>
            </div>
        </form>
    </div>
</div>