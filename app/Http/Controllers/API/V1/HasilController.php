<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Services\Transaction\HasilService;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_order = $request->input('sort_order', 'desc');
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 10);

        $data = HasilService::getAllPaginate($page, $per_page, $sort_field, $sort_order);
        return ResponseFormatter::success($data["data"], 'Get data successful');
    }
}
