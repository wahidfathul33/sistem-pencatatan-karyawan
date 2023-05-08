<?php

namespace App\Http\Livewire\Role;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use Throwable;

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
                'updateRoleTable',
            ]
        );
    }

    /**
     * @throws Throwable
     */
    public function updateRoleTable()
    {
        $this->fillData();
    }

    public function createRole(): void
    {
        $this->emit('createRole');
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
    * @return Builder<\Spatie\Permission\Models\Role>
    */
    public function datasource(): Builder
    {
        return Role::query()->withCount(['users', 'permissions']);
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
            ->addColumn('name_lower', fn (Role $model) => \Str::lower(e($model->name)))
            ->addColumn('users_count')
            ->addColumn('permissions_count');
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
            Column::make('Nama', 'name_lower','name')
                ->searchable()
                ->makeInputText('name')
                ->sortable(),

            Column::make('Total Permission', 'permissions_count')
                ->sortable(),

            Column::make('Total User', 'users_count')
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
     * PowerGrid Role Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('detail', '&nbsp;<i class="fa fa-eye"></i>')
               ->target('')
               ->class('btn btn-sm btn-primary me-1')
               ->emit('detailRole', ['role_id' => 'id']),

           Button::make('edit', '&nbsp;<i class="fa fa-pencil"></i>')
               ->target('')
               ->class('btn btn-sm btn-warning me-1')
               ->emit('editRole', ['role_id' => 'id']),

           Button::make('destroy', '&nbsp;<i class="fa fa-trash"></i>')
               ->target('')
               ->class('btn btn-sm btn-danger me-1')
               ->emit('deleteRole', ['role_id' => 'id']),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('create-role')
                ->caption(__('Tambah Role'))
                ->class('btn btn-md btn-primary mb-5')
                ->emit('createRole', [])
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
     * PowerGrid Role Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($role) => $role->id === 1)
                ->hide(),
        ];
    }
    */
}
