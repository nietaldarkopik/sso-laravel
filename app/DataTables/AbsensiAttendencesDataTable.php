<?php

namespace App\DataTables;

use App\Models\Absensi;
use App\Models\AbsensiAttendenceModel;
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


class AbsensiAttendencesDataTable extends DataTable
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
            ->addColumn('id_device', function (AbsensiAttendenceModel $data) {
                return( $data->device->device_name ?? '') . ' / ' . ($data->device->sn ?? '') .' / ' . ($data->device->location ?? '');
            })
            ->addColumn('id_user', function (AbsensiAttendenceModel $data) {
                return '<strong>' . ($data->user->nama ?? '') . '</strong> <br/> ' . ($data->user->jabatan ?? '');
            })
            ->rawColumns(['action','id_user'])
            /* ->addColumn('getKategori', function (AbsensiAttendenceModel $jenispsu) {
                return $jenispsu->getKategori->title;
            }) */
            /* ->editColumn('kategori', function (AbsensiAttendenceModel $jenispsu) {
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
    public function query(AbsensiAttendenceModel $model,Request $request): QueryBuilder
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

		if ($request->has('start_date') && $request->has('end_date') && !empty($request->input('start_date')) && !empty($request->input('end_date'))) {
			$q->where(function($query) use ($request){
				$query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
			});
		}

        if ($request->has('id_device') && $request->input('id_device') != '') {
            $q->where('id_device', $request->input('id_device'));
        }

        if ($request->has('id_user') && $request->input('id_user') != '') {
            $q->where('id_user', $request->input('id_user'));
        }

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
            ->dom('Brfltip')
            ->orderBy(2)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
                //Button::make('searchPanes'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            /* Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'), */
            //Column::make('districts.id'),
            Column::make('row_number')
            ->title('#')
            ->render('meta.row + meta.settings._iDisplayStart + 1;')
            ->width(50)
            ->orderable(false)
            ->searchable(false),
			Column::make('id_user')->title('Karyawan')->searchable(true),
			Column::make('tanggal')->title('Tanggal')->searchable(true),
			Column::make('datang')->title('Datang')->searchable(true),
			Column::make('pulang')->title('Pulang')->searchable(true),
			Column::make('id_device')->title('Device')->searchable(true),
			Column::make('device_no')->title('Device No')->searchable(true),
			Column::make('user_no')->title('User No')->searchable(true),
			
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AbsensiAttendences_' . date('YmdHis');
    }

}
