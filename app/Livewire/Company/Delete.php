<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Delete extends Component
{
    public $companyId;
    public $showModal = false;
    public $companyName = '';

    public function mount($companyId = null)
    {
        $this->companyId = $companyId;
    }

    public function openModal()
    {
        if ($this->companyId) {
            $company = Company::findOrFail($this->companyId);
            $this->companyName = $company->name;
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function delete()
    {
        $company = Company::findOrFail($this->companyId);

        // Verificar si tiene sucursales asociadas
        if ($company->branches()->count() > 0) {
            session()->flash('error', 'No se puede eliminar la compañía porque tiene sucursales asociadas.');
            $this->closeModal();
            return;
        }

        $company->delete();

        $this->closeModal();
        $this->dispatch('companyDeleted');
        session()->flash('message', 'Compañía eliminada exitosamente.');
    }

    public function render()
    {
        return view('livewire.company.delete');
    }
}
