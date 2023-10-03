            @extends('templates.layout')

            @push('style')
            @endpush

            @section('content')
                <section class="content">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengajuan Barang</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalFormPengajuan">
                                Tambah Pengajuan
                            </button>
                            <a href="{{ route('pdfpengajuan') }}" target="_blank" class="btn btn-danger">
                                <i class="fa fa-file-pdf"></i>PDF
                            </a>
                            <a href="{{ route('exportpengajuan') }}" class="btn btn-success">
                                <i class="fa fa-file-excel"></i>Export
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#formImport">
                                <i class="fas fa-file-excel">Import</i>
                            </button>
                            <div class="mt-3">
                                @include('pengajuan.data')
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    @include('pengajuan.form')
                    <!-- /.card -->
                    @include('pengajuan.modal')
                </section>
            @endsection
            @push('script')
                <script>
                    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
                        $('.alert-success').slideUp(500)
                    })
                    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
                        $('.alert-danger').slideUp(500)
                    })
                    console.log($('.delete-data'))
                    $('.delete-data').on('click', function(e) {
                        e.preventDefault()
                        const data = $(this).closest('tr').find('td:eq(1)').text()
                        Swal.fire({
                            title: `Apakah data <span style="color:red">${data}</span> akan dihapus?`,
                            text: "Data tidak bisa dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus data ini!'
                        }).then((result) => {
                            if (result.isConfirmed)
                                $(e.target).closest('form').submit()
                            else swal.close()
                        })
                    })
                    $('#modalFormPengajuan').on('show.bs.modal', function(e) {
                        const btn = $(e.relatedTarget)
                        console.log(btn.data('mode'))
                        const mode = btn.data('mode')
                        const nama_pengajuan = btn.data('nama_pengajuan')
                        const nama_barang = btn.data('nama_barang')
                        const tanggal_pengajuan = btn.data('tanggal_pengajuan')
                        const qty = btn.data('qty')
                        const id = btn.data('id')
                        const modal = $(this)
                        // console.log($(this))
                        if (mode === 'edit') {
                            modal.find('.modal-title').text('Edit Data Pengajuan')
                            modal.find('#nama_pengajuan').val(nama_pengajuan)
                            modal.find('#nama_barang').val(nama_barang)
                            modal.find('#tanggal_pengajuan').val(tanggal_pengajuan)
                            modal.find('#qty').val(qty)
                            modal.find('.modal-body form').attr('action', '{{ url('pengajuan') }}/' + id)
                            modal.find('#method').html('@method('PATCH')')
                            console.log(nama_pengajuan)
                            console.log(tanggal_pengajuan)
                        } else {
                            modal.find('.modal-title').text('Input Data Pengajuan')
                            modal.find('#nama_pengajuan').val('')
                            modal.find('#nama_barang').val('')
                            modal.find('#tanggal_pengajuan').val('')
                            modal.find('#qty').val('')
                            modal.find('#method').html('')
                            modal.find('.modal-body form').attr('action', '{{ url('pengajuan') }}')
                        }
                    })
                </script>
            @endpush
