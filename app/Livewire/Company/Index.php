<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $companyIdBeingEdited = null;
    public $companyIdBeingDeleted = null;

    protected $listeners = [
        'companyCreated' => '$refresh',
        'companyUpdated' => '$refresh',
        'companyDeleted' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->showCreateModal = true;
    }

    public function edit($companyId)
    {
        $this->companyIdBeingEdited = $companyId;
        $this->showEditModal = true;
    }

    public function confirmDelete($companyId)
    {
        $this->companyIdBeingDeleted = $companyId;
        $this->showDeleteModal = true;
    }

    public function render()
    {
        $companies = Company::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.company.index', [
            'companies' => $companies,
        ]);
    }
}
