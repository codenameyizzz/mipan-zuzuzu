<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Quistionnaire</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if (count($datas) == 0)
        <tr>
            <td colspan="3" class="text-center">Data tidak ditemukan</td>
        </tr>
        @endif
        @foreach ($datas as $data => $d)
        @php
            $user = $d->User;
        @endphp
        <tr>
            <td>{{ $data + $datas->firstitem() }}</td>
            <td>{{ $d->title }}</td>
            <td>
                <a href="{{ route('data.edit-questionnaire', $d->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('data.delete-questionnaire', $d->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $datas->links() }}
