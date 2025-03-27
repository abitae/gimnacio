<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Edit extends Component
{
    public $companyId;
    public $name = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $website = '';
    public $showModal = true;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'address' => 'required|max:255',
            'phone' => 'nullable|max:50',
            'email' => 'nullable|email|max:255|unique:companies,email,' . $this->companyId,
            'website' => 'nullable|url|max:255',
        ];
    }

    public function mount($companyId = null)
    {
        $this->companyId = $companyId;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->email = '';
        $this->website = '';
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInputFields();
    }

    public function openModal()
    {
        if ($this->companyId) {
            $company = Company::findOrFail($this->companyId);
            $this->name = $company->name;
            $this->address = $company->address;
            $this->phone = $company->phone;
            $this->email = $company->email;
            $this->website = $company->website;
        }
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $company = Company::findOrFail($this->companyId);
        $company->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
        ]);

        $this->closeModal();
        $this->dispatch('companyUpdated');
        session()->flash('message', 'Compañía actualizada exitosamente.');
    }

    public function render()
    {
        return view('livewire.company.edit');
    }
}
