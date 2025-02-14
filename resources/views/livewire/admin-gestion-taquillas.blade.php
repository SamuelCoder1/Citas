<div class="p-6">
    <h1 class="text-2xl font-bold">Gestión de Taquillas</h1>

    <form wire:submit.prevent="save">
        <input type="text" wire:model="nombre" placeholder="Nombre de Taquilla" class="border p-2">
        <button type="submit" class="bg-blue-500 text-white p-2">Guardar</button>
    </form>

    <table class="w-full mt-4 border">
        <tr><th>Nombre</th><th>Acciones</th></tr>
        @foreach($taquillas as $taquilla)
        <tr>
            <td>{{ $taquilla->nombre }}</td>
            <td>
                <button wire:click="edit({{ $taquilla->id }})" class="bg-yellow-500 p-1">Editar</button>
                <button wire:click="delete({{ $taquilla->id }})" class="bg-red-500 p-1">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>
