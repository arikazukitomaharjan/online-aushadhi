<?php

namespace App\Http\Controllers\Api\Medicine;

use Illuminate\Http\Request;
use App\Repositories\Api\Medicine\MedicineRepository as Medicine;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MedicineController extends Controller
{

    public function autocompleteMedicine($medicine_name, Medicine $medicine)
    {

        $medicines = $medicine->search($medicine_name);
//        return $medicines;
        return response()->json(['success' => true, 'data' => $medicines]);
    }
}
