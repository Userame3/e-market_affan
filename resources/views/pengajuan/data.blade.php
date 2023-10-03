<table id="tbl-pengajuan" class="table table-compact table stripped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Pengajuan</th>
            <th>Nama Barang</th>
            <th>Tanggal Pengajuan</th>
            <th>QTY</th>
            <th>Terpenuhi</th>
            <th>Tools</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengajuan as $p)
        <tr>
            <td>{{ $i = !isset($i) ? ($i = 1) : ++$i }}</td>
            <td>{{ $p->nama_pengajuan }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->tanggal_pengajuan }}</td>
            <td>{{ $p->qty }}</td>
            <td>
                <!-- <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="{{ $p->id }}" @if ($p->terpenuhi) checked @endif>
                    <label class="form-check-label" for="{{ $p->id }}"></label>
                </div> -->
                @livewire('pengajuan-terpenuhi', ['model' => $p, 'field' => 'terpenuhi', key($p->id)])
            </td>
            <td>
                <button class="btn" data-toggle="modal" data-target="#modalFormPengajuan" data-mode="edit" data-id="{{ $p->id }}" data-nama_pengajuan="{{ $p->nama_pengajuan }}" data-nama_barang="{{ $p->nama_barang }}" data-tanggal_pengajuan="{{ $p->tanggal_pengajuan }}" data-qty="{{ $p->qty }}">
                    <i class="fas fa-edit text-success"></i>
                </button>
                <form method="post" action="{{ route('pengajuan.destroy', $p->id) }}" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn delete-data" data-nama_pengajuan="{{ $p->nama_pengajuan }}">
                        <i class="fas fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    // $(function() {
    //     $('#tbl-produk').DataTable()

    //     //dialog hapus data
    //     $('.btn-delete').on('click', function(e) {
    //         let nama_produk = $(this).closest('tr').find('')
    //     })
    // // })
</script>