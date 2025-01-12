<div wire:poll="getGames">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Botón para abrir el modal de crear videojuego -->
                    <button type="button" class="mr-3 mb-4 text-sm bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        wire:click="openCreateModal">Crear Videojuego</button>
                    <!-- En tu vista donde se listan los videojuegos -->


                    <table class="w-full text-md bg-white rounded mb-4 text-center">
                        <thead class="text-white">
                            <tr class="border-b bg-indigo-500">
                                <th class="p-3 px-5">Nombre</th>
                                <th class="p-3 px-5">Descripcion</th>
                                <th class="p-3 px-5">Portada</th>
                                <th class="p-3 px-5">Acciones</th>

                            </tr>
                        </thead>
                        <tbody class="flex-1 sm:flex-none">
                            @foreach ($videogames as $game)
                            <tr class="border-b hover:bg-indigo-100 bg-gray-100 cursor-pointer">
                                <td class="p-3 px-5">{{ $game->name }}</td>
                                <td class="p-3 px-5">{{ $game->description }}</td>
                                <td class="p-3 px-5 flex justify-center	">
                                    @if($game->cover && file_exists(public_path('storage/' . $game->cover)))
                                    <img src="{{ asset('storage/' . $game->cover) }}" alt="cover" width="80">
                                    @else
                                    <img src="{{ asset('storage/images/default_cover.webp') }}" alt="default cover" width="80">
                                    @endif
                                </td>
                                <td class="p-3 px-5">
                                    <!-- Botón para abrir el modal de detalles -->
                                    <button type="button" class="mr-3 mb-4 text-sm bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        wire:click="openGameDetails({{ $game->id }})">Ver Detalles</button>

                                    <!-- Botón para abrir el modal de añadir valoración -->
                                    <button type="button" class="mr-3 mb-4 text-sm bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        wire:click="openRatingModal({{ $game->id }})">Añadir Valoración</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            <div>

            </div>

        </div>

        <!-- Modal Crear Videojuego -->
        @if ($modalCreate)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                <div class="w-full">
                    <div class="m-8 my-20 max-w-[400px] mx-auto">
                        <h1 class="mb-4 text-3xl font-extrabold">Crear Videojuego</h1>
                        @if (session()->has('error'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 9000)" x-show="show"
                            class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if (session()->has('message'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 9000)" x-show="show"
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('message') }}
                        </div>
                        @endif
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
        @endif

        <!-- Modal Ver Detalles Videojuego -->
        @if ($modalDetails && $selectedGame)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                <div class="w-full">
                    <div class="m-8 my-20 max-w-[400px] mx-auto">
                        <h1 class="mb-4 text-3xl font-extrabold">Detalles del Videojuego</h1>
                        @if (session()->has('error'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 9000)" x-show="show"
                            class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if (session()->has('message'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 9000)" x-show="show"
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form wire:submit.prevent="editGame">
                            <div class="space-y-4">
                                <div>
                                    <strong>Título: </strong>
                                    <input type="text" wire:model="name" value="{{ $selectedGame->name }}" class="w-full">
                                </div>
                                <div>
                                    <strong>Descripción: </strong>
                                    <textarea wire:model="description" class="w-full">{{ $selectedGame->description }}</textarea>
                                </div>

                                <div>
                                    <strong>Portada: </strong>
                                    <div class="mb-2">
                                        @if($selectedGame->cover)
                                        <img src="{{ asset('storage/' . $selectedGame->cover) }}" alt="cover" width="80">
                                        @else
                                        <img src="{{ asset('storage/images/default_cover.webp') }}" alt="default cover" width="80">
                                        @endif
                                    </div>
                                    <label for="photo">Cambiar portada:</label>
                                    <input type="file" wire:model="photo">
                                    @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="mt-2 w-40">
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 space-y-4">
                                <!-- Mostrar el botón de editar para todos los usuarios -->
                                <button type="submit" class="p-3 bg-blue-600 text-white rounded-full w-full font-semibold">
                                    Guardar cambios
                                </button>

                                <!-- Eliminar solo si el usuario tiene el rol de admin o es el propietario -->
                                @if(auth()->user()->hasRole('admin') || auth()->id() == $selectedGame->user_id)
                                <button type="button" wire:click="deleteGame" class="p-3 bg-red-600 text-white rounded-full w-full font-semibold">
                                    Eliminar Videojuego
                                </button>
                                @endif

                                <!-- Botón de cancelar -->
                                <button type="button" wire:click="closeDetailsModal" class="p-3 bg-white border rounded-full w-full font-semibold">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Modal Añadir Valoración -->
        @if ($modalRating && $selectedGameId)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                <div class="w-full">
                    <div class="m-8 my-20 max-w-[400px] mx-auto">
                        <h1 class="mb-4 text-3xl font-extrabold">Añadir Valoración</h1>
                        <!-- Mensaje de éxito -->
                        @if (session()->has('message'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('message') }}
                        </div>
                        @endif

                        <!-- Mensaje de error -->
                        @if (session()->has('error'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                        @endif

                        <!-- Si aún no tienes Alpine.js -->
                        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


                        <form wire:submit.prevent="submitRating">
                            <div class="space-y-4">
                                <!-- Puntuación en formato de estrellas -->
                                <label for="rating">Puntuación</label>
                                <div class="flex space-x-1 ">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="mb-3">
                                        <input type="radio" wire:model="rating" value="{{ $i }}" class="hidden" />
                                        <svg class="w-6 h-6 {{ $i <= $rating ? 'text-yellow-500' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 3.5a1 1 0 011.902 0l1.133 3.455a1 1 0 00.95.69h3.626a1 1 0 01.586 1.795l-2.928 2.136a1 1 0 00-.364 1.118l1.134 3.456a1 1 0 01-1.535 1.118l-2.928-2.136a1 1 0 00-1.18 0l-2.928 2.136a1 1 0 01-1.535-1.118l1.134-3.456a1 1 0 00-.364-1.118L4.26 9.44A1 1 0 015.845 7.645h3.626a1 1 0 00.95-.69l1.133-3.455z" />
                                        </svg>
                                        </label>
                                        @endfor
                                </div>

                                <!-- Campo de Comentario (opcional) -->
                                <label for="comment">Comentario</label>
                                <textarea wire:model="comment" class="w-full" placeholder="Escribe un comentario opcional..."></textarea>
                            </div>

                            <div class="mt-4 space-y-4">
                                <!-- Botón para enviar la valoración -->
                                <button type="submit" class="p-3 bg-green-600 text-white rounded-full w-full font-semibold">
                                    Enviar Valoración
                                </button>

                                <!-- Botón para cancelar el modal -->
                                <button type="button" wire:click="closeRatingModal" class="p-3 bg-white border rounded-full w-full font-semibold">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>