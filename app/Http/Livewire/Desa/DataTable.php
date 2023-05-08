<?php

namespace App\Http\Livewire\Desa;

use App\Models\Desa;
use Illuminate\Support\Carbon;
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
                'updateDesaTable',
                'bulkDelete',
            ]
        );
    }

    public function updateDesaTable()
    {
        $this->fillData();
    }

    public function bulkDelete(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Anda harus memilih setidaknya satu item!']);

            return;
        }

        $this->emit('deleteDesa', ['desa_id' => $this->checkboxValues]);
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
        return Desa::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('nama')
            ->addColumn('alamat');
    }

    public function columns(): array
    {
        return [

            Column::make('NAMA', 'nama')
                ->searchable()
                ->sortable(),

            Column::make('ALAMAT', 'alamat')
                ->searchable()
                ->sortable(),

        ];
    }

    public function header(): array
    {
        {
            return [
                Button::add('create')
                    ->caption(__('Tambah Desa'))
                    ->class('btn btn-md btn-primary mb-5')
                    ->emit('createDesa', []),
                Button::add('bulk-delete')
                    ->caption(__('Bulk delete'))
                    ->class('btn btn-md btn-secondary mb-5')
                    ->emit('bulkDelete', [])
            ];
        }
    }

    public function actions(): array
    {
        return [
            Button::make('detail', '&nbsp;<i class="fa fa-eye"></i>')
                ->target('')
                ->class('btn btn-sm btn-primary me-1')
                ->emit('detailDesa', ['desa_id' => 'id']),

            Button::make('edit', '&nbsp;<i class="fa fa-pencil"></i>')
                ->target('')
                ->class('btn btn-sm btn-warning me-1')
                ->emit('editDesa', ['desa_id' => 'id']),

            Button::make('destroy', '&nbsp;<i class="fa fa-trash"></i>')
                ->target('')
                ->class('btn btn-sm btn-danger me-1')
                ->emit('deleteDesa', ['desa_id' => 'id']),
        ];
    }


}
