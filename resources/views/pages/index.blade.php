<?php
use App\Models\Url;
use App\Livewire\Forms\UrlForm;
use App\Utility\HashidGenerator;
use function Livewire\Volt\{state, rules, form};

state('url');

form(UrlForm::class);

$submit = function (HashidGenerator $hashIdGenerator) {
    $this->form->validate();

    $this->url = Url::create(
        $this->form->only('url') + [
            'hashid' => $hashIdGenerator->generate(),
        ],
    );
};
?>

<x-app-layout>
    @volt
        <form wire:submit="submit">
            @if ($url)
                <div>
                    <p>Boom &mdash; your short link is ready!</p>
                    <div class="mt-4">
                        <input type="text" id="url"
                            class="w-full rounded-lg border-slate-300 text-slate-800
                         h-14 px-5 text-lg placeholder:text-slate-400 focus:ring-2
                         focus:ring-blue-500"
                            value="{{ $url->redirectUrl() }}" readonly>
                    </div>
                </div>
            @else
                <input wire:model="form.url" type="text" id="url"
                    class="w-full rounded-lg border-slate-300 text-slate-800 
                     h-14 px-5 text-lg placeholder:text-slate-400 focus:ring-2 
                     focus:ring-blue-500"
                    placeholder="e.g. https://google.com">
            @endif

            <div class="flex items-baseline space-x-4">
                <button type="submit"
                    class="bg-blue-500 text-blue-50 rounded-lg
                 px-6 h-10 font-medium inset-y-2 right-2 mt-2">
                    Get Short URL
                </button>

                @error('form.url')
                    <div>{{ $message }}</div>
                @enderror
            </div>
        </form>
    @endvolt
</x-app-layout>
