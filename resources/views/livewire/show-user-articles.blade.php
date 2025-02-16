<x-self.base>
    <div class="flex w-full items-center mb-2 justify-between">
        <div>
            <x-input placeholder="Buscar..." wire:model.live="buscar" /><i class="mr-2 fas fa-search"></i>
        </div>
        <div>
            @livewire('crear-article')
        </div>
    </div>
    @if($articles->count())
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead>
                <tr>
                    <th scope="col" class="px-16 py-3">
                        INFO
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('title')">
                        Title<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('content')">
                        Content<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('tag')">
                        Tag<i class="ml-1 fas fa-sort "></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        <button wire:click="detalle({{$item->id}})">
                            <i class="fas fa-info text-lg hover:text-2xl"></i>
                        </button>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">
                        {{$item->title}}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">
                        {{$item->content}}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">
                        {{$item->name}}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900"></td>
                    <td class="px-6 py-4 py-4 font-semibold text-gray-900">
                        <button wire:click="editArticle({{$item->id}})">
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
        {{$articles->links()}}
    </div>
    @else
    <p>
        No se encontró ningún article o aún no ha escrito ninguno.
    </p>
    @endif

    @isset($uform->article)
    <x-dialog-modal wire:model="openUpdate">
        <x-slot name="title">
            EDITAR ARTICULO
        </x-slot>
        <x-slot name="content">
            <!-- Título -->
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium text-gray-700 mb-2">Title</label>
                <input type="text" wire:model="uform.title"
                    id="title" name="title" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe el título del articulo">
                <x-input-error for="uform.title" />
            </div>

            <!-- Contenido -->
            <div class="mb-6">
                <label for="content" class="block text-lg font-medium text-gray-700 mb-2">Content</label>
                <textarea wire:model="uform.content"
                    id="content" name="content" rows="6" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" placeholder="Escribe el contenido del articulo"></textarea>
                <x-input-error for="uform.content" />
            </div>

            <!-- Tag -->
            <div class="mb-6">
                <label for="tag" class="block text-lg font-medium text-gray-700 mb-2">Tag</label>
                <select id="tag" wire:model="uform.tag_id" name="tag" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    <option selected>Seleccionar tag</option>
                    @foreach($tags as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <x-input-error for="uform.tag_id" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <!-- Botón de Enviar -->
            <div class="flex flex-row-reverse justify-center">
                <button wire:click="update" wire:loading.attr="disabled" class="ml-2 p-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                    <i class="fas fa-paper-plane mr-2"></i> Editar Article
                </button>
                <button wire:click="cancelar" class="p-2 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                    <i class="fas fa-xmark mr-2"></i> Cancelar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endisset
    <!-- MODAL DETALLE -->
    @isset($articleDetalle)
    <x-dialog-modal wire:model="openDetalle">
        <x-slot name="title">
            Detalle Articulo
        </x-slot>
        <x-slot name="content">
            <div class="w-full rounded-lg overflow-hidden shadow-lg bg-white">
                
                <div class="px-6 py-4">
                    <!-- Título -->
                    <div class="font-bold text-xl mb-2">{{$articleDetalle->title}}</div>

                    <!-- Contenido -->
                    <p class="text-gray-700 text-base mb-4">
                        {{$articleDetalle->content}}
                    </p>

                    <!-- Tag -->
                    <p class="text-sm text-blue-500 font-semibold">Tag: <span class="text-gray-700">{{$articleDetalle->tag->name}}</span></p>
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