<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function getByKelas($id)
    {
        try {
            $mapel = Jadwal::where('kelas_id', $id)
                ->join('mata_pelajarans', 'jadwals.mata_pelajaran_id', '=', 'mata_pelajarans.id')
                ->select('mata_pelajarans.id', 'mata_pelajarans.nama_mapel')
                ->distinct()
                ->get();

            return response()->json($mapel);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}