<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $alternatif_kriteria = AlternatifKriteria::all();
        $alternatifKriteriaGrouped = $alternatif_kriteria->groupBy(['id_alternatif', 'id_kriteria']);

        //matrix keputusan 2 dimensi
        $matriksKeputusan = $this->matriksKeputusan($alternatif, $kriteria, $alternatifKriteriaGrouped);
        $normalisasiMatriksKeputusan = $this->normalisasiMatrixKeputusan($alternatif, $kriteria, $matriksKeputusan);
        $optimasiNilaiAtribut = $this->optimasiNilaiAtribut($alternatif, $kriteria, $normalisasiMatriksKeputusan);
        $nilaiYi = $this->menentukanNilaiYi($alternatif, $kriteria, $optimasiNilaiAtribut);

        return view('perhitungan')
            ->with('alternatif', $alternatif)
            ->with('kriteria', $kriteria)
            ->with('alternatifKriteriaGrouped', $alternatifKriteriaGrouped)
            ->with('matriksKeputusan', $matriksKeputusan)
            ->with('normalisasiMatriksKeputusan', $normalisasiMatriksKeputusan)
            ->with('optimasiNilaiAtribut', $optimasiNilaiAtribut)
            ->with('nilaiYi', $nilaiYi);
    }

    public function hasil()
    {
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $alternatif_kriteria = AlternatifKriteria::all();
        $alternatifKriteriaGrouped = $alternatif_kriteria->groupBy(['id_alternatif', 'id_kriteria']);

        //matrix keputusan 2 dimensi
        $matriksKeputusan = $this->matriksKeputusan($alternatif, $kriteria, $alternatifKriteriaGrouped);
        $normalisasiMatriksKeputusan = $this->normalisasiMatrixKeputusan($alternatif, $kriteria, $matriksKeputusan);
        $optimasiNilaiAtribut = $this->optimasiNilaiAtribut($alternatif, $kriteria, $normalisasiMatriksKeputusan);
        $hasil= $this->menentukanNilaiYi($alternatif, $kriteria, $optimasiNilaiAtribut);
        $perangkingan = $this->perangkingan($hasil);

//        dd($perangkingan);


        return view('hasil')
            ->with('hasil', $hasil)
            ->with('perangkingan', $perangkingan);
//          ->with('p
    }

    public function reset() {
        Alternatif::query()->delete();
        kriteria::query()->delete();
        return redirect('/');
    }


    public function matriksKeputusan($alternatif, $kriteria, $alternatif_kriteria){
        $matriksKeputusan = [];
        foreach ($alternatif as $key => $value) {
            foreach ($kriteria as $key2 => $value2) {
                $matriksKeputusan[$key][$key2] = $alternatif_kriteria[$value->id][$value2->id][0]->value;
            }
        }
        return $matriksKeputusan;
    }

    public function normalisasiMatrixKeputusan($alternatif, $kriteria, $matriksKeputusan){
        $akarSigmaMXijkuadrat = [];
        foreach ($kriteria as $key => $value) {
            $sigmaMXijkuadrat = 0;
            foreach ($alternatif as $key2 => $value2) {
                $sigmaMXijkuadrat += pow($matriksKeputusan[$key2][$key], 2);
            }
            $akarSigmaMXijkuadrat[$key] = sqrt($sigmaMXijkuadrat);
        }

        $normalisasiMatrixKeputusan = [];
        foreach ($alternatif as $key => $value) {
            foreach ($kriteria as $key2 => $value2) {
                $normalisasiMatrixKeputusan[$key][$key2] = $matriksKeputusan[$key][$key2] / $akarSigmaMXijkuadrat[$key2];
            }
        }
        return $normalisasiMatrixKeputusan;
    }

    public function optimasiNilaiAtribut($alternatif, $kriteria, $normalisasiMatrixKeputusan){
        $optimasiNilaiAtribut = [];
        foreach ($alternatif as $key => $value) {
            foreach ($kriteria as $key2 => $value2) {
                $optimasiNilaiAtribut[$key][$key2] = $normalisasiMatrixKeputusan[$key][$key2] * $kriteria[$key2]->bobot;
            }
        }
        return $optimasiNilaiAtribut;
    }

    public function menentukanNilaiYi($alternatif, $kriteria, $optimasiNilaiAtribut){
        $hasil = [];
//        $maksimum = [];
//        $minimum = [];
        foreach ($alternatif as $key => $value) {
            $hasil[$key][0] = $alternatif[$key]->nama_alternatif;
            $max = 0;
            $min = 0;
            foreach ($kriteria as $key2 => $value2) {
                if (!$kriteria[$key2]->jenis) {
                    $max += $optimasiNilaiAtribut[$key][$key2];
                } else {
                    $min += $optimasiNilaiAtribut[$key][$key2];
                }
            }
            $hasil[$key][1] = $max;
            $hasil[$key][2] = $min;
//            $maksimum[$key] = $max;
//            $minimum[$key] = $min;
        }

        // menentukan nilai Yi
//        $nilaiYi = [];
        foreach ($alternatif as $key => $value) {
            $hasil[$key][3] = $hasil[$key][1] - $hasil[$key][2];
        }
        return $hasil;
    }

//    perangkingan menggunakan sorting berdasarkan nilai matriks kolom index 3
    public function perangkingan($hasil)
    {
        $perangkingan = $hasil;
//        descending
        usort($perangkingan, function ($a, $b) {
            return $b[3] <=> $a[3];
        });
        return $perangkingan;
    }
}
