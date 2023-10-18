 <?php
 use function Livewire\Volt\{state, rules};
 state('url');
 
 rules(['url' => 'required|url']);
 
 $submit = function () {
     $this->validate();
 };
 ?>

 <x-app-layout>
     @volt
         <form wire:submit="submit" wire:model="url">
             <input type="text" id="url"
                 class="w-full rounded-lg border-slate-300 text-slate-800 
                 h-14 px-5 text-lg placeholder:text-slate-400 focus:ring-2 
                 focus:ring-blue-500"
                 placeholder="e.g. https://google.com">

             <div class="flex items-baseline space-x-4">
                 <button type="submit"
                     class="bg-blue-500 text-blue-50 rounded-lg
                 px-6 h-10 font-medium inset-y-2 right-2 mt-2">
                     Get Short URL
                 </button>

                 @error('url')
                     <div>{{ $message }}</div>
                 @enderror
             </div>
         </form>
     @endvolt
 </x-app-layout>
