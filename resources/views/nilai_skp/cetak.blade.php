<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <style>
        .tb-border {
            border: 1px solid black;
            padding: 5px;
            line-height: 25px;
        }
    </style>
</head>
<body>
<table style="width: 100%;">
    <tr>
        <td><img src="{{ \Str::replace('https', 'http', asset('assets/img/logo.png')) }}" style="width: 75px;"></td>
        <td style="text-align: center">
            <h3>PENILAIAN KINERJA PEGAWAI<br>RSJD
                SURAKARTA<br>BULAN {{ \Str::upper(\Carbon\Carbon::parse($data['bulan_dan_tahun'])->isoFormat('MMMM')) }}
                TAHUN {{ \Carbon\Carbon::parse($data['bulan_dan_tahun'])->format('Y') }}</h3>
        </td>
        <td style="text-align: right"><img src="{{ \Str::replace('https', 'http', asset('assets/media/logos/logo-rs.jpg')) }}" style="width: 80px;">
        </td>
    </tr>
</table>
<table style="width: 100%; margin-top: 20px;">
    <tr>
        <td style="width: 20%;">NAMA</td>
        <td>:</td>
        <td>{{ $nilai->user->full_name }}</td>
    </tr>
    <tr>
        <td style="width: 20%;">NIP</td>
        <td style="width: 1%;">:</td>
        <td>{{ $nilai->user->nip }}</td>
    </tr>
    <tr>
        <td style="width: 20%;">JABATAN</td>
        <td style="width: 1%;">:</td>
        <td>{{ $nilai->user->jabatan }}</td>
    </tr>
    <tr>
        <td style="width: 20%;">UNIT KERJA</td>
        <td style="width: 1%;">:</td>
        <td>{{ $nilai->user->unit->nama }}</td>
    </tr>
</table>
<table style="border-collapse: collapse; width: 100%; text-align: center; margin-top: 10px;">
    <tr style="background-color: lightgray;">
        <td class="tb-border" style="width: 4%; font-weight: bold;">A</td>
        <td class="tb-border" style="text-align: left; font-weight: bold;" colspan="5">KINERJA</td>
    </tr>
    <tr>
        <td class="tb-border">No</td>
        <td class="tb-border">Hasil Kerja</td>
        <td class="tb-border">Indikator</td>
        <td class="tb-border">Target</td>
        <td class="tb-border">Realisasi</td>
        <td class="tb-border">Nilai Hasil Kerja</td>
    </tr>
    @foreach($nilai->penilaian_kinerja as $key => $kinerja)
        <tr>
            <td class="tb-border">{{ $key+1 }}</td>
            <td class="tb-border" style="text-align: left">{{ $kinerja->hasil_kinerja }}</td>
            <td class="tb-border" style="text-align: left">{{ $kinerja->indikator }}</td>
            <td class="tb-border">{{ $kinerja->target }}</td>
            <td class="tb-border">{{ $kinerja->realisasi }}</td>
            <td class="tb-border" style="width: 12%">
                <img style="width: 14px;" src="{{ $kinerja->nilai_hasil_kerja
                        ? \Str::replace('https', 'http', asset('assets/icon/thump-up.jpg'))
                        : \Str::replace('https', 'http', asset('assets/icon/thump-down.jpg')) }}">
            </td>
        </tr>
    @endforeach
</table>
<p style="font-weight: bold">Rating Kinerja : {{ $nilai->rating_kinerja }}</p>
<table style="border-collapse: collapse; width: 100%; text-align: center; margin-top: 10px;">
    <tr style="background-color: lightgray;">
        <td class="tb-border" style="width: 4%; font-weight: bold;">B</td>
        <td class="tb-border" style="text-align: left; font-weight: bold;" colspan="3">PERILAKU KERJA</td>
    </tr>
    @foreach($nilai->penilaian_perilaku_kerja as $key => $perilaku)
        <tr>
            <td class="tb-border">{{ $key+1 }}</td>
            <td class="tb-border"
                style="text-align: left; width: 25%;">{{ $perilaku->perilaku_kerja->core_values }}</td>
            <td class="tb-border" style="text-align: left">{!! $perilaku->perilaku_kerja->details !!}</td>
            <td class="tb-border" style="width: 12%">
                <img style="width: 14px;" src="{{ $perilaku->nilai_hasil_kerja
                        ? \Str::replace('https', 'http', asset('assets/icon/thump-up.jpg'))
                        : \Str::replace('https', 'http', asset('assets/icon/thump-down.jpg')) }}">
            </td>
        </tr>
    @endforeach
</table>
<p style="font-weight: bold">Rating Perilaku Kerja : {{ $nilai->rating_perilaku_kerja }}</p>
<p style="font-weight: bold">Predikat Penilaian Kinerja : {{ $nilai->predikat_penilaian_kerja }}</p>
<table style="width: 100%; text-align: center; margin-top: 20px;">
    <tr>
        <td style="width: 50%;"></td>
        <td style="width: 50%;">{{ str()->title($data['lokasi']) }}, {{ \Carbon\Carbon::parse($data['tanggal_cetak'])->isoFormat('DD MMMM YYYY') }}</td>
    </tr>
    <tr>
        <td>Atasan Langsung</td>
        <td>Yang Bersangkutan</td>
    </tr>
    <tr>
        <td>{{ $nilai->user->atasan->jabatan }}</td>
        <td></td>
    </tr>
    <tr>
        <td><br><br><br><br></td>
        <td></td>
    </tr>
    <tr>
        <td>{{ $nilai->user->atasan->full_name }}</td>
        <td>{{ $nilai->user->full_name }}</td>
    </tr>
    <tr>
        <td>NIP. {{ $nilai->user->atasan->nip }}</td>
        <td>NIP. {{ $nilai->user->nip }}</td>
    </tr>
</table>
</body>
</html>
