<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CompanyIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $showDeleteModal = false;
    public $companyIdBeingDeleted = null;

    // Variables para el modal de empresa
    public $showModal = false;
    public $action = 'create';
    public $title = 'Crear Empresa';
    public $description = 'Complete la información para crear una nueva empresa.';
    public $company;
    public $logo;

    protected function rules()
    {
        $rules = [
            'company.ruc' => 'required|string|size:11',
            'company.razon_social' => 'required|string|max:255',
            'company.nombre_comercial' => 'nullable|string|max:255',
            'company.email' => 'nullable|email|max:255',
            'company.telephone' => 'nullable|string|max:50',
            'company.website' => 'nullable|url|max:255',

            // Dirección
            'company.ubigeo' => 'nullable|string|max:6',
            'company.departamento' => 'nullable|string|max:100',
            'company.provincia' => 'nullable|string|max:100',
            'company.distrito' => 'nullable|string|max:100',
            'company.direccion' => 'nullable|string|max:255',
            'company.cod_local' => 'nullable|string|max:4',

            // Accesos SUNAT
            'company.usuario_sol' => 'nullable|string|max:20',
            'company.clave_sol' => 'nullable|string|max:255',
            'company.certificado_path' => 'nullable|string|max:255',
            'company.certificado_password' => 'nullable|string|max:255',

            // Series
            'company.serie_factura' => 'nullable|string|max:4',
            'company.serie_boleta' => 'nullable|string|max:4',
            'company.serie_nota_credito' => 'nullable|string|max:4',
            'company.serie_nota_debito' => 'nullable|string|max:4',
            'company.serie_guia' => 'nullable|string|max:4',

            // Modo
            'company.modo' => 'required|in:desarrollo,produccion',
        ];

        // Si el logo es nuevo, añadir reglas
        if ($this->action === 'create' ||
            (is_object($this->company->logo) && method_exists($this->company->logo, 'getMimeType'))) {
            $rules['company.logo'] = 'nullable|image|max:2048';
        }

        return $rules;
    }

    protected $validationAttributes = [
        'company.ruc' => 'RUC',
        'company.razon_social' => 'Razón Social',
        'company.nombre_comercial' => 'Nombre Comercial',
        'company.email' => 'Email',
        'company.telephone' => 'Teléfono',
        'company.logo' => 'Logo',
    ];

    public function mount()
    {
        $this->company = new Company();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->company = new Company();
        $this->company->modo = 'desarrollo';

        $this->action = 'create';
        $this->title = 'Crear Empresa';
        $this->description = 'Complete la información para crear una nueva empresa.';

        $this->showModal = true;
    }

    public function edit($companyId)
    {
        $this->resetErrorBag();
        $this->company = Company::find($companyId);

        if ($this->company) {
            $this->action = 'edit';
            $this->title = 'Editar Empresa';
            $this->description = 'Actualice la información de la empresa.';
            $this->showModal = true;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        // Gestionar el logo
        if (is_object($this->company->logo) && method_exists($this->company->logo, 'store')) {
            // Es un archivo cargado mediante Livewire
            $logoPath = $this->company->logo->store('company/logo', 'public');
            $this->company->logo = $logoPath;
        }

        if ($this->action === 'create') {
            $this->company->save();
            session()->flash('message', 'Empresa creada correctamente');
        } else {
            $this->company->save();
            session()->flash('message', 'Empresa actualizada correctamente');
        }

        $this->closeModal();
    }

    public function confirmDelete($companyId)
    {
        $this->companyIdBeingDeleted = $companyId;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $company = Company::find($this->companyIdBeingDeleted);
        if ($company) {
            $company->delete();
            $this->showDeleteModal = false;
            $this->companyIdBeingDeleted = null;
            session()->flash('message', 'Empresa eliminada correctamente');
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->companyIdBeingDeleted = null;
    }

    public function render()
    {
        $companies = Company::query()
            ->when($this->search, function ($query) {
                $query->where('razon_social', 'like', '%' . $this->search . '%')
                    ->orWhere('nombre_comercial', 'like', '%' . $this->search . '%')
                    ->orWhere('ruc', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('telephone', 'like', '%' . $this->search . '%');
            })
            ->orderBy('razon_social')
            ->paginate(10);

        return view('livewire.company.company-index', [
            'companies' => $companies,
        ]);
    }
}
