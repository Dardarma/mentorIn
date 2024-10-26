<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\Hasil_mentoring;
use App\Services\Transaction\HasilService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HasilController extends Controller
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

        $data = HasilService::getAllPaginate($page, $per_page, $sort_field, $sort_order);
        return ResponseFormatter::success($data["data"], 'Get data successful');
    }
    public function store(Request $request)
    {
        $payload = [
            'todo' => $request->input('todo'),
            'hasil' => $request->input('hasil'),
            'feedback' => $request->input('feedback'),
            'jadwal_id' => $request->input('jadwal_id')
        ];

        $validate = Validator::make($payload, [
            'hasil' => 'required|string',
            'todo' => 'required|string',
            'feedback' => 'string',
        ], [
            'required' => ':attribute isi lah bos',
            'string' => ':attribute harus bertipe data string'
        ], [
            'todo' => 'Tugas',
            'hasil' => 'Hasil',
            'feedback' => 'Feedback'
        ]);

        if ($validate->fails()) {
            return ResponseFormatter::error([
                'error' => $validate->errors()->all(),
            ], 'Validation failed', 402);
        }

        // Call HasilService to handle the data creation
        $data = HasilService::create($payload);

        if (!$data['status']) {
            return ResponseFormatter::error($data['errors'], 'Create data unsuccessful');
        }

        return ResponseFormatter::success($data['data'], 'Create data successful');
    }

    public function update(Request $request, string $id)
    {
        $payload = [
            'hasil' => $request->input('hasil'),
            'feedback' => $request->input('feedback')
        ];

        // Validation rules
        $validation_rules = [
            'hasil' => 'required|string',
            'feedback' => 'string',
            // 'todo' => 'required|string'
        ];

        // Validation messages
        $validation_messages = [
            'hasil.required' => 'hasilnya di isi lah bos',
            'hasil.string' => 'data tidak valid bro',
            'feedback.string' => 'data tidak valid bro'
            // 'todo.required' => 'todonya di isi lah bos',
            // 'todo.string' => 'data tidak valid bro',
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
            $hasil = Hasil_mentoring::where('id', $id)->first();
            if (empty($hasil)) {
                DB::rollBack();
                return ResponseFormatter::error("hasil not found", 'update data unsuccessful', 404);
            }

            // Update hasil data
            $hasil->update($payload);

            DB::commit();
            return ResponseFormatter::success($hasil, 'update data successful');
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
        $data = HasilService::delete($id);
        if (!$data['status']) {
            $erroCode = $data['errors'] == 'Not Found' ? 404 : 400;
            return ResponseFormatter::error([
                'errors' => $data['errors'],
            ], 'delete data unsuccessful', $erroCode);
        }

        return ResponseFormatter::success($data['data'], 'Successfully delete data');
    }
}
