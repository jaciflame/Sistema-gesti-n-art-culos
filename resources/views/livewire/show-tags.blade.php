<x-self.base>
    <div class="flex w-full items-center mb-2 justify-between">
        <div>
            <x-input placeholder="Buscar..." wire:model.live="buscar" /><i class="mr-2 fas fa-search"></i>
        </div>
        <div>
            @livewire('crear-tag')
        </div>
    </div>
    @if($tags->count())
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th scope="col" class="px-16 py-3">
                        INFO
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('name')">
                        Name<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('description')">
                        Description<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        <button wire:click="detalle({{$item->id}})">
                            <i class="fas fa-info text-lg hover:text-2xl"></i>
                        </button>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{$item->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->description}}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{$item->id}})">
                            <i class="fas fa-edit text-lg hover:text-2xl"></i>
                        </button>
                        <button wire:click="confirmarDelete({{$item->id}})">
                            <i class="fas fa-trash text-lg hover:text-2xl"></i>
                        </button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{$tags->links()}}
    </div>
    @else
    <p>
        No se encontró ningún tag o aún no ha escrito ninguno.
    </p>
    @endif
    <!-- MODAL EDITAR TAG -->
    @isset($uform->tag)
    <x-dialog-modal wire:model="openUpdateTag">
        <x-slot name="title">
            EDITAR TAG
        </x-slot>
        <x-slot name="content">
            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Name</label>
                <input type="text" wire:model="uform.name"
                    id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe el nombre del tag">
                <x-input-error for="uform.name" />
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Description</label>
                <textarea wire:model="uform.description"
                    id="description" name="description" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe la descripcion del tag"></textarea>
                <x-input-error for="uform.description" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <!-- Botón de Enviar -->
            <div class="flex flex-row-reverse justify-center">
                <button wire:click="update" wire:loading.attr="disabled" class="ml-2 p-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-paper-plane mr-2"></i> Editar Tag
                </button>
                <button wire:click="cancelar" class="p-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                    <i class="fas fa-xmark mr-2"></i> Cancelar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endisset
    <!-- MODAL DETALLE DEL TAG -->
    @isset($tagDetalle)
    <x-dialog-modal wire:model="openDetalleTag">
        <x-slot name="title">
            Detalle Tag
        </x-slot>
        <x-slot name="content">
            <div class="w-full rounded-lg overflow-hidden shadow-lg bg-white">

                <div class="px-6 py-4">
                    <!-- Name -->
                    <div class="font-bold text-xl mb-2">{{$tagDetalle->name}}</div>

                    <!-- Description -->
                    <p class="text-gray-700 text-base mb-4">
                    {{$tagDetalle->description}}
                    </p>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <x-button wire:click="cerrarDetalle">CERRAR</x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endisset
</x-self.base>