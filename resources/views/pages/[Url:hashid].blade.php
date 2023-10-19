<?php
use App\Models\Url;
use function Livewire\Volt\{state, mount};
use function Laravel\Folio\name;

// state(['url' => fn() => $url]);

name('redirect');

mount(function (Url $url) {
    $url->increment('visits');

    redirect($url->url, 301);
});

?>

@volt
    <div>
        {{ $url->url }}
        You should be redirected.
    </div>
@endvolt
