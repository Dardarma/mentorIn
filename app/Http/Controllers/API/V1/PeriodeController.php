<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Services\PeriodeService;
use App\Models\Periode;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = [
            'search' => $request->input('search')
        ];

        $sort_field = $request->input('sort_field', 'created_at');
        $sort_order = $request->input('sort_order', 'desc');
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 10);

        $data = PeriodeService::getAllPaginate($page, $per_page, $sort_field, $sort_order,$filter);
        return ResponseFormatter::success($data["data"], 'Data berhasil diambil');
    }

    public function getAll(){
        $data = Periode::all();
        return ResponseFormatter::success($data, 'Data berhasil diambil');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = [
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            'durasi_magang' => $request->input('durasi_magang'),
        ];

        $validate = Validator::make($payload, [
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'durasi_magang' => 'required|integer',
        ], [
            'required' => ':attribute wajib diisi',
            'date' => ':attribute harus berupa tanggal yang valid',
            'integer' => ':attribute harus berupa angka',
            'after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal mulai'
        ]);

        if ($validate->fails()) {
            return ResponseFormatter::error([
                'error' => $validate->errors()->all(),
            ], 'Validasi gagal', 402);
        }

        $data = PeriodeService::create($payload);
        if (!$data['status']) {
            return ResponseFormatter::error($data['errors'], 'Gagal membuat data');
        }

        return ResponseFormatter::success($data['data'], 'Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payload = [
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            'durasi_magang' => $request->input('durasi_magang'),
        ];

        $validate = Validator::make($payload, [
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'durasi_magang' => 'required|integer',
        ], [
            'required' => ':attribute wajib diisi',
            'date' => ':attribute harus berupa tanggal yang valid',
            'integer' => ':attribute harus berupa angka',
            'after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal mulai'
        ]);

        if ($validate->fails()) {
            return ResponseFormatter::error([
                'error' => $validate->errors()->all(),
            ], 'Validasi gagal', 402);
        }

        $data = PeriodeService::getById($id);
        if (!$data['status']) {
            return ResponseFormatter::error($data['errors'], 'Gagal memperbarui data', 404);
        }

        $periode = $data['data'];
        $periode->update($payload);
        return ResponseFormatter::success($periode, 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datadihapus = PeriodeService::getById($id);
        $data = PeriodeService::delete($id);
        if (!$data['status']) {
            $errorCode = $data['errors'] == 'Periode tidak ditemukan' ? 404 : 400;
            return ResponseFormatter::error([
                'errors' => $data['errors'],
            ], 'Gagal menghapus data', $errorCode);
        }

        return ResponseFormatter::success($data['data'], $datadihapus , 'Data berhasil dihapus');
    }
}
