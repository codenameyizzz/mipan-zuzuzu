<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Program Studi</th>
            <th>NIM</th>
            <th>Email</th>
            <th>Fakultas</th>
            <th>Angkatan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if (count($datas) == 0)
        <tr>
            <td colspan="8" class="text-center">Data tidak ditemukan</td>
        </tr>
        @endif
        @foreach ($datas as $data => $d)
        @php
            $user = $d->User;
        @endphp
        <tr>
            <td>{{ $data + $datas->firstitem() }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->Prodi->name }}</td>
            <td>{{ $d->nim }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $d->Fakultas->name }}</td>
            <td>{{ $d->angkatan }}</td>
            <td>
                @if (count($user->Responses) == 0)
                <span class="text-danger badge">Belum Mengisi</span>
                @else
                <span class="text-success badge">Sudah Mengisi</span>
                @endif
        </tr>
        @endforeach
    </tbody>
</table>
{{ $datas->links() }}
