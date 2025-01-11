<div wire:poll="getGames">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button type="button" class="mr-3 mb-4 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                        wire:click="openCreateModal">Crear Videojuego</button>

                    <table class="w-full text-md bg-white rounded mb-4 text-center">
                        <thead class="text-white">
                            <tr class="border-b bg-indigo-500">
                                <th class="p-3 px-5">Name</th>
                                <th class="p-3 px-5">Description</th>
                                <th class="p-3 px-5">Cover</th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 sm:flex-none">
                            @foreach ($videogames as $game)
                            <tr class="border-b hover:bg-indigo-100 bg-gray-100">
                                <td class="p-3 px-5">{{ $game->name }}</td>
                                <td class="p-3 px-5">{{ $game->description }}</td>
                                <td class="p-3 px-5">
                                <td class="p-3 px-5">
                                    @if($game->cover && file_exists(public_path('storage/' . $game->cover)))
                                    <!-- Si hay una portada, mostramos la imagen subida -->
                                    <img src="{{ asset('storage/' . $game->cover) }}" alt="cover" width="80">
                                    @else
                                    <!-- Si no hay portada, mostramos la imagen por defecto -->
                                    <img src="{{ asset('storage/images/default_cover.webp') }}" alt="default cover" width="80">
                                    @endif
                                </td>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        @if ($modal)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                <div class="w-full">
                    <div class="m-8 my-20 max-w-[400px] mx-auto">
                        <div class="mb-8">
                            <h1 class="mb-4 text-3xl font-extrabold">Crear Videojuego</h1>
                            <form wire:submit.prevent="createVideogame">
                                <div class="space-y-4">
                                    <label for="name">Título</label>
                                    <input type="text" wire:model="name" class="w-full">

                                    <label for="description">Descripción</label>
                                    <textarea wire:model="description" class="w-full"></textarea>

                                    <!-- Campo de Imagen -->
                                    <label for="photo">Portada (Imagen)</label>
                                    <input type="file" wire:model="photo">

                                    <!-- Vista previa -->
                                    @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="mt-2 w-40">
                                    @endif
                                </div>

                                <button type="submit" class="p-3 bg-black rounded-full text-white w-full font-semibold mt-4">
                                    Guardar Videojuego
                                </button>
                                <button type="button" wire:click="closeCreateModal"
                                    class="p-3 bg-white border rounded-full w-full font-semibold mt-2">
                                    Cancelar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>