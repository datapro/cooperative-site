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
    
        // Skip empty or invalid rows
    if (
        !isset($row[0]) || trim($row[0]) === '' ||
        !isset($row[3]) || trim($row[3]) === ''
    ) {
        return null; // ✅ skip safely
    }
       return new User([
            'name' => $row[0],
            'ledger_no' => $row[1],
            'membership_no' => $row[2],
            'email' => $row[3],
            'password' => Hash::make($row[4] ?? 'password123'), // default password
            'savingsBF' => is_numeric($row[5] ?? null) ? $row[5] : 0,
            // 'loanBF' => $row[6] ?? null,
            'commBF' => is_numeric($row[6] ?? null) ? $row[6] : 0,
            // 'loanINT' => $row[8] ?? null,
            'status' => $row[7] ?? 'active',
        ]);
    }

    public function chunkSize(): int { return 1000; }
    public function batchSize(): int { return 1000; }

    public function uniqueBy()
    {
        return 'email';
    }
}
