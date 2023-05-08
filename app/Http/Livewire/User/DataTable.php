<?php

namespace App\Http\Livewire\User;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use Spatie\Permission\Models\Role;

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
                'updateUserTable'
            ]
        );
    }
    public function updateUserTable()
    {
        $this->fillData();
    }

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

    public function datasource(): Builder
    {
        return User::query()
            ->join('desas', 'desas.id', '=', 'users.desa_id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->selectRaw('
                users.*,
                UPPER(roles.name) as role_name,
                desas.nama
            ');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('nama')
            ->addColumn('username')
            ->addColumn('email')
            ->addColumn('role_name');

    }

    public function columns(): array
    {
        return [
            Column::make('Desa', 'nama')
                ->searchable()
                ->makeInputSelect(
                    Desa::select('nama')->get(),
                    'nama', 'nama', ['live_search' => true]
                ),

            Column::make('Username', 'username')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('Email', 'email')
                ->searchable()
                ->makeInputText(),

            Column::make('Role', 'role_name')
                ->searchable()
                ->makeInputSelect(
                    Role::selectRaw('UPPER(name) as name')->get(),
                    'name', 'name', ['live_search' => true]
                ),

        ];
    }

    public function header(): array
    {
        return [
            Button::add('create')
                ->caption(__('Tambah User'))
                ->class('btn btn-md btn-primary mb-5')
                ->emit('createUser', []),
        ];
    }

    public function actions(): array
    {
        return [
            Button::make('detail', '&nbsp;<i class="fa fa-eye"></i>')
                ->target('')
                ->class('btn btn-sm btn-primary me-1')
                ->emit('detailUser', ['user_id' => 'id']),

            Button::make('edit', '&nbsp;<i class="fa fa-pencil"></i>')
                ->target('')
                ->class('btn btn-sm btn-warning me-1')
                ->emit('editUser', ['user_id' => 'id']),

            Button::make('destroy', '&nbsp;<i class="fa fa-trash"></i>')
                ->target('')
                ->class('btn btn-sm btn-danger me-1')
                ->emit('deleteUser', ['user_id' => 'id']),
        ];
    }

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($user) => $user->id === 1)
                ->hide(),
        ];
    }
    */
}
