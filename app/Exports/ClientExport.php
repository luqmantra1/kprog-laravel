<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Client::select('id', 'company_name', 'contact_person','email', 'phone', 'address', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Company Name', 'Contact Person','Email', 'Phone', 'Address', 'Created At'];
    }
}
