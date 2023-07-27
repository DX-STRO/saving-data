<?php

namespace App\Exports;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProfileExport implements FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Profile::select('nik', 'nama', 'nohp', 'rt', 'kelurahan')
                        ->where('user_id', Auth::id())
                        ->get();
    }

    public function headings(): array{
        return ["NIK","NAMA","NO.HP","RT","KELURAHAN"];
    }
}
