<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestionar los libros') }}
        </h2>
    </x-slot>

    {{-- clientes --}}
    @if (Auth::user()->doc_id)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div>
                            <div class="flex items-center bg-white border-b border-gray-200 rounded-lg p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                    Libros disponibles.
                                </h2>
                            </div>
                            @foreach ($libros as $item)
                                <div class="p-2 mt-2 ml-2 border-b border-gray-800">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        <h4 class="ml-3 font-semibold text-gray-900">
                                            <a href="{{ route('libros.show', $item->id) }}">{{ $item->titulo }}</a>
                                        </h4>
                                        <a href="{{ route('libros.show', $item->id) }}"
                                            class="inline-flex items-center font-semibold text-indigo-700">
                                            <span class="ml-2 text-sm">Ver detalles...</span>
                                        </a>
                                    </div>

                                    <p class="mt-2 text-gray-500 text-sm leading-relaxed">
                                        {{ $item->descripcion }}
                                    </p>
                                    <form method="POST" action="{{ route('reservas.store') }}">
                                        @csrf
                                        <div class="flex items-center justify-end mt-4">
                                            @if ($item->disponible == 1)
                                                <x-input id="libro_id" hidden type="text" name="libro_id"
                                                    value="{{ $item->id }}" />
                                                <x-button class="ml-4">{{ __('Reservar') }}</x-button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                            {{-- <div class="p-2">{{ $libros->links() }}</div> --}}
                        </div>
                        <div>
                            <div class="flex items-center bg-white border-b border-gray-200 rounded-lg p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900">Libros reservados.</h2>
                            </div>
                            @foreach ($reservas as $item)
                                <div class="p-2 mt-2 ml-2 border-b border-gray-800">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        <h4 class="ml-3 font-semibold text-gray-900">
                                            <a title="{{ $item->plazo_entrega == 0 ? 'Plazo de reserva finalizado ' : '' }}"
                                                href="{{ route('libros.show', $item->libro->id) }}">
                                                <span class="{{ $item->plazo_entrega == 0 ? 'text-red-600' : '' }}">
                                                    {{ $item->libro->titulo }}</a>
                                            </span>
                                        </h4>
                                        <a href="{{ route('libros.show', $item->libro->id) }}"
                                            class="inline-flex items-center font-semibold text-indigo-700">
                                            <span class="ml-2 text-sm">Ver detalles...</span>
                                        </a>
                                    </div>
                                    <p class="mt-2 text-gray-500 text-sm leading-relaxed">
                                        {{ $item->libro->descripcion }}
                                    </p>
                                    <form method="POST" action="{{ route('reservas.destroy', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button class="ml-4 ">
                                                <samp class="{{ $item->plazo_entrega == 0 ? 'text-red-600' : '' }}">
                                                    {{ __('Devolver') }}
                                                </samp>
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- trabajadores --}}
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div>
                            <div class="flex items-center bg-white border-b border-gray-200 rounded-lg p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900">
                                    Libros de la biblioteca.
                                </h2>
                                <div class="mr-auto">
                                    <form method="GET" action="{{ route('libros.create') }}">
                                        @csrf
                                        <x-button class="ml-4">{{ __('Insertar') }}</x-button>
                                    </form>
                                </div>
                            </div>
                            @foreach ($libros as $item)
                                <div class="p-2 mt-2 ml-2 border-b border-gray-800">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        <h4 class="ml-3 font-semibold text-gray-900">
                                            <a href="{{ route('libros.show', $item->id) }}">{{ $item->titulo }}</a>
                                        </h4>
                                        <a href="{{ route('libros.show', $item->id) }}"
                                            class="inline-flex items-center font-semibold text-indigo-700">
                                            <span class="ml-2 text-sm">Ver detalles...</span>
                                        </a>
                                    </div>

                                    <p class="mt-2 text-gray-500 text-sm leading-relaxed">
                                        {{ $item->descripcion }}
                                    </p>
                                </div>
                            @endforeach
                            {{-- <div class="p-2">{{ $libros->links() }}</div> --}}
                        </div>
                        <div>
                            <div class="flex items-center bg-white border-b border-gray-200 rounded-lg p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                <h2 class="ml-3 text-xl font-semibold text-gray-900">Libros reservados.</h2>
                            </div>
                            @foreach ($reservas as $item)
                                <div class="p-2 mt-2 ml-2 border-b border-gray-800">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        <h4 class="ml-3 font-semibold text-gray-900">
                                            <a title="{{ $item->plazo_entrega == 0 ? 'Plazo de reserva finalizado ' : '' }}"
                                                href="{{ route('libros.show', $item->libro->id) }}">
                                                <span class="{{ $item->plazo_entrega == 0 ? 'text-red-600' : '' }}">
                                                    {{ $item->libro->titulo }}</a>
                                            </span>
                                        </h4>
                                        <a href="{{ route('libros.show', $item->libro->id) }}"
                                            class="inline-flex items-center font-semibold text-indigo-700">
                                            <span class="ml-2 text-sm">Ver detalles...</span>
                                        </a>
                                    </div>
                                    <p class="mt-2 text-gray-500 text-sm leading-relaxed">
                                        {{ $item->libro->descripcion }}
                                    </p>
                                    
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
