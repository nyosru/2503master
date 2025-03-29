<div>
    создать столбец
    <form wire:submit.prevent="save">
        <input type="text" wire:model="name" placeholder="Column Name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Create Column</button>
    </form>
</div>
