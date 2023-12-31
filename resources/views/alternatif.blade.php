@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Alternatif</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Data Alternatif</h3>
                <button type="button" class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#exampleModal">
                    + Tambah Data
                </button>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover custom-table">
                    <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        @foreach ($kriteria as $krt)
                            <th>C{{ $loop->iteration }}</th>
                        @endforeach
                        <th>Aksi</th>
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
                            <td>
                                <button data-toggle="modal" data-target="#inputNilai"
                                        onclick='setAlternatif(@json($item), @json($kriteria), @json($subKriteria), @json($alternatifKriteriaGrouped))' class="btn btn-warning">Input
                                    Nilai</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteAltButton" onclick="deleteAlternatif({{ $item }})">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Alternatif</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('alternatif') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama Alternatif</label>
                                        <input type="text" class="form-control" id="nama"
                                               placeholder="Masukkan nama alternatif" name="nama_alternatif">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="inputNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <form action="{{ url('alternatif_kriteria') }}" method="POST">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <input name="nama_alternatif" class="modal-title form-control" id="namaAlternatif" value="">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                @csrf
                                <input name="id_alternatif" id="idAlternatif" type="hidden">
                            <div class="modal-body" id="addValueAlternatifKriteria">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Modal for delete --}}
            <div class="modal fade" id="deleteAltButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titleDeleteAlternatif">Hapus Alternatif</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus data?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="" method="POST" id="deleteAlternatif">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let alternatif;

        function setAlternatif(newAlternatif, kriteria, subKriteria, ak) {
            alternatif = newAlternatif;
            console.log(alternatif);
            // console.log(kriteria);
            // console.log(subKriteria);
            // set value form
            document.getElementById('namaAlternatif').value = alternatif.nama_alternatif;
            document.getElementById('idAlternatif').value = alternatif.id;
            var container = document.getElementById('addValueAlternatifKriteria');
            container.innerHTML = '';
            kriteria.forEach(function(krt) {
                container.innerHTML += generateKriteriaHTML(alternatif.id, krt, subKriteria, ak);
            });
        }

        function generateKriteriaHTML(idAlterinatif, kriteria, subKriteria, ak) {
            var html = '<div class="form-group">';
            html += '<label for="nama">' + kriteria.nama_kriteria + '</label>';
            html += '<select name="value[]" class="form-control">';

            // Filter subKriteria based on the current kriteria id
            var filteredSubKriteria = subKriteria.filter(function(sk) {
                return sk.id_kriteria === kriteria.id;
            });

            // Iterate over filtered subKriteria to create options
            filteredSubKriteria.forEach(function(sk) {
                // console.log(ak[idAlterinatif][kriteria.id][0].value);
                if (ak[idAlterinatif] === undefined || ak[idAlterinatif][kriteria.id][0].value !== sk.value ) {
                    html += '<option value="' + sk.value + '">' + sk.range_kriteria + '</option>';
                } else {
                    html += '<option value="' + sk.value + '" selected>' + sk.range_kriteria + '</option>';
                }
            });

            html += '</select>';
            html += '<input name="id[]" type="hidden" value="' + kriteria.id + '">';
            html += '</div>';
            return html;
        }

    </script>
    <script>
        function deleteAlternatif(newAlternatif) {
            alternatif = newAlternatif;

            // ganti action form dari tag dengan deleteSubForm
            console.log(alternatif)
            $('#deleteAlternatif').attr('action', '{{ url('alternatif') }}/' + alternatif.id)
        }
    </script>
    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
    </style>
@endsection

@push('css')
@endpush

@push('scripts')
    {{--    <script> --}}
    {{--        alert('Selamat Datang'); --}}
    {{--    </script> --}}
@endpush
