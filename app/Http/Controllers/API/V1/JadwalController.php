<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use App\Services\Transaction\HasilService;
use App\Services\Transaction\JadwalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    //show jadwal
    public function index()
    {
        $jadwal = JadwalService::dataAll();
        $data = [
            'jadwal' => $jadwal['data']
        ];
        return ResponseFormatter::success($data, 'get data successfull');
    }

    //mengambil user untuk dropdown 
    public function getUsersByRole()
    {
        $mentorId = auth()->id(); // Dapatkan ID mentor yang sedang login

        $users = User::where('mentor_id', $mentorId)->get(['user_id', 'name']); // Ambil user dengan mentor_id sesuai ID mentor

        return response()->json($users);
    }

    //create new jadwal
    public function store(Request $request)
    {
        $payload = [
            'todo' => $request->input('todo'),
            'materi' => $request->input('materi'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_mentoring' => $request->input('tanggal_mentoring'),
            'jam_mentoring' => $request->input('jam_mentoring'),
            'user_id' => $request->input('user_id'),
            'mentor_id' => auth()->user()->user_id
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
    
    //update jadwal
    public function update(Request $request, string $id)
    {
        $payload = [
            'todo' => $request->input('todo'),
            'materi' => $request->input('materi'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_mentoring' => $request->input('tanggal_mentoring'),
            'jam_mentoring' => $request->input('jam_mentoring'),
            'user_id' => $request->input('user_id'),
            'mentor_id' => auth()->user()->user_id
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

}
