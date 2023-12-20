@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Table Nilai Yi -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Hasil Perangkingan</h3>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-hover custom-table text-center">
                    <thead>
                    <tr>
                        <th>Rangking</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai Yi</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($perangkingan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item[0] }}</td>
                            <td>{{ number_format($item[3], 4) }}</td>

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
