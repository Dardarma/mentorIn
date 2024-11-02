<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Materi_mentoring;
use App\Models\Todo;
use App\Models\User;
use App\Services\Transaction\HasilService;
use App\Services\Transaction\JadwalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    //show jadwal
    public function index(Request $request)
    {
        $sort_field = $request->input('sort_field', 'created_at');
        $sort_order = $request->input('sort_order', 'desc');
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 10);

        $jadwal = JadwalService::getAllPaginate($page, $per_page, $sort_field, $sort_order);
        return ResponseFormatter::success($jadwal["data"], 'Get data successful');
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

    public function getbyid($id)
    {
        $response = JadwalService::getById($id);

        if ($response['status']) {
            return ResponseFormatter::success($response['data'], 'Data retrieved successfully');
        } else {
            return ResponseFormatter::error(null, $response['errors'], 404);
        }
    }
    //update jadwal
    public function update(Request $request, string $id)
    {
        $payloadJadwal = [
            'tanggal_mentoring' => $request->input('tanggal_mentoring'),
            'jam_mentoring' => $request->input('jam_mentoring'),
            'user_id' => $request->input('user_id'),
            'mentor_id' => auth()->user()->user_id,
        ];
        $payloadTodo = [
            'todo' => $request->input('todo'),
            'tipe' => 'PRA',
        ];
        $payloadMateri = [
            'materi' => $request->input('materi'),
            'description' => $request->input('deskripsi'),
        ];
        $validate = Validator::make(array_merge($payloadJadwal, $payloadTodo, $payloadMateri), [
            'todo' => 'required|string',
            'tanggal_mentoring' => 'required|date',
            'jam_mentoring' => 'required',
            'user_id' => 'required|integer',
            'mentor_id' => 'required|integer',
            'materi' => 'required',
            'deskripsi' => 'string',
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
            $jadwal = Jadwal::where('id', $id)->first();
            if (empty($jadwal)) {
                DB::rollBack();
                return ResponseFormatter::error("Jadwal not found", 'update data unsuccessful', 404);
            }
            $todo = Todo::find($jadwal->todo_id);
            $materi = Materi_mentoring::find($jadwal->materi_id);
            if (empty($todo) || empty($materi)) {
                DB::rollBack();
                return ResponseFormatter::error("Todo or Materi not found", 'update data unsuccessful', 404);
            }

            // Update jadwal data
            $jadwal->update($payloadJadwal);
            $todo->update($payloadTodo);
            $materi->update($payloadMateri);


            DB::commit();
            return ResponseFormatter::success([
                'jadwal' => $jadwal,
                'todo' => $todo,
                'materi' => $materi
            ], 'update data successful');
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::error($th->getMessage(), 'update data unsuccessful', 500);
        }
    }

    public function destroy(string $id){
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
