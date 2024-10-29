<?php

namespace App\Services\Transaction;

use App\Helpers\ResponseFormatter;
use App\Models\Jadwal;
use App\Models\Materi_mentoring;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JadwalService{
    /**
     * return model query
     *
     * @param  null
     * @return object query model
     */
    public static function dataAll()
    {
        $data = Jadwal::query()
        ->with('user:user_id,name')
        ->with('hasil:id,hasil,todo_id,feedback,jadwal_id')
        ->with('todo:id,todo,tipe_todo')
        ->with('materi:id,materi')
        ->get();
        return [
            'status' => true,
            'data' => $data
        ];
    }
    public static function getAllPaginate(/*$filter = []*/ $page = 1, $per_page = 10, $sort_field = 'created_at', $sort_order = 'desc')
    {
        $query = Jadwal::query();
        $data = $query->paginate($per_page, ['*'], 'page', $page)->appends('per_page', $per_page);
        return [
            'status' => true,
            'data' => $data,
        ];
    }

    /**
     * create new jadwal
     *
     * @param  array $payload
     * @return array status and warning
     */
    public static function create($payload)
    {
        DB::beginTransaction();
        try {
            $materi = Materi_mentoring::create([
                'materi' => $payload['materi'],
                'description' => $payload['deskripsi']
            ]);
            $todo = Todo::create([
                'todo' => $payload['todo'],
                'tipe_todo' => 'PRA',
            ]);
            $hasil = Jadwal::create([
                'tanggal_mentoring' => $payload['tanggal_mentoring'],
                'jam_mentoring' => $payload['jam_mentoring'],
                'status' => false,
                'todo_id' => $todo->id,
                'user_id' => $payload['user_id'],
                'mentor_id' => $payload['mentor_id'],
                'materi_id' => $materi->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::commit();
            return [
                'status' => true,
                'data'   => $hasil,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'status' => false,
                'errors' => $th->getMessage(),
            ];
        }
    }

    public static function getById($id): array
    {
        try {
            $data = Jadwal::where("id", $id)->first();
            return [
                'status' => true,
                'data'   => $data,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'errors' => $th->getMessage(),
            ];
        }
    }

    /**
     * edit jadwal
     *
     * @param  mixed $payload
     * @param  mixed $id
     * @return array
     */
    public static function edit(array $payload, $id): array
    {
        DB::beginTransaction();
        try {
            $data = Jadwal::where('id', $id)->first();
            if (empty($data)) {
                return [
                    'status' => false,
                    'errors' => "not found",
                ];
            } else{
                $update_data = [
                    'tanggal_mentoring' => $payload['tanggal_mentoring'],
                    'jam_mentoring' => $payload['jam_mentoring'],
                    'status' => $payload['status']
                ];
                $data->update($update_data);
                DB::commit();
                return [
                    'status' => true,
                    'data'   => $data,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'status' => false,
                'errors' => $th->getMessage(),
            ];
        }
    }

    /**
     * delete jadwal
     *
     * @param  mixed $id
     * @return array
     */
    public static function delete($id): array
    {
        DB::beginTransaction();
        try {
            $data = Jadwal::where('id', $id)->first();
            if (empty($data)) {
                return [
                    'status' => false,
                    'errors' => "not found",
                ];
            }
            $data->delete();

            DB::commit();
            return [
                'status' => true,
                'data'   => true,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'status' => false,
                'errors' => $th->getMessage(),
            ];
        }
    }
}