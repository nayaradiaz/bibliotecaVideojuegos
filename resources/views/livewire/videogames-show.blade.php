<div wire:poll="getGames">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button type="button" class="mr-3 mb-4 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                    wire:click="openCreateModal">Crear Videojuego</button>

                    <table class="w-full text-md bg-white  rounded mb-4 text-center">
                        <thead class="text-white">
                                <tr class="border-b bg-indigo-500">

                                    <th class=" p-3 px-5">Name</th>
                                    <th class="p-3 px-5">Description</th>
                                    <th class="p-3 px-5">Cover</th>

                                </tr>

                        </thead>
                        <tbody class="flex-1 sm:flex-none">
                            @foreach ($videogames as $games)
                            <tr class="border-b hover:bg-indigo-100 bg-gray-100">
                               
                                <td class="p-3 px-5">
                                    {{$games->name}}
                                </td>
                                <td class="p-3 px-5 ">
                                        
                                    {{$games->description}}

                                </td>
                                <td class="p-3 px-5 ">
                                        
                                    {{$games->cover}}

                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
                {{-- <form wire:submit.prevent="save">
                    <input type="file" wire:model="photo">
                 
                    @error('photo') <span class="error">{{ $message }}</span> @enderror
                 
                    <button type="submit">Save Photo</button>
                </form> --}}
            </div>
            
            
        </div>
          <!-- component MODAL -->
    @if ($modal)
    <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
        <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
            <div class="w-full">
                <div class="m-8 my-20 max-w-[400px] mx-auto">
                    <div class="mb-8">
                        <h1 class="mb-4 text-3xl font-extrabold">
                          Crear Videojuego
                        </h1>
                        <form>
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Título</label>
                                    <input type="text" wire:model="name" name="name" id="name"
                                        autocomplete="name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <textarea type="text" wire:model="description" name="description" id="description" autocomplete="description"
                                        rows="3"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <div class="space-y-4">
                        <button class="p-3 bg-black rounded-full text-white w-full font-semibold"
                        wire:click="createVideogame">
                       Crear nueo Videojuego
                    </button>
                        <button class="p-3 bg-white border rounded-full w-full font-semibold"
                        wire:click="closeCreateModal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>