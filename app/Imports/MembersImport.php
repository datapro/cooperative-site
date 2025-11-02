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
            'department' => $row[1],
            'email' => $row[2],
            'membership_no' => $row[3],
            'phone' => $row[4] ?? null,
            'status' => $row[5] ?? 'active',
            'password' => Hash::make($row[6] ?? 'password123'), // default password
        ]);
    }
}
