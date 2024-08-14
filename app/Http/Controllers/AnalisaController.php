<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Dataset;
use App\Models\DatasetDetail;
use Illuminate\Support\Facades\DB;

class AnalisaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('kode')->get();
        $subkriteria = Subkriteria::join('kriteria', 'subkriteria.id_kriteria', '=', 'kriteria.id_kriteria')
            ->orderBy('subkriteria.id_subkriteria')->get();
        $subkriteria_target = Subkriteria::join('kriteria', 'subkriteria.id_kriteria', '=', 'kriteria.id_kriteria')
            ->where('kriteria.tipe', 2)
            ->orderBy('subkriteria.id_subkriteria')->get();

        return view('analisa', compact('kriteria', 'subkriteria', 'subkriteria_target'));
    }

    public function hitung(Request $request)
    {
        $kriteria = Kriteria::orderBy('kode')->get();
        $subkriteria_target = Subkriteria::join('kriteria', 'subkriteria.id_kriteria', '=', 'kriteria.id_kriteria')
            ->where('kriteria.tipe', 2)
            ->orderBy('subkriteria.id_subkriteria')->get();

        $subkriteria_user = [];
        foreach ($kriteria as $k) {
            if ($k->tipe == 1 && $request->has('kriteria_' . $k->id_kriteria)) {
                $subkriteria_user[$k->id_kriteria] = $request->input('kriteria_' . $k->id_kriteria);
            }
        }

        $datasets = Dataset::orderBy('kode')->get();

        // Further calculation logic
        // ...

        return view('analisa_hasil', compact('kriteria', 'subkriteria_target', 'subkriteria_user', 'datasets'));
    }
}