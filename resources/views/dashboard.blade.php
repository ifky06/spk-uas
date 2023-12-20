@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</h3>
            </div>
            <div class="card-body">
                <h4>Tentang Metode MOORA</h4>
                <p>Metode MOORA (Multi-Objective Optimization by Ratio Analysis) adalah metode yang digunakan untuk
                    menyelesaikan permasalahan multi-objektif. Metode ini mengubah semua objektif menjadi objektif
                    tunggal dengan menggunakan pendekatan rasio. Metode MOORA dapat digunakan untuk menyelesaikan
                    permasalahan multi-objektif yang bersifat kualitatif maupun kuantitatif.</p>
                <ul class="">
                    <li class="mt-1">Metode MOORA diperkenalkan oleh Brauers dan
                        Zavadkas pada tahun 2006.</li>
                    <li class="mt-1">Metode ini diterapkan untuk memecahkan
                        masalah dengan perhitungan matematika yang
                        kompleks.</li>
                    <li class="mt-1">Metode MOORA memiliki tingkat fleksibilitas dan
                        kemudahan untuk dipahami dalam memisahkan
                        bagian subjektif dari suatu proses evaluasi
                        kedalam kriteria bobot keputusan dengan
                        beberapa atribut pengambilan keputusan.</li>
                    <li class="mt-1">Memiliki tingkat selektifitas yang baik karena
                        dapat menentukan tujuan dari kriteria yang
                        bertentangan.</li>
                    <li class="mt-1">Memiliki tingkat selektifitas yang baik karena
                        dapat menentukan tujuan dari kriteria yang
                        bertentangan.</li>
                    <li class="mt-1">Di mana kriteria dapat bernilai
                        menguntungkan (benefit) atau yang tidak
                        menguntungkan (cost).</li>
                </ul>

                <h4>Tahapan Metode MOORA</h4>
                <ul class="">
                    <li class="mt-1">Menentukan nilai kriteria, bobot kriteria dan
                        alternatif</li>
                    <li class="mt-1">Merubah nilai kriteria menjadi matriks
                        keputusan.</li>
                    <img src="{{ asset('assets/image/1.png') }}" alt="Matriks Keputusan"
                         class="img-fluid" style="height: 100px">
                    <li class="mt-1">Normalisasi pada metode MOORA</li>
                    <img src="{{ asset('assets/image/2.png') }}" alt="Matriks Keputusan"
                         class="img-fluid" style="height: 100px">
                    <li class="mt-1">Mengurangi nilai maximax dan minmax</li>
                    <img src="{{ asset('assets/image/3.png') }}" alt="Matriks Keputusan"
                         class="img-fluid" style="height: 100px">
                    <li class="mt-1">Menentukan rangking dari hasil perhitungan
                        MOORA.</li>
                </ul>
            </div>
            <!-- /.card -->

    </section>
@endsection

@push('css')

@endpush

@push('scripts')

    {{--    <script>--}}
    {{--        alert('Selamat Datang');--}}
    {{--    </script>--}}

@endpush
