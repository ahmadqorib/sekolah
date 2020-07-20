<?php

namespace App\DataTables;

use Html;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Http\Eloquent\Entities\Album;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AlbumDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('thumbnail', function($model){
                $img = asset($model->thumbnail_url);
                return '<img src="'.$img.'" class="img img-fluit img-thumbnail">';
            })->addColumn('created_at', function($model){
                return convert_date_ind($model->created_at, '%d %B %Y %H.%M');
            })->addColumn('status', function($model){ 
                return '<span class="badge '.($model->is_active == 1 ? 'bg-success':'bg-danger').'">'.($model->is_active == 1 ? 'Aktif':'Tidak AKtif').'</span>';
            })->addColumn('action', function($model){
                $show = route('admin.album.show', $model->id);
                $delete = route('admin.album.destroy', $model->id);
                $edit = route('admin.album.edit', $model->id);

                $html = '<div class="btn-group">';
                
                $html .= '
                    <a href="'.$show.'" class="btn btn-default btn-sm" title="detail"><i class="far fa-eye"></i></a>
                    <a href="'.$edit.'" class="btn btn-info btn-sm edit" title="edit"><i class="fas fa-edit"></i></a>
                    <a href="'.$delete.'" class="btn btn-danger btn-sm" data-confirm="Apakah anda yakin menghapus data ?" data-method="delete" title="hapus"><i class="far fa-trash-alt"></i></a>
                ';  

                $html .= '</div>';
                return $html;
            })->rawColumns(['action','thumbnail','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AlbumDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Album $model)
    {
        return $model->newQuery()->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('albumdatatable-table')
                    ->columns($this->getColumns())
                    ->addTableClass('table table-bordered table-striped')
                    ->minifiedAjax()
                    ->searching(false)
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->visible(false),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::computed('thumbnail')
                ->title('Foto')
                ->width(150),
            Column::computed('name')->title('Nama')->orderData(false),
            Column::computed('created_by')->title('Dibuat Oleh'),
            Column::computed('created_at')->title('Tanggal Buat'),
            Column::computed('status')->title('Status')
            // Column::make('status')->title('Status')
                
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Album_' . date('YmdHis');
    }
}
