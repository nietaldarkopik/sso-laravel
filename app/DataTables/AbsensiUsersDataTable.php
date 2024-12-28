<?php

namespace App\DataTables;

use App\Models\Absensi;
use App\Models\AbsensiUserModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use Storage;


class AbsensiUsersDataTable extends DataTable
{
    //protected $actions = ['print', 'excel'];

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query, Request $request): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'vendor.adminlte.absensi-users.datatables_action')
            ->addColumn('photo', function($content){
				return (!empty($content->photo))?'<img src="' . asset(Storage::url($content->photo)) . '" style="height: 150px;"/>':'';
			})
            ->addColumn('id_unit', function (AbsensiUserModel $data) {
                return '<strong>' . ($data->unit->nama ?? '') . '</strong> <br/> ' . ($data->unit->jabatan ?? '');
            })
			->rawColumns(['action','id_unit','photo'])
            /* ->addColumn('getKategori', function (AbsensiUserModel $jenispsu) {
                return $jenispsu->getKategori->title;
            }) */
            /* ->editColumn('kategori', function (AbsensiUserModel $jenispsu) {
                return $jenispsu->getKategori()->first()?->title;
            }) *//* 
            ->filterColumn('kategori', function ($query, $keywords) use ($request) {
                $query->where('kategori','like','%'.$keywords.'%');
            }) */
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AbsensiUserModel $model,Request $request): QueryBuilder
    {
        $q =  $model->newQuery();

        
        $columns = $request->columns ?? [];
        $q->where(function($query) use ($columns) {
            if (count($columns) > 0) {
                foreach ($columns as $i => $c) {
                    if (isset ($c['search'])) {
                        $query->orWhere($c['data'], 'like', '%'.$c['search']['value'].'%');
                    }
                }
            }
        });

        return $q;
        //return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('absensi-users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(2)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
                Button::make('searchPanes'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            //Column::make('districts.id'),
            Column::make('row_number')
            ->title('#')
            ->render('meta.row + meta.settings._iDisplayStart + 1;')
            ->width(50)
            ->orderable(false)
            ->searchable(false),
			Column::make('photo')->title('Photo')->width(130),
			Column::make('nama')->title('Nama')->searchable(true),
			Column::make('jabatan')->title('Jabatan')->searchable(true),
			Column::make('jenis_kelamin')->title('Jenis Kelamin')->searchable(true),
			Column::make('id_unit')->title('Unit')->searchable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AbsensiUsers_' . date('YmdHis');
    }

}
