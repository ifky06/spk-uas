@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kriteria</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"></i>Data Kriteria</h3>
                <button type="button" class="btn btn-sm btn-success ml-auto" data-toggle="modal" data-target="#exampleModal">
                    + Tambah Data
                </button>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-hover custom-table">
                    <thead>
                    <tr>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>C{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_kriteria }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                @if ($item->jenis == 1)
                                    Cost
                                @else
                                    Benefit
                                @endif
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#modalUpdate"
                                        onclick="updateKriteria({{ $item }})" class="btn btn-warning">Edit
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteKrtButton" onclick="setKriteria({{ $item }})">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
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
                            <form action="{{ url('kriteria') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama"
                                           placeholder="Masukkan nama kriteria" name="nama_kriteria">
                                </div>
                                <div class="form-group">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" step="0.01" class="form-control" id="bobot"
                                           placeholder="Bobot" name="bobot">
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis (Centang untuk Cost)</label>
                                    <input type="checkbox" class="form-control" id="jenis" placeholder="Benefit/Cost"
                                           name="jenis">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal for update --}}
            <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Tambah Kriteria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('kriteria') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="updateKriteriaId" name="id">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="updateKriteriaName"
                                           placeholder="Masukkan nama kriteria" name="nama_kriteria">
                                </div>
                                <div class="form-group">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" step="0.01" class="form-control" id="updateKriteriaBobot"
                                           placeholder="Bobot" name="bobot">
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis (Centang untuk Cost)</label>
                                    <input type="checkbox" class="form-control" id="updateKriteriaJenis"
                                           placeholder="Benefit/Cost" name="jenis">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal for delete --}}
            <div class="modal fade" id="deleteKrtButton" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titleDeleteKriteria">Hapus Kriteria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus data?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="" method="POST" id="deleteKriteria">
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
        // kriteria hold the value of kriteria in json format
        let kriteria = null;

        function updateKriteria(kriteria) {
            kriteria = kriteria;
            $('#updateKriteriaId').val(kriteria.id);
            $('#updateKriteriaName').val(kriteria.nama_kriteria);
            $('#updateKriteriaBobot').val(kriteria.bobot);
            if (kriteria.jenis == 1) {
                $('#updateKriteriaJenis').prop('checked', true);
            } else {
                $('#updateKriteriaJenis').prop('checked', false);
            }
            // change the action url
            $('#modalUpdate form').attr('action', '{{ url('kriteria') }}/' + kriteria.id);
            console.log(kriteria);
        }

        function deleteKriteria(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kriteria ini?')) {
                var form = document.createElement('form');
                form.action = '{{ url('kriteria') }}/' + id;
                form.method = 'POST';
                form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' + '{{ csrf_field() }}';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
    <script>
        function setKriteria(newKriteria) {
            kriteria = newKriteria;

            // ganti action form dari tag dengan deleteKriteria
            console.log(kriteria)
            $('#deleteKriteria').attr('action', '{{ url('kriteria') }}/' + kriteria.id)

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
@endpush
