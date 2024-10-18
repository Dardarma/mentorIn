<?php

namespace App\Services\Master;

use App\Models\MenuMaster;
use App\Models\Hasil_mentoring;
use App\Models\RoleMenu;
use App\Models\RolePermission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            $photo = '/storage/user_profile/default.png';
            if ($payload['path_photo'] != "") {
                $path_file = $payload['path_photo'];
                $explode_file = explode("/", $path_file);
                $name_file = $explode_file[3];

                $explode_name_file = explode(".", $name_file);
                $ext_file = $explode_name_file[1];
                if (Storage::disk('public')->exists('temporary_file/' . $name_file)) {
                    $name_file_new = "user_profile-" . Carbon::now()->format('Ymd_H_i_s') . "." . $ext_file;
                    $moved = 'public/user-profile/' . $name_file_new;
                    Storage::move('public/temporary_file/' . $name_file, $moved);
                    $url_foto = Storage::url($moved);
                }
                $photo = $url_foto;
            }

            $user = Hasil_mentoring::create([
                'id_materi' => $payload['id_materi'],
                'hasil_mentoring' => $payload['hasil_mentoring'],
                'path_photo' => $photo,
                'status' => "ENABLE",
                'fail_login_count' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => Auth::user()->user_id,
            ]);

            DB::commit();
            return [
                'status' => true,
                'data'   => $user,
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