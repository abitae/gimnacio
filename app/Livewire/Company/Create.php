<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class Create extends Component
{
    public $name = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $website = '';
    public $showModal = false;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'address' => 'required|max:255',
        'phone' => 'nullable|max:50',
        'email' => 'nullable|email|unique:companies,email|max:255',
        'website' => 'nullable|url|max:255',
    ];

    public function mount()
    {
        $this->resetInputFields();
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

    public function save()
    {
        $this->validate();

        Company::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
        ]);

        $this->closeModal();
        $this->dispatch('companyCreated');
        session()->flash('message', 'Compañía creada exitosamente.');
    }

    public function render()
    {
        return view('livewire.company.create');
    }
}
