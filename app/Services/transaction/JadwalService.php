<?php

namespace App\Services\Transaction;

use App\Helpers\ResponseFormatter;
use App\Models\Hasil_mentoring;
use App\Models\Jadwal;
use App\Models\Materi_mentoring;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalService
{
    /**
     * return model query
     *
     * @param  null
     * @return object query model
     */
    public static function dataAll()
    {
        $data = Jadwal::query();
        return [
            'status' => true,
            'data' => $data
        ];
    }
    public static function getAllPaginate(/*$filter = []*/$page = 1, $per_page = 10, $sort_field = 'created_at', $sort_order = 'desc')
    {
        $userId = Auth::id();
        $roleId = DB::table('user_roles')
            ->where('user_id', $userId)
            ->value('role_id');
        $query = Jadwal::query()
            ->where(function ($query) use ($roleId, $userId) {
                if ($roleId === 1) {
                    return;
                }
                $query->where('user_id', Auth::id())
                    ->orWhere('mentor_id', Auth::id());
            });
        if (!$query->exists()) {
            return [
                'status' => false,
                'data' => 'Data tidak ada',
            ];
        }
        $data = $query->with('user:user_id,name')
            ->with('hasil:id,hasil,todo_id,feedback,jadwal_id')
            ->with('hasil.todo:id,todo,tipe')
            ->with('todo:id,todo,tipe')
            ->with('materi:id,materi,description')
            ->orderBy($sort_field, $sort_order)
            ->paginate($per_page, ['*'], 'page', $page)
            ->appends('per_page', $per_page);

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
            $todo_pra = Todo::create([
                'todo' => $payload['todo'],
                'tipe' => 'PRA',
            ]);
            $hasil = Jadwal::create([
                'tanggal_mentoring' => $payload['tanggal_mentoring'],
                'jam_mentoring' => $payload['jam_mentoring'],
                'status' => false,
                'todo_id' => $todo_pra->id,
                'user_id' => $payload['user_id'],
                'mentor_id' => $payload['mentor_id'],
                'materi_id' => $materi->id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $todo_past = Todo::create([
                'todo' => 'belum ada hasil',
                'tipe' => 'PAST'
            ]);
            $hasil = Hasil_mentoring::create([
                'jadwal_id' => $hasil->id,
                'hasil' => 'belum ada hasil',
                'feedback' => 'belum ada feedback',
                'todo_id' => $todo_past->id
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
            $data = Jadwal::with(['todo', 'materi'])->where("id", $id)->first();
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
            }
            $todo = Todo::find($data->todo_id);
            $materi = Materi_mentoring::find($data->materi_id);
            if (empty($todo) || empty($materi)) {
                return [
                    'status' => false,
                    'errors' => "Todo or Materi not found",
                ];
            }
            //update todo
            $todo->update([
                'todo' => $payload['todo'],
                'tipe' => 'PRA'
            ]);
            DB::commit();
            //update materi
            $materi->update([
                'materi' => $payload['materi'],
                'description' => $payload['deskripsi'],
            ]);
            DB::commit();

            $update_data = [
                'tanggal_mentoring' => $payload['tanggal_mentoring'],
                'jam_mentoring' => $payload['jam_mentoring'],
                'status' => false,
                'todo_id' => $todo->id,
                'user_id' => $payload['user_id'],
                'mentor_id' => $payload['mentor_id'],
                'materi_id' => $materi->id,
            ];
            $data->update($update_data);
            DB::commit();
            return [
                'status' => true,
                'data'   => $data,
                'todo' => $todo,
                'materi' => $materi
            ];
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
            $todo = Todo::where('id', $data->todo_id)->first();
            $materi = Materi_mentoring::where('id', $data->materi_id)->first();
            if (empty($data)) {
                return [
                    'status' => false,
                    'errors' => "jadwal not found",
                ];
            }if(empty($todo)){
                return [
                    'status' => false,
                    'errors' => "todo not found",
                ];
            }if(empty($materi)){
                return [
                    'status' => false,
                    'errors' => "materi not found",
                ];
            }
            $data->delete();
            $todo->delete();
            $materi->delete();

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
