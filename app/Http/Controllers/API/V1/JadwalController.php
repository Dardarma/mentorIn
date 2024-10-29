<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\Transaction\HasilService;
use App\Services\Transaction\JadwalService;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalService::dataAll();
        $data = [
            'jadwal' => $jadwal['data']
        ]; 
        return ResponseFormatter::success($data, 'get data successfull');
    }
}
