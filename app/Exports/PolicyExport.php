<?php

namespace App\Exports;

use App\Models\Policy;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PolicyExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Policy::select('quotation_id','policy_number','status','start_date','end_date',)->get();
    }

    public function headings(): array
    {
        return ['Quotation ID','Policy Number','Status','Start Date','End Date',];
    }
}
