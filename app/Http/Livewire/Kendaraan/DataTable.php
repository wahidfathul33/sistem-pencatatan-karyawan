<?php

namespace App\Http\Livewire\Kendaraan;

use App\Exports\KendaraanExport;
use App\Models\Desa;
use App\Models\Kendaraan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
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
                'updateKendaraanTable',
                'bulkDelete',
                'exportExcel',
            ]
        );
    }

    public function updateKendaraanTable()
    {
        $this->fillData();
    }

    public function bulkDelete(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Anda harus memilih setidaknya satu item!']);

            return;
        }

        $this->emit('deleteKendaraan', ['kendaraan_id' => $this->checkboxValues]);
    }

    public function exportExcel()
    {
        return Excel::download(new KendaraanExport(), 'kendaraan.xlsx');
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
        return Kendaraan::query()
            ->join('desas', 'desas.id', '=','kendaraans.desa_id')
            ->selectRaw('desas.nama as nama_desa, kendaraans.*')
            ->when(auth()->user()->hasRole('desa'),
                fn ($q) => $q->where('desa_id', auth()->user()->desa_id)->where('desa_id', auth()->user()->desa_id)
            );
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        $column = PowerGrid::eloquent();
        $column = $column->addColumn('nama_kendaraan');

        if (!auth()->user()->hasRole('desa')){
            $column = $column->addColumn('nama_desa');
        }

        return $column->addColumn('plat_nomor')
            ->addColumn('tgl_pajak_formatted', fn (Kendaraan $model) => Carbon::parse($model->tgl_pajak)->format('d/m/Y'))
            ->addColumn('tgl_ganti_plat_formatted', fn (Kendaraan $model) => Carbon::parse($model->tgl_ganti_plat)->format('d/m/Y'));
    }

    public function header(): array
    {
        {
            return [
                Button::add('create')
                    ->caption(__('Tambah Kendaraan'))
                    ->class('btn btn-md btn-primary mb-5')
                    ->emit('createKendaraan', []),
                Button::add('bulk-delete')
                    ->caption(__('Bulk delete'))
                    ->class('btn btn-md btn-secondary mb-5')
                    ->emit('bulkDelete', []),
                Button::add('export-excel')
                    ->caption(__('Export Excel'))
                    ->class('btn btn-md btn-success mb-5')
                    ->emit('exportExcel', [])
            ];
        }
    }

    public function columns(): array
    {
        return auth()->user()->hasRole('desa') ?
            [
                Column::make('NAMA', 'nama_kendaraan')
                    ->sortable()
                    ->searchable()
                    ->makeInputText(),

                Column::make('PLAT NOMOR', 'plat_nomor')
                    ->sortable()
                    ->searchable()
                    ->makeInputText(),

                Column::make('TGL PAJAK', 'tgl_pajak_formatted', 'tgl_pajak')
                    ->searchable()
                    ->sortable()
                    ->makeInputDatePicker(),

                Column::make('TGL GANTI PLAT', 'tgl_ganti_plat_formatted', 'tgl_ganti_plat')
                    ->searchable()
                    ->sortable()
                    ->makeInputDatePicker()
            ] :
            [
                Column::make('NAMA', 'nama_kendaraan')
                    ->sortable()
                    ->searchable()
                    ->makeInputText(),

                Column::make('Desa', 'nama_desa')
                    ->searchable()
                    ->makeInputSelect(
                        Desa::select('nama')->get(),
                        'nama', 'nama', ['live_search' => true]
                    ),

                Column::make('PLAT NOMOR', 'plat_nomor')
                    ->sortable()
                    ->searchable()
                    ->makeInputText(),

                Column::make('TGL PAJAK', 'tgl_pajak_formatted', 'tgl_pajak')
                    ->searchable()
                    ->sortable()
                    ->makeInputDatePicker(),

                Column::make('TGL GANTI PLAT', 'tgl_ganti_plat_formatted', 'tgl_ganti_plat')
                    ->searchable()
                    ->sortable()
                    ->makeInputDatePicker()
            ];
    }

    public function actions(): array
    {
        return [
            Button::make('detail', '&nbsp;<i class="fa fa-eye"></i>')
                ->target('')
                ->class('btn btn-sm btn-primary me-1')
                ->emit('detailKendaraan', ['kendaraan_id' => 'id']),

            Button::make('edit', '&nbsp;<i class="fa fa-pencil"></i>')
                ->target('')
                ->class('btn btn-sm btn-warning me-1')
                ->emit('editKendaraan', ['kendaraan_id' => 'id']),

            Button::make('destroy', '&nbsp;<i class="fa fa-trash"></i>')
                ->target('')
                ->class('btn btn-sm btn-danger me-1')
                ->emit('deleteKendaraan', ['kendaraan_id' => 'id']),
        ];
    }


    public function actionRules(): array
    {
        return [
            Rule::rows()
                ->when(fn($kendaraan) => Carbon::parse($kendaraan->tgl_pajak)->diffInDays(now(), false) >= -7
                    && Carbon::parse($kendaraan->tgl_update_stnk)->diffInDays(now(), false) >= 93)
                ->setAttribute('class', 'bg-warning'),

            Rule::rows()
                ->when(fn($kendaraan) => Carbon::parse($kendaraan->tgl_pajak)->diffInDays(now(), false) > 0
                    && Carbon::parse($kendaraan->tgl_update_stnk)->diffInDays(now(), false) >= 93)
                ->setAttribute('class', 'bg-danger'),
        ];
    }
}
