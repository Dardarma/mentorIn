<?php

namespace App\Services;

use App\Models\Periode;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PeriodeService
{
    /**
     * Mengembalikan query model dasar untuk Periode
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function dataAll()
    {
        return Periode::query();
    }

    /**
     * Mengambil semua data Periode dengan paginasi
     *
     * @param int $page
     * @param int $per_page
     * @param string $sort_field
     * @param string $sort_order
     * @return array
     */
    public static function getAllPaginate($page = 1, $per_page = 10, $sort_field = 'created_at', $sort_order = 'desc')
    {
        $query = Periode::orderBy($sort_field, $sort_order);
        $data = $query->paginate($per_page, ['*'], 'page', $page)->appends('per_page', $per_page);
        return [
            'status' => true,
            'data' => $data,
        ];
    }

    /**
     * Membuat data Periode baru
     *
     * @param array $payload
     * @return array
     */
    public static function create($payload)
    {
        DB::beginTransaction();
        try {
            $periode = Periode::create([
                'tanggal_mulai' => $payload['tanggal_mulai'],
                'tanggal_akhir' => $payload['tanggal_akhir'], // Menggunakan tanggal_akhir
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            DB::commit();
            return [
                'status' => true,
                'data' => $periode,
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
     * Mengambil data Periode berdasarkan ID
     *
     * @param int $id
     * @return array
     */
    public static function getById($id): array
    {
        try {
            $data = Periode::find($id);
            if (!$data) {
                return [
                    'status' => false,
                    'errors' => 'Periode tidak ditemukan',
                ];
            }
            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'errors' => $th->getMessage(),
            ];
        }
    }

    /**
     * Memperbarui data Periode berdasarkan ID
     *
     * @param array $payload
     * @param int $id
     * @return array
     */
    public static function update(array $payload, $id): array
    {
        DB::beginTransaction();
        try {
            $data = Periode::find($id);
            if (!$data) {
                return [
                    'status' => false,
                    'errors' => "Periode tidak ditemukan",
                ];
            }
            $data->update([
                'tanggal_mulai' => $payload['tanggal_mulai'],
                'tanggal_akhir' => $payload['tanggal_akhir'] // Menggunakan tanggal_akhir
            ]);
            DB::commit();
            return [
                'status' => true,
                'data' => $data,
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
     * Menghapus data Periode berdasarkan ID
     *
     * @param int $id
     * @return array
     */
    public static function delete($id): array
    {
        DB::beginTransaction();
        try {
            $data = Periode::find($id);
            if (!$data) {
                return [
                    'status' => false,
                    'errors' => "Periode tidak ditemukan",
                ];
            }
            $data->delete();
            DB::commit();
            return [
                'status' => true,
                'data' => true,
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
