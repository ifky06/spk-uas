<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $alternatif_kriteria = AlternatifKriteria::all();
        $alternatifKriteriaGrouped = $alternatif_kriteria->groupBy(['id_alternatif', 'id_kriteria']);
        $subKriteria = SubKriteria::all();
        return view('alternatif')
            ->with('alternatif', $alternatif)
            ->with('kriteria', $kriteria)
            ->with('alternatif_kriteria', $alternatif_kriteria)
            ->with('alternatifKriteriaGrouped', $alternatifKriteriaGrouped)
            ->with('subKriteria', $subKriteria);
    }


    public function store(Request $request)
    {
        $newAlternatifId = Alternatif::create($request->all())->id;
        $kriteria = Kriteria::all();
        foreach ($kriteria as $k) {
            AlternatifKriteria::create([
                'id_alternatif' => $newAlternatifId,
                'id_kriteria' => $k->id,
                'value' => 1
            ]);
        }

        return redirect('alternatif')
            ->with('success', 'Alternatif berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = Alternatif::find($id);
        $data->delete();

        return redirect('alternatif')
            ->with('success','Alternatif berhasil dihapus');
    }
}
