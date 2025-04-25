<div>
создать роль
    <form wire:submit.prevent="save">
        <input type="text" wire:model="name" placeholder="">
        @error('name') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Create Column</button>
    </form>
</div>
