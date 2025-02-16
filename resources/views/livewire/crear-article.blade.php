<div>
    <x-button class="font-bold" wire:click="$set('openCrear', true)"><i class="fas fa-add mr-2"></i>NUEVO</x-button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            CREAR ARTICLE
        </x-slot>
        <x-slot name="content">
            <!-- Título -->
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium text-gray-700 mb-2">Title</label>
                <input type="text" wire:model="cform.title"
                    id="title" name="title" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe el título del articulo">
                <x-input-error for="cform.title" />
            </div>

            <!-- Contenido -->
            <div class="mb-6">
                <label for="content" class="block text-lg font-medium text-gray-700 mb-2">Content</label>
                <textarea wire:model="cform.content"
                    id="content" name="content" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe el contenido del articulo"></textarea>
                <x-input-error for="cform.content" />
            </div>

            <!-- Tag -->
            <div class="mb-6">
                <label for="tag" class="block text-lg font-medium text-gray-700 mb-2">Tag</label>
                <select id="tag" wire:model="cform.tag_id" name="tag" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                  <option selected>Seleccionar tag</option>
                  @foreach($tags as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
                <x-input-error for="cform.tag_id" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <!-- Botón de Enviar -->
            <div class="flex flex-row-reverse justify-center">
                <button wire:click="store" wire:loading.attr="disabled" class="ml-2 p-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-paper-plane mr-2"></i> Publicar Article
                </button>
                <button wire:click="cancelar" class="p-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                    <i class="fas fa-xmark mr-2"></i> Cancelar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>