<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar el libro:') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('libros.update', $libro->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <label class="block font-medium text-sm text-gray-700" for="titulo">
                                Título
                            </label>
                            <input
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                type="text" name="titulo" value="{{ old('titulo', $libro->titulo) }}">
                        </div>
                        <div class="col-span-6">
                            <label class="block font-medium text-sm text-gray-700" for="descripcion">
                                Descripción
                            </label>
                            <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                name="descripcion" cols="30" rows="6">{{ old('descripcion', $libro->descripcion) }}</textarea>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        wire:loading.attr="disabled" wire:target="photo">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
