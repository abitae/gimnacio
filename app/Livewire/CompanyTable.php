<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CompanyTable extends PowerGridComponent
{
    public string $tableName = 'company-table-39hx5g-table';

    public function header(): array
    {
        return [
            Button::add('create-dish')
                ->slot('Create a dish')
                ->attributes([
                    'id' => 'my-custom-id',
                    'class' => 'another-class'
                ]),
        ];
    }
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Company::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('address')
            ->add('phone')
            ->add('email')
            ->add('website')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address')
                ->sortable()
                ->searchable(),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Website', 'website')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($dishId): void
    {
        $this->js('alert(' . $dishId . ')');
    }

    public function actions(Company $row): array
    {
        return [
            Button::add('create-dish')
                ->slot("&#9889; Edit")
                ->dispatch('edit', ['dishId' => $row->id]),
                //->dispatchTo('admin-component', 'postAdded', ['key' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
