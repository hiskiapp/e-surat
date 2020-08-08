<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Waktu Pengajuan</th>
            <th>Nomor Surat</th>
            <th>Nama</th>
            <th>Jenis Surat</th>
            <th>Waktu Penyetujuan</th>
            <th>Disetujui Oleh</th>
        </tr>
    </thead>
    <tbody>
        @foreach($submissions as $increment => $submission)
        <tr>
            <td>{{ $increment+1 }}</td>
            <td>{{ $submission->created_at->formatLocalized('%d %B %Y %H:%M') }}</td>
            <td>{{ $submission->number ?? '-' }}</td>
            <td>{{ $submission->user->name }}</td>
            <td>{{ $submission->letter->name }}</td>
            <td>{{ $submission->approval_at->formatLocalized('%d %B %Y %H:%M') }}</td>
            <td>{{ $submission->admin->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>