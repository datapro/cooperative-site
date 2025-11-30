<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MembersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       return new User([
            'name' => $row[0],
            'ledger_no' => $row[1],
            'membership_no' => $row[2],
            'email' => $row[3],
            'password' => Hash::make($row[4] ?? 'password123'), // default password
            'savingsBF' => $row[5],
            'loanBF' => $row[6] ?? null,
            'commBF' => $row[7] ?? null,
            'status' => $row[8] ?? 'active',
        ]);
    }
}
