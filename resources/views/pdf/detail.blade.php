<!DOCTYPE html>
<html>
<head>
<style>

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  /* font-size: 14px */
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
  font-size: 14px
}

#customers td{
    font-size: 12px
}

.column{
    width: 30%;
}

</style>
</head>
<body>

<h3>Identitas Bayi</h3>

<table id="customers">
  <tr>
    <td class="column">Nama Bayi</td>
    <td>{{$identitas_bayi[0]->nama_bayi}}</td>
  </tr>
  <tr>
    <td>Tanggal Lahir Bayi</td>
    <td>{{$identitas_bayi[0]->tgl_lahir_bayi}}</td>
  </tr>
  <tr>
    <td>Jenis Kelamin Bayi</td>
    <td>{{$identitas_bayi[0]->jenis_kelamin}}</td>
  </tr>
  <tr>
    <td>No Akte Bayi</td>
    <td>{{$identitas_bayi[0]->no_akte_bayi}}</td>
  </tr>
  <tr>
    <td>Umur</td>
    <td>{{$identitas_bayi[0]->usia}}</td>
  </tr>
  <tr>
    <td>Nama Orang Tua</td>
    <td>{{$identitas_bayi[0]->nama_orangtua}}</td>
  </tr>
  <tr>
    <td>Alamat Orang Tua</td>
    <td>{{$identitas_bayi[0]->alamat}}</td>
  </tr>
</table>

<h3>Riwayat Pemeriksaan Terbaru</h3>

<table id="customers">
  <tr>
    <th>Tanggal Pemeriksaan</th>
    <th>Suhu (Celcius)</th>
    <th>Berat (Kg)</th>
    <th>Panjang (Cm)</th>
    <th>Z-Score</th>
    <th>Kondisi</th>
  </tr>
  <tr>
    <td>{{$last_inspection->tgl_pemeriksaan}}</td>
    <td>{{$last_inspection->suhu}}°C</td>
    <td>{{$last_inspection->panjang_badan}}Cm</td>
    <td>{{$last_inspection->berat}}Kg</td>
    <td>{{$last_inspection->zscore}}</td>
    <td>{{$last_inspection->kondisi}}</td>
  </tr>
  <tr>
    <td colspan="6">Saran Makanan :{!! $status['food_suggestions'] !!}</td>
  </tr>
</table>

<h3>Riwayat Pemeriksaan</h3>

<table id="customers">
  <tr>
    <th>Tanggal Pemeriksaan</th>
    <th>Suhu (Celcius)</th>
    <th>Berat (Kg)</th>
    <th>Panjang (Cm)</th>
    <th>Z-Score</th>
    <th>Kondisi</th>
  </tr>
    @foreach ($all_inspection as $item)
    <tr class="text-center">
        <td>{{$item->tgl_pemeriksaan}}</td>
        <td>{{$item->suhu}}C</td>
        <td>{{$item->berat}}Kg</td>
        <td>{{$item->panjang_badan}}Cm</td>
        <td>{{$item->zscore}}</td>
        <td>{{$item->kondisi}}</td>
    </tr>
    @endforeach
</table>
</body>
</html>


