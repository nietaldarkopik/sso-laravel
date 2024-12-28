<?php

namespace App\DataTables;

use App\Models\PengajuanModel;
use App\Models\StatusPengajuanModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use Auth;

class PengajuansDataTable extends DataTable
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
            ->addColumn('action', 'vendor.adminlte.pengajuans.datatables_action')
            ->editColumn('created_at', function (PengajuanModel $pengajuan) {
                return date('d/m/Y H:i:s', strtotime($pengajuan->created_at));
            })
            ->editColumn('updated_at', function (PengajuanModel $pengajuan) {
                return date('d/m/Y H:i:s', strtotime($pengajuan->updated_at));
            })
            ->editColumn('created_by', function (PengajuanModel $pengajuan) {
				$output = '<strong>'.$pengajuan->createdBy?->name.'</strong><br/>';
				$output .= $pengajuan->unit->nama;
                return $output;
            })
            ->editColumn('updated_by', function (PengajuanModel $pengajuan) {
				if(empty($pengajuan->editedBy)){
					return '';
				}
				$output = '<strong>'.$pengajuan->editedBy?->name.'</strong><br/>';
				$output .= $pengajuan->unit->nama;
                return $output;
            })
            ->editColumn('status', function (PengajuanModel $pengajuan) {
				$status = StatusPengajuanModel::where('kode','like',$pengajuan->status)->first();
				$bg = isset($status->warna_bg) ? $status->warna_bg: '#ccc';
				$text = isset($status->warna_text) ? $status->warna_text: '#000';
				$style = ' style="border-color: '.$bg.' !important; background-color: '.$bg.' !important; color: '.$text.' !important;" ';
				$output = '<span class="btn btn-primary" '.$style.'>'.($status->judul ?? $pengajuan->status ?? 'Tidak Diketahui').'</span>';
                return $output;
            })
			->rawColumns(['created_by','action','updated_by','status'])
            /* ->editColumn('kategori', function (PengajuanModel $pengajuan) {
                return $pengajuan->getKategori()->first()?->title;
            }) 
            ->filterColumn('kategori', function ($query, $keywords) use ($request) {
                $query->where('kategori','like','%'.$keywords.'%');
            })*/
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PengajuanModel $model,Request $request): QueryBuilder
    {
        $q =  $model->newQuery();

        $columns = $request->columns ?? [];
        if (count($columns) > 0) {
            foreach ($columns as $i => $c) {
                $q->where(function($query) use ($c) {
					if(isset($c['search']['value']))
					{
						$query->orWhere($c['data'], 'like', $c['search']['value']);
					}
                });
            }
        }

        return $q->where('id_user','=',Auth::user()->id)->orderBy('id','desc');
        //return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pengajuans-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->buttons([
                //Button::make('excel'),
                //Button::make('csv'),
                //Button::make('pdf'),
                //Button::make('print'),
                //Button::make('reset'),
                //Button::make('reload'),
                //Button::make('searchPanes'),
            ])
            //dom:'lBfrtip',
            ->dom('lBfrtip')
            
            //->destroy(true)
            //->fixedHeader(true)
            //->responsive(true)
            //->serverSide(true)
            //->stateSave(true)
            //->processing(true)
            //->pageLength(100)
            //->dom($this->domHtml)

            ->orderBy(2)
            ->selectStyleSingle()
            ->parameters([
                'drawCallback' => 'function() { $(\'[data-tooltip]\').tooltip({}); }',
                'initComplete' => 'function () {
                    /* window.LaravelDataTables["pengajuans-table"].buttons().container()
                     .appendTo( ".justify-content-stretch") */
                 }',
                'responsive' => [
                    'details' => true
                ],
                'buttons' => [
                    //Button::make('excel'),
                    //Button::make('csv'),
                    //Button::make('pdf'),
                    //Button::make('print'),
                    //Button::make('reset'),
                    //Button::make('reload'),
                    //Button::make('searchPanes'),
                    
                    'excel',
                    'csv',
                    'pdf',
                    'print',
                    'reset',
                    'reload',
                    'searchPanes',
                ],
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
			//Column::make('id_sop')->title('Jenis Pengajuan')->searchable(true)->visible(true),
			//Column::make('id_user')->title('User')->searchable(true)->visible(true),
			//Column::make('id_unit')->title('Unit')->searchable(true)->visible(true),
			Column::make('judul')->title('Judul')->searchable(true)->visible(true),
			Column::make('nominal')->title('Jml. Pengajuan')->searchable(true)->visible(true),
			Column::make('created_by')->title('Dibuat Oleh')->searchable(true)->visible(true),
			Column::make('updated_by')->title('Diedit Oleh')->searchable(true)->visible(true),
			Column::make('tgl_pengajuan')->title('Tgl. Pengajuan')->searchable(true)->visible(true),
			Column::make('created_at')->title('Tgl. Dibuat')->searchable(true)->visible(true),
			Column::make('updated_at')->title('Tgl. Diedit')->searchable(true)->visible(true),
			Column::make('status')->title('Status')->searchable(true)->visible(true)->className('text-center'),
			
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pengajuans_' . date('YmdHis');
    }

}
