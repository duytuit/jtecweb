<?php
namespace App\Exports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamExport implements FromQuery,WithHeadings
{
    use Exportable;

    public $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function query()
    {
        $model = Exam::query();
        $model = $model->where($this->options);
        return  $model;
    }
    public function headings(): array
    {
        return [
            'id',
            'name',
            'code',
            'sub_dept',
            'cycle_name',
            'create_date',
            'results',
            'total_questions',
            'status',
            'confirm',
            'counting_time',
            'limit_time',
            'data',
            'created_at',
            'updated_at',
            'deleted_at',
            'updated_by',
            'deleted_by',
            'mission'
        ];


    }
}
