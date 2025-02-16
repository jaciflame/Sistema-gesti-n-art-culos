<div>
    <x-button class="font-bold" wire:click="$set('openCrear', true)"><i class="fas fa-add mr-2"></i>NUEVO</x-button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            CREAR POST
        </x-slot>
        <x-slot name="content">
            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Name</label>
                <input type="text" wire:model="cform.name"
                    id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe el nombre del tag">
                <x-input-error for="cform.name" />
            </div>

            <!-- description -->
            <div class="mb-6">
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Description</label>
                <textarea wire:model="cform.description"
                    id="description" name="description" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe el descripcion del tag"></textarea>
                <x-input-error for="cform.description" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <!-- Botón de enviar -->
            <div class="flex flex-row-reverse justify-center">
                <button wire:click="store" wire:loading.attr="disabled" class="ml-2 p-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-paper-plane mr-2"></i> Publicar Tag
                </button>
                <button wire:click="cancelar" class="p-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                    <i class="fas fa-xmark mr-2"></i> Cancelar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>