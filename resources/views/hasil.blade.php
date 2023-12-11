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
                        <th>Nama Alternatif</th>
                        <th>Maksimum</th>
                        <th>Minimum</th>
                        <th>Nilai Yi</th>
                        <th>Rangking</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($perangkingan as $item)
                        <tr>
                            @foreach ($item as $i)
{{--                                if not string--}}
                                @if(!is_string($i))
                                    <td>{{ number_format($i, 4) }}</td>
                                @else
                                    <td>{{ $i }}</td>
                                @endif
                            @endforeach
                            <td>{{ $loop->iteration }}</td>
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
