<div>
    <div x-data="{ showModal: @entangle('showModal') }" x-init="$watch('showModal', value => { if (value) $wire.openModal() })">
        <div x-show="showModal" class="fixed inset-0 overflow-y-auto" style="display: none">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                    Editar Compañía
                                </h3>
                                <div class="mt-4">
                                    <form wire:submit.prevent="update">
                                        <div class="mb-4">
                                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                            <input type="text" id="name" wire:model.blur="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
                                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                                            <input type="text" id="address" wire:model.blur="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
                                            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                                            <input type="text" id="phone" wire:model.blur="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
                                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                            <input type="email" id="email" wire:model.blur="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
                                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Website</label>
                                            <input type="url" id="website" wire:model.blur="website" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md">
                                            @error('website') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="update" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Actualizar
                        </button>
                        <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
