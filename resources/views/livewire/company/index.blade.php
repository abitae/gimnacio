<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar compañías..."
                   class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
        </div>
        <div>
            <button wire:click="create" class="bg-indigo-600 text-white px-4 py-2 rounded-md font-medium hover:bg-indigo-700 focus:outline-none focus:ring focus:border-blue-300 transition">
                <span class="mr-1">+</span> Nueva Compañía
            </button>
        </div>
    </div>

    <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dirección</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Teléfono</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Website</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($companies as $company)
                        <tr wire:key="company-{{ $company->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $company->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $company->address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $company->phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $company->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($company->website)
                                    <a href="{{ $company->website }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                        {{ $company->website }}
                                    </a>
                                @else
                                    <span class="text-gray-400">No definido</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="edit({{ $company->id }})" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 mr-2">
                                    Editar
                                </button>
                                <button wire:click="confirmDelete({{ $company->id }})" class="text-red-600 dark:text-red-400 hover:text-red-900">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">No hay compañías registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $companies->links() }}
    </div>

    @if ($showCreateModal)
        @livewire('company.create')
    @endif

    @if ($showEditModal && $companyIdBeingEdited)
        @livewire('company.edit', ['companyId' => $companyIdBeingEdited], key('edit-company-' . $companyIdBeingEdited))
    @endif

    @if ($showDeleteModal && $companyIdBeingDeleted)
        @livewire('company.delete', ['companyId' => $companyIdBeingDeleted], key('delete-company-' . $companyIdBeingDeleted))
    @endif
</div>
