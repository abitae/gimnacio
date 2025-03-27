<x-layouts.app title="Compañías">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compañías') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session()->has('message'))
                        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="mb-4 px-4 py-2 bg-red-100 border border-red-200 text-red-700 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <livewire:company.index />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
