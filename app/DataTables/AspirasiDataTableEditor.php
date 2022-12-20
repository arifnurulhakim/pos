<?php

namespace App\DataTables;

use App\Models\Aspirasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class AspirasiDataTableEditor extends DataTablesEditor
{
    protected $model = User::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'status'
        ];
    }





    // public function dataTable($query)
    // {
    //     return datatables($query)->setRowId('id')->addColumn('status', '');
    // }

    // public function query(Aspirasi $model)
    // {
    //     return $model->newQuery()->select('status');
    // }



    // public function html()
    // {
    //     return $this->builder()
    //                 ->columns($this->getColumns())
    //                 ->minifiedAjax()
    //                 ->parameters([
    //                     'dom' => 'Bfrtip',
    //                     'order' => [1, 'asc'],
    //                     'select' => [
    //                         'style' => 'os',
    //                         'selector' => 'td:first-child',
    //                     ],
    //                     'buttons' => [
    //                         ['extend' => 'create', 'editor' => 'editor'],
    //                         ['extend' => 'edit', 'editor' => 'editor'],
    //                         ['extend' => 'remove', 'editor' => 'editor'],
    //                     ]
    //                 ]);
    // }


    // protected function getColumns()
    // {
    //     return [
    //         [
    //             'data' => null,
    //             'defaultContent' => '',
    //             'className' => 'select-checkbox',
    //             'title' => '',
    //             'orderable' => false,
    //             'searchable' => false
    //         ],
    //         'status'
    //     ];
    // }

    // protected function filename()
    // {
    //     return 'aspirasis_' . time();
    // }


    /**
     * Get edit action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function editRules(Model $model)
    {
        return [
            'status' => "sometimes",
        ];
    }

    /**
     * Get remove action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function removeRules(Model $model)
    {
        return [];
    }
}
