<?php

namespace App\Services\Transaction;

use App\Models\Hasil_mentoring;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HasilService
{
    /**
     * return model query
     *
     * @param  null
     * @return object query model
     */
    public static function dataAll()
    {
        return Hasil_mentoring::query();
    }
    public static function getAllPaginate(/*$filter = []*/ $page = 1, $per_page = 10, $sort_field = 'created_at', $sort_order = 'desc')
    {
        $query = Hasil_mentoring::query();
        $data = $query->paginate($per_page, ['*'], 'page', $page)->appends('per_page', $per_page);
        return [
            'status' => true,
            'data' => $data,
        ];
    }

    /**
     * create new user
     *
     * @param  array $payload
     * @return array status and warning
     */
    public static function create($payload)
    {
        DB::beginTransaction();
        try {
            $todo = Todo::create([
                'todo' => $payload['todo'],
                'tipe_todo' => 'PAST',
            ]);
            $hasil = Hasil_mentoring::create([
                'id_materi' => $payload['id_materi'],
                'hasil_mentoring' => $payload['hasil_mentoring'],
                'feedback' => $payload['feedback'],
                'jadwal_id' => $payload['jadwal_id'],
                'todo_id' => $todo->id,
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
    public static function getByJadwalId($jadwal_id): array
    {
        try {
            $data = Hasil_mentoring::with(['todo' => function ($query) {
                $query->where('tipe_todo', 'past');
            }])->where('jadwal_id', $jadwal_id)->first();

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
}
