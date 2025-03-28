<x-layouts.app title="Compañías">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compañías') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-5 mb-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Gestión de Compañías</h3>
                        <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-gray-400">
                            Administre la información de las compañías del sistema
                        </p>
                    </div>

                    <livewire:company.company-index />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
