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
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $payload = [
            'tanggal_mentoring' => $request->input('tanggal_mentoring'),
            'jam_mentoring' => $request->input('jam_mentoring'),
            'user_id' => $request->input('user_id'),
            'mentor_id' => auth()->user()->user_id,
            'todo' => $request->input('todo'),
            'tipe' => 'PRA',
            'materi' => $request->input('materi'),
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status')
        ];
        $payload_hasil = [
            'hasil' => $request->input('hasil'),
            'feedback' => $request->input('feedback'),
            'todo_pst' => $request->input('todo_pst')
        ];
        $validate_hasil = Validator::make(array_merge($payload_hasil), [
            'hasil' => 'required|string',
            'feedback' => 'string',
            'todo_pst' =>  'required|string'
        ], [
            'required' => ':attribute harus diisi',
            'string' => ':attribute harus berupa string'
        ], [
            'hasil' => 'Hasil Mentoring',
            'feedback' => 'Feedback Mentoring',
            'todo_pst' => 'Todo',

        ]);
        $validate = Validator::make(array_merge($payload), [
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


        if ($validate->fails()||$validate_hasil->fails()) {
            return ResponseFormatter::error([
                'error' => $validate->errors()->all(),
            ], 'validation failed', 402);
        }
        $data = JadwalService::edit($payload, $payload_hasil, $id);
        if (!$data['status']) {
            return ResponseFormatter::error($data['errors'], 'create data unsuccessful');
        }
        return ResponseFormatter::success($data['data'], 'create data successful');
    }

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
    public function lastJadwal()
    {
        $last = JadwalService::lastMentoring();
        return ResponseFormatter::success($last["data"], 'data last jadwal');
    }

    public function mentoringThisMounth(){
        
        $userId = Auth::id();
        $data = Jadwal::where(function ($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhere('mentor_id', $userId);
        })
        ->whereMonth('tanggal_mentoring', Carbon::now()->month)
        ->whereYear('tanggal_mentoring', Carbon::now()->year)
        ->with('user:user_id,name') 
        ->get(['user_id']) 
        ->groupBy('user_id')
        ->map(function ($items) {
            $userName = $items->first()->user->name ?? 'Nama tidak ditemukan';
            return [
                'jumlah_jadwal' => $items->count(),
                'nama_user' => $userName,
            ];
        })->values();

        return ResponseFormatter::success($data);
      
    }

    public function notifikasi(){
        $userId = Auth::id();
        $besok = Carbon::now()->addDay()->format('Y-m-d');
        $data = Jadwal::where(function ($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhere('mentor_id', $userId);
        })
        ->where('tanggal_mentoring', $besok)
        ->select('id','jam_mentoring', 'user_id', 'mentor_id')
        ->with([
            'user:user_id,name',
            'mentor:user_id,name'
        ])
        ->get();

        if($data->isEmpty()){
            return ResponseFormatter::success(null, 'tidak ada jadwal untuk besok');
        }else{
            return ResponseFormatter::success($data, 'ada jadwal untuk besok');
        }
    }
}
