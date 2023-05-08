<?php

namespace App\Http\Livewire\Permission;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class DataTable extends PowerGridComponent
{
    use ActionButton;

    public string $sortField = 'id';

    public string $sortDirection = 'desc';

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'updatePermissionTable',
                'bulkDelete',
            ]
        );
    }

    /**
     * @throws \Throwable
     */
    public function updatePermissionTable()
    {
        $this->fillData();
    }

    public function bulkDelete(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Anda harus memilih setidaknya satu item!']);

            return;
        }

        $this->emit('deletePermission', ['permission_id' => $this->checkboxValues]);
    }

    public function createPermission(): void
    {
        $this->emit('createPermission');
    }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\Spatie\Permission\Models\Permission>
    */
    public function datasource(): Builder
    {
        return Permission::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('name')
            ->addColumn('name_lower', fn (Permission $model) => strtolower(e($model->name)));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->makeInputText('name')
                ->sortable(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Permission Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('detail', '&nbsp;<i class="fa fa-eye"></i>')
                ->target('')
                ->class('btn btn-sm btn-primary me-1')
                ->emit('detailPermission', ['permission_id' => 'id']),

            Button::make('edit', '&nbsp;<i class="fa fa-pencil"></i>')
                ->target('')
                ->class('btn btn-sm btn-warning me-1')
                ->emit('editPermission', ['permission_id' => 'id']),

            Button::make('destroy', '&nbsp;<i class="fa fa-trash"></i>')
                ->target('')
                ->class('btn btn-sm btn-danger me-1')
                ->emit('deletePermission', ['permission_id' => 'id']),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('ref-tingkat-biaya-create')
                ->caption(__('Tambah Permission'))
                ->class('btn btn-md btn-primary mb-5')
                ->emit('createPermission', []),
            Button::add('bulk-delete')
                ->caption(__('Bulk delete'))
                ->class('btn btn-md btn-secondary mb-5')
                ->emit('bulkDelete', [])
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Permission Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($permission) => $permission->id === 1)
                ->hide(),
        ];
    }
    */
}
