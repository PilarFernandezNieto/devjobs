{{-- Este componente traía los mensajes de error de login.blade.php con el componente de laravel x-input-error.blace --}}
{{-- Creo el nuevo componente de livewire como en e curso --}}
<form class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Título Vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')"
            placeholder="Título Vacante" />
        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div>
    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select wire:model="salario" id="salario"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div>
    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select wire:model="categoria" id="categoria"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">-- Seleccione --</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div>
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')"
            placeholder="Empresa: ej. Netflix, Uber, Shopify" />
        @error('empresa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div>
    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia"
            :value="old('ultimo_dia')" />
        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div>
    <div>
        <x-input-label for="descripcion" :value="__('Descripción del puesto')" />
        <textarea wire:model="descripcion" id="descripcion" placeholder="Descripción general del puesto, experiencia..."
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-72"></textarea>
        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div>
    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" />
        @error('imagen')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>
    <x-primary-button class="w-full justify-center">
        {{ __('Crear vacante') }}
    </x-primary-button>

</form>
