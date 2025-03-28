<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <flux:input
                wire:model.live.debounce.300ms="search"
                placeholder="Buscar compañías..."
            />
        </div>
        <div>
            <x-button wire:click="create" primary>
                <x-icon name="plus" class="w-4 h-4 mr-1" /> Nueva Compañía
            </x-button>
        </div>
    </div>

    @if (session()->has('message'))
        <x-alert icon="check-circle" success title="Operación exitosa">
            {{ session('message') }}
        </x-alert>
    @endif

    <div class="mt-4 overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">RUC</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Razón Social</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre Comercial</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dirección</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Teléfono</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($companies as $company)
                    <tr wire:key="company-{{ $company->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $company->ruc }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $company->razon_social }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $company->nombre_comercial }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $company->direccion }}
                            @if($company->distrito && $company->provincia && $company->departamento)
                                <br><span class="text-xs text-gray-500">{{ $company->distrito }}, {{ $company->provincia }}, {{ $company->departamento }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $company->telephone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $company->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <x-button wire:click="edit({{ $company->id }})" info sm>
                                <x-icon name="pencil" class="w-4 h-4 mr-1" /> Editar
                            </x-button>
                            <x-button wire:click="confirmDelete({{ $company->id }})" negative sm>
                                <x-icon name="trash" class="w-4 h-4 mr-1" /> Eliminar
                            </x-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center">No hay compañías registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $companies->links() }}
    </div>

    <!-- Modal para confirmar eliminación -->
    <flux:modal wire:model="showDeleteModal">
        <div class="space-y-6">
            <div>
                <x-text variant="heading" size="xl">Confirmar eliminación</x-text>
                <x-text class="mt-2">¿Está seguro que desea eliminar esta empresa? Esta acción no se puede deshacer.</x-text>
            </div>
            <div class="flex justify-end space-x-3">
                <x-button wire:click="cancelDelete" flat>Cancelar</x-button>
                <x-button wire:click="delete" negative>Eliminar</x-button>
            </div>
        </div>
    </flux:modal>

    <!-- Modal para crear/editar empresa -->
    <flux:modal wire:model="showModal" size='xl' class="max-w-xl">
        <form wire:submit.prevent="save">
            <div class="space-y-6">
                <div class="border-b border-gray-200 pb-4">
                    <x-text variant="heading" size="xl">{{ $title }}</x-text>
                    <x-text class="mt-2">{{ $description }}</x-text>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Campos principales -->
                    <div class="col-span-4">
                        <x-text variant="heading" size="lg">Información General</x-text>
                    </div>

                    <flux:input wire:model="company.ruc" label="RUC" placeholder="20123456789" maxlength="11" required />
                    <flux:input wire:model="company.razon_social" label="Razón Social" placeholder="EMPRESA S.A.C." required />
                    <flux:input wire:model="company.nombre_comercial" label="Nombre Comercial" placeholder="Nombre comercial de la empresa" />
                    <flux:input wire:model="company.email" label="Email" type="email" placeholder="empresa@ejemplo.com" />
                    <flux:input wire:model="company.telephone" label="Teléfono" placeholder="+51 123456789" />
                    <flux:input wire:model="company.website" label="Sitio Web" placeholder="https://www.empresa.com" />
                    <flux:input wire:model="company.ubigeo" label="Ubigeo" placeholder="150101" maxlength="6" />
                    <flux:input wire:model="company.cod_local" label="Código Local" placeholder="0000" maxlength="4" />

                    <!-- Dirección -->
                    <div class="col-span-4 mt-4">
                        <x-text variant="heading" size="lg">Dirección Fiscal</x-text>
                    </div>

                    <flux:input wire:model="company.departamento" label="Departamento" placeholder="LIMA" />
                    <flux:input wire:model="company.provincia" label="Provincia" placeholder="LIMA" />
                    <flux:input wire:model="company.distrito" label="Distrito" placeholder="MIRAFLORES" />
                    <flux:input wire:model="company.direccion" label="Dirección" placeholder="AV. PRINCIPAL 123" />

                    <!-- Accesos SOL -->
                    <div class="col-span-4 mt-4">
                        <x-text variant="heading" size="lg">Accesos SUNAT</x-text>
                    </div>

                    <flux:input wire:model="company.usuario_sol" label="Usuario SOL" placeholder="USUARIOSOL" />
                    <flux:input wire:model="company.clave_sol" label="Clave SOL" type="password" placeholder="********" />
                    <flux:input wire:model="company.certificado_path" label="Ruta del Certificado" placeholder="certificates/20123456789.pfx" />
                    <flux:input wire:model="company.certificado_password" label="Contraseña del Certificado" type="password" placeholder="********" />

                    <!-- Series de documentos -->
                    <div class="col-span-4 mt-4">
                        <x-text variant="heading" size="lg">Series de Documentos</x-text>
                    </div>

                    <flux:input wire:model="company.serie_factura" label="Serie Factura" placeholder="F001" maxlength="4" />
                    <flux:input wire:model="company.serie_boleta" label="Serie Boleta" placeholder="B001" maxlength="4" />
                    <flux:input wire:model="company.serie_nota_credito" label="Serie Nota Crédito" placeholder="FC01" maxlength="4" />
                    <flux:input wire:model="company.serie_nota_debito" label="Serie Nota Débito" placeholder="FD01" maxlength="4" />
                    <flux:input wire:model="company.serie_guia" label="Serie Guía" placeholder="T001" maxlength="4" />
                    <flux:select
                        label="Modo"
                        placeholder="Seleccione un modo"
                        wire:model="company.modo"
                    >
                        <flux:select.option label="Desarrollo" value="desarrollo" />
                        <flux:select.option label="Producción" value="produccion" />
                    </flux:select>
                    <div class="col-span-2"></div>

                    <!-- Logo -->
                    <div class="col-span-4 mt-4">
                        <x-text variant="heading" size="lg">Logo de la Empresa</x-text>
                    </div>

                    <div class="col-span-4">
                        <flux:input
                            type="file"
                            wire:model="company.logo"
                            label="Logo"
                            accept="image/png,image/jpeg,image/jpg"
                        />

                        @if($company && isset($company->logo) && !is_object($company->logo))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $company->logo) }}"
                                alt="Logo de la empresa"
                                class="h-20 w-auto object-contain" />
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-5 border-t border-gray-200">
                    <x-button wire:click="closeModal" flat>Cancelar</x-button>
                    <x-button type="submit" primary>{{ $action === 'create' ? 'Crear' : 'Actualizar' }}</x-button>
                </div>
            </div>
        </form>
    </flux:modal>
</div>
