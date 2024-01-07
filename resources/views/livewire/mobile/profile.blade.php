<div class="px-4">
    <form wire:submit.prevent="submit">
        {{$this->form}}
        <button type="submit" class="w-full rounded-md mt-4 py-2 text-center text-[#F5E8C6] bg-[#435585]">
            Save
        </button>
    </form>
</div>