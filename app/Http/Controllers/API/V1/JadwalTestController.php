<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\Jadwal;
use App\Services\Transaction\JadwalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JadwalTestController extends Controller
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

        $data = JadwalService::dataAll($page, $per_page, $sort_field, $sort_order);
        return ResponseFormatter::success($data["data"], 'Get data successful');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = [
            'todo' => $request->input('todo'),
            'materi' => $request->input('materi'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_mentoring' => $request->input('tanggal_mentoring'),
            'jam_mentoring' => $request->input('jam_mentoring'),
            'user_id' => $request->input('user_id'),
            'mentor_id' => $request->input('mentor_id')
        ];
        $validate = Validator::make($payload, [
            'todo' => 'required|string',
            'tanggal_mentoring' => 'required|date',
            'jam_mentoring' => 'required',
            'user_id' => 'required|integer',
            'mentor_id' => 'required|integer',
            'materi' => 'required',
            'deskripsi' => 'string'
        ], [
            'required' => ':attribute harus diisi',
            'string' => ':attribute harus berupa string',
            'integer' => ':attribute harus berupa angka',
            'date' => ':attribute harus berupa tanggal yang valid'
        ], [
            'todo' => 'Tugas',
            'tanggal_mentoring' => 'Tanggal Mentoring',
            'jam_mentoring' => 'Jam Mentoring',
            'user_id' => 'ID User',
            'mentor_id' => 'ID Mentor',
            'materi' => 'Materi',
            'deskripsi' => 'Deskripsi'
        ]);

        if ($validate->fails()) {
            return ResponseFormatter::error([
                'error' => $validate->errors()->all(),
            ], 'validation failed', 402);
        }

        $data = JadwalService::create($payload);
        if (!$data['status']) {
            return ResponseFormatter::error($data['errors'], 'create data unsuccessful');
        }
        return ResponseFormatter::success($data['data'], 'create data successful');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payload = [
            'tanggal_mentoring' => $request->input('tanggal_mentoring'),
            'jam_mentoring' => $request->input('jam_mentoring'),
            'status' => $request->input('status')
        ];

        // Validation rules
        $validation_rules = [
            'tanggal_mentoring' => 'required|date',
            'jam_mentoring' => 'required|date_format:H:i',
            'status' => 'boolean'
        ];

        // Validation messages
        $validation_messages = [
            'tanggal_mentoring.required' => 'Tanggal Mentoring wajib diisi.',
            'tanggal_mentoring.date' => 'Tanggal Mentoring harus dalam format tanggal yang valid.',
            'jam_mentoring.required' => 'Jam Mentoring wajib diisi.',
            'jam_mentoring.date_format' => 'Jam Mentoring harus dalam format waktu yang valid (HH:MM).',
            'status.boolean' => 'status harus true atau false'
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $validation_rules, $validation_messages);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()->all(),
            ], 'validation failed', 402);
        }

        // Begin transaction
        DB::beginTransaction();
        try {
            // Find the jadwal by ID
            $jadwal = Jadwal::where('id', $id)->first();
            if (empty($jadwal)) {
                DB::rollBack();
                return ResponseFormatter::error("Jadwal not found", 'update data unsuccessful', 404);
            }

            // Update jadwal data
            $jadwal->update($payload);

            DB::commit();
            return ResponseFormatter::success($jadwal, 'update data successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::error($th->getMessage(), 'update data unsuccessful', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JadwalService::delete($id);
        if (!$data['status']) {
            $erroCode = $data['errors'] == 'Not Found' ? 404 : 400;
            return ResponseFormatter::error([
                'errors' => $data['errors'],
            ], 'delete data unsuccessful', $erroCode);
        }

        return ResponseFormatter::success($data['data'], 'Successfully delete data');
    }
}
