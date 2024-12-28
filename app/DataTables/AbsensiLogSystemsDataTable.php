<?php

namespace App\DataTables;

use App\Models\Absensi;
use App\Models\AbsensiLogSystemModel;
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


class AbsensiLogSystemsDataTable extends DataTable
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
            ->addColumn('action', 'vendor.adminlte.absensi-log-system.datatables_action')
            ->addColumn('created_at', function (AbsensiLogSystemModel $data) {
                return \Carbon\Carbon::parse($data->created_at)->translatedFormat('Y-m-d H:i:s');
            })
            ->addColumn('raw', function (AbsensiLogSystemModel $data) {
                return nl2br($data->raw);
            })
            ->rawColumns(['action','id_device','id_user'])
            /* ->editColumn('kategori', function (AbsensiLogSystemModel $data) {
                return $data->getKategori()->first()?->title;
            }) *//* 
            ->filterColumn('kategori', function ($query, $keywords) use ($request) {
                $query->where('kategori','like','%'.$keywords.'%');
            }) */
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AbsensiLogSystemModel $model,Request $request): QueryBuilder
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
				$query->whereBetween('created_at', [$request->start_date, $request->end_date]);
			});
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
            ->setTableId('absensi-log-system-table')
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
                /* Button::make('searchPanes'), */
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
            Column::make('created_at')->title('Created At')->searchable(true),
            Column::make('the_raw')->title('Raw')->searchable(true),
            Column::make('the_post')->title('Post')->searchable(true),
            Column::make('the_get')->title('Get')->searchable(true),
            Column::make('the_request')->title('Request')->searchable(true),
            Column::make('the_server')->title('Server')->searchable(true),
            Column::make('user_agent')->title('User Agent')->searchable(true),
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
