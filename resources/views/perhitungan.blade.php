@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Perhitungan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Menampilkan Bobot -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Bobot</h3>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        @foreach ($kriteria as $item)
                            <th>{{ $item->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kriteria as $item)
                        <td>{{ $item->bobot }}</td>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </section>

    <!-- Table Keputusan -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Matrix Keputusan</h3>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-hover custom-table text-center">
                    <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        @foreach ($kriteria as $krt)
                            <th>C{{ $loop->iteration }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($alternatif as $item)
                        <tr>
                            <td>{{ $item->nama_alternatif }}</td>
                            @foreach ($kriteria as $krt)
                                <td>
                                    @php
                                        $ak = $alternatifKriteriaGrouped[$item->id][$krt->id] ?? null;
                                    @endphp

                                    @if ($ak)
                                        {{ $ak[0]->value }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </section>

    <!-- Table Normalisasi matriks keputusan -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Normalisasi Matriks Keputusan</h3>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-hover custom-table text-center">
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        @foreach ($av as $item_av)--}}
{{--                            <th>AV{{ $loop->iteration }}</th>--}}
{{--                        @endforeach--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
                    <tbody>
                    @foreach ($normalisasiMatriksKeputusan as $item)
                        <tr>
                            @foreach ($item as $i)
                                <td>{{ number_format($i, 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </section>

    <!-- Table Optimasi Nilai Atribut-->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Optimasi Nilai Atribut</h3>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-hover custom-table">
                    <tbody>
                    @foreach ($optimasiNilaiAtribut as $item)
                        <tr>
                            @foreach ($item as $i)
                                <td>{{ number_format($i, 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Nilai Yi</h3>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-hover custom-table">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Maksimum</th>
                            <th>Minimum</th>
                            <th>Nilai Yi</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($nilaiYi as $item)
                            <tr>
                                @foreach ($item as $i)
                                    {{--                                if not string--}}
                                    @if(!is_string($i))
                                        <td>{{ number_format($i, 4) }}</td>
                                    @else
                                        <td>{{ $i }}</td>
                                    @endif
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </section>

    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
    </style>

    <script></script>
@endsection

@push('css')
@endpush

@push('scripts')
@endpush
