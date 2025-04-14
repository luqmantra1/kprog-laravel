<?php

namespace App\Exports;

use App\Models\Proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProposalExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Proposal::select('client_id','proposal_title','submission_date','status',)->get();
    }

    public function headings(): array
    {
        return ['Client ID','Title','Submission Date','Status',];
    }
}
