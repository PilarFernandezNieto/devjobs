<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">{{ $vacante->titulo }}</a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>
                <div class="flex flex-col md:flex-row items-stretch gap-3  mt-5 md:mt-0">
                    <a href="{{route('candidatos.index', $vacante)}}"
                        class="text-center bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">
                        {{$vacante->candidatos->count()}} Candidatos</a>
                    <a href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="text-center bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Editar</a>
                    <button wire:click="$emit('mostrarAlerta', {{ $vacante->id }})"
                        class="text-center bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Eliminar</button>

                    <!-- Ejemplo con $emit -->
                    <!-- <button wire:click="$emit('prueba', {{ $vacante->id }})"
                        class="text-center bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Eliminar</button> -->
                </div>
            </div>

        @empty

            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>
        @endforelse
    </div>

    <div class="mt-10 px-6 md:px-0">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('mostrarAlerta', (vacante_id) => {
            Swal.fire({
                title: "Eliminar vacante",
                text: "Una vacante eliminada no se puede eliminar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Eliminar la vacante desde el servidor
                    Livewire.emit('eliminarVacante', vacante_id)

                    Swal.fire({
                        title: "Eliminada",
                        text: "La vancante ha sido eliminada",
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endpush
