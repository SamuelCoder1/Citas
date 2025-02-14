<div class="p-6">
    <h1 class="text-2xl font-bold">Gestión de Asesores</h1>

    <form wire:submit.prevent="save">
        <input type="text" wire:model="name" placeholder="Nombre" class="border p-2">
        <input type="email" wire:model="email" placeholder="Correo" class="border p-2">
        <input type="text" wire:model="documento" placeholder="Documento" class="border p-2">
        <input type="password" wire:model="password" placeholder="Contraseña" class="border p-2">
        <button type="submit" class="bg-blue-500 text-white p-2">Guardar</button>
    </form>

    <table class="w-full mt-4 border">
        <tr><th>Nombre</th><th>Email</th><th>Documento</th><th>Acciones</th></tr>
        @foreach($asesores as $asesor)
        <tr>
            <td>{{ $asesor->name }}</td>
            <td>{{ $asesor->email }}</td>
            <td>{{ $asesor->documento }}</td>
            <td>
                <button wire:click="edit({{ $asesor->id }})" class="bg-yellow-500 p-1">Editar</button>
                <button wire:click="delete({{ $asesor->id }})" class="bg-red-500 p-1">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>
