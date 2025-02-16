<x-app-layout>
    <x-self.base>
        <h3 class="mb-2 text-center w-full text-2xl font-bold">
            Listado de Articulos
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach($articles as $item)
            <article class=
                'p-1 rounded-2xl shadow-xl bg-cover bg-no-repeat
                md:col-span-2'>
                <div class="flex flex-col justify-between h-full text-center items-center">
                    <div class="text-xl font-bold text-white p-1 rounded-xl bg-gray-400">
                        {{$item->title}}
                    </div>
                    <div class=" bg-gray-400 p-2 rounded-2xl italic text-white bg-black-500">
                        {{$item->content}}
                    </div>
                    <div class="p-2 font-bold rounded-xl text-center text-white bg-black-500">
                        {{$item->tag->name}}
                    </div>
                    <div class="p-2 font-bold rounded-xl text-center text-blue-200 italic  bg-gray-400" >
                        {{$item->user->name}}
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="mt-1">
            {{$articles->links()}}
        </div>
    </x-self.base>
    @session('mensaje')
    <script>
        Swal.fire("{{session('mensaje')}}");
    </script>
    @endsession
</x-app-layout>