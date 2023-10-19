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

$clear = function () {
    $this->form->reset();
    $this->url = null;
};
?>

<x-app-layout>
    @volt
        <form wire:submit="submit">
            @if ($url)
                <div>
                    <p>Boom &mdash; your short link is ready!</p>
                    <div class="mt-4">
                        <div class="relative">
                            <input type="text" readonly
                                class="h-14 w-full rounded-lg border-slate-300 px-5 text-lg text-slate-800 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-500"
                                value="{{ $url->redirectUrl() }}" />
                            <button type="button" x-data="{ url: '{{ $url->redirectUrl() }}', copied: false }"
                                x-on:click="
                                $clipboard(url)
                                copied = true
                                setTimeout(()=> {
                                    copied = false
                                }, 2000)
                                "
                                x-text=" copied ? 'Copied' : 'Copy' "
                                class="absolute inset-y-2 right-2 h-10 rounded-lg bg-slate-500 px-6 font-medium text-blue-50">

                            </button>
                        </div>

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
                @if ($url)
                    <button type="button" wire:click="clear"
                        class="bg-blue-500 text-blue-50 rounded-lg
                    px-6 h-10 font-medium inset-y-2 right-2 mt-2">
                        Generate Another Short URL
                    </button>
                @else
                    <button type="submit"
                        class="bg-blue-500 text-blue-50 rounded-lg
          px-6 h-10 font-medium inset-y-2 right-2 mt-2">
                        Get Short URL
                    </button>
                @endif

                @error('form.url')
                    <div>{{ $message }}</div>
                @enderror
            </div>
        </form>
    @endvolt
</x-app-layout>
