<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del libro:') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class=" text-2xl font-medium text-gray-900">
                    {{ $libro->titulo }}
                </h1>

                <p class="mt-6 text-gray-500 leading-relaxed">
                    {{ $libro->descripcion }}
                </p>

                @if (!Auth::user()->doc_id)
                    @if ($libro->reserva)
                        <div class="flex items-center justify-start mt-4">
                            <h6>
                                <strong>Reservado por:</strong>
                                {{ $libro->reserva->user->name }}, {{ $libro->reserva->user->last_name }}
                            </h6>
                        </div>
                    @endif
                    <div class="flex items-center justify-end mt-4">
                        <form method="GET" action="{{ route('libros.edit', $libro->id) }}">
                            @csrf
                            <x-button class="ml-4">{{ __('Editar') }}</x-button>
                        </form>
                        <form method="POST" action="{{ route('libros.destroy', $libro->id) }}">
                            @csrf
                            @method('delete')
                            @if (!$libro->reserva)
                                <x-button class="ml-4">
                                    <samp class="text-red-600">
                                        {{ __('Dar baja') }}
                                    </samp>
                                </x-button>
                            @endif
                        </form>
                    </div>
                @else
                    @if ($libro->reserva && $libro->reserva->user_id == Auth::user()->id)
                        <form method="POST" action="{{ route('reservas.destroy', $libro->reserva->id) }}">
                            @csrf
                            @method('delete')
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">{{ __('Devolver') }}</x-button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('reservas.store') }}">
                            @csrf
                            <div class="flex items-center justify-end mt-4">
                                @if ($libro->disponible == 1)
                                    <x-input id="libro_id" hidden type="text" name="libro_id"
                                        value="{{ $libro->id }}" />
                                    <x-button class="ml-4">{{ __('Reservar') }}</x-button>
                                @endif
                            </div>
                        </form>
                    @endif
                @endif


            </div>
        </div>
    </div>
</x-app-layout>
