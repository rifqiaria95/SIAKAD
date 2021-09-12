<!DOCTYPE html>
<html>
<head>
	<title>Data Siswa SMK Ti Tunas Harapan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 10pt;
		}
	</style>
	<center>
		<h5>Data Siswa SMK Ti Tunas Harapan</h5>
	</center>

	<table class="table zero-configuration">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>Nilai Rata-Rata</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($siswa as $s)
            <tr>
                <td>{{ $i++}}</td>
                <td>{{ $s->nama_lengkap() }}</td>
                <td>{{ $s->jenis_kelamin }}</td>
                <td>{{ $s->agama }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->avg() }}</td>
            </tr>
            @endforeach
        </tbody>
	</table>

</body>
</html>