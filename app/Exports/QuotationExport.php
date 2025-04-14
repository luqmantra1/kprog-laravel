<?php

namespace App\Exports;

use App\Models\Quotation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuotationExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Quotation::select('client_id','proposal_id','insurance_company','quotation_number','amount','status','acceptance_status','policy_status',)->get();
    }

    public function headings(): array
    {
        return ['Client ID','Proposal ID','Insurance Company','Quotation Number','Amount','Status','Acceptance Status','Policy Status',];
    }
}
