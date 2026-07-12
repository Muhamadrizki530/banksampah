<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

@page{
    margin:15px;
}

body{
    font-family:DejaVu Sans,sans-serif;
    font-size:10px;
    color:#222;
    line-height:1.25;
}

.receipt{
    width:100%;
}

.shop{
    text-align:center;
    font-size:24px;
    font-weight:bold;
}

.subtitle{
    text-align:center;
    font-size:12px;
    color:#666;
    margin-bottom:15px;
}

.section{
    border:1px solid #ddd;
    padding:8px;
    margin-bottom:8px;
}

.section-title{
    font-size:13px;
    font-weight:bold;
    margin-bottom:8px;
    border-bottom:1px solid #ddd;
    padding-bottom:4px;
}

table{
    width:100%;
    border-collapse:collapse;
}

td{
    padding:4px 2px;
    vertical-align:top;
}

.right{
    text-align:right;
}

.center{
    text-align:center;
}

.bold{
    font-weight:bold;
}

.small{
    font-size:10px;
    color:#666;
}

.detail-table{
    margin-top:8px;
}

.detail-table th{
    border:1px solid #ddd;
    background:#f3f3f3;
    padding:8px;
    font-size:11px;
}

.detail-table td{
    border:1px solid #ddd;
    padding:8px;
}

.total-box{
    border-top:2px solid #000;
    border-bottom:2px solid #000;
    margin:15px 0;
    padding:10px 0;
}

.total-title{
    font-size:14px;
    font-weight:bold;
}

.total-point{
    font-size:28px;
    font-weight:bold;
}

.note{
    border:1px solid #ddd;
    padding:10px;
    margin-top:12px;
    font-size:11px;
    line-height:1.6;
}

.signature{
    width:100%;
    margin-top:15px;
    page-break-inside:avoid;
}

.signature td{
    width:50%;
    text-align:center;
}

.footer{
    text-align:center;
    margin-top:18px;
    font-size:10px;
    color:#555;
}

.footer{
    page-break-inside:avoid;
}

</style>

</head>

<body>

@php

$trx='TRX-'.$wasteTransaction->created_at->format('Ymd').'-'.str_pad($wasteTransaction->id,6,'0',STR_PAD_LEFT);

@endphp

<div class="receipt">

<div class="shop">
BANK SAMPAH DIGITAL
</div>

<div class="subtitle">
Bukti Transaksi Setor Sampah
</div>

<div class="section">

<div class="section-title">
INFORMASI TRANSAKSI
</div>

<table>

<tr>

<td>No. Transaksi</td>

<td class="right bold">

{{ $trx }}

</td>

</tr>

<tr>

<td>Tanggal</td>

<td class="right">

{{ $wasteTransaction->created_at->format('d F Y') }}

</td>

</tr>

<tr>

<td>Jam</td>

<td class="right">

{{ $wasteTransaction->created_at->format('H:i') }}

</td>

</tr>

<tr>

<td>Admin</td>

<td class="right">

{{ auth()->user()->name }}

</td>

</tr>

</table>

</div>

<div class="section">

<div class="section-title">

DATA NASABAH

</div>

<table>

<tr>

<td>Nama</td>

<td class="right bold">

{{ $wasteTransaction->user->name }}

</td>

</tr>

<tr>

<td>Email</td>

<td class="right">

{{ $wasteTransaction->user->email }}

</td>

</tr>

<tr>

<td>Poin Saat Ini</td>

<td class="right bold">

{{ number_format($wasteTransaction->user->current_point) }}

</td>

</tr>

</table>

</div>

<div class="page-break">

<div class="section">

<div class="section-title">
DETAIL SAMPAH
</div>

<table class="detail-table">

<thead>

<tr>

<th>Jenis Sampah</th>
<th>Kategori</th>
<th>Berat</th>
<th>Poin / Kg</th>
<th>Total Poin</th>

</tr>

</thead>

<tbody>

<tr>

<td>
{{ $wasteTransaction->wasteType->name }}
</td>

<td class="center">
{{ $wasteTransaction->wasteType->category }}
</td>

<td class="center">
{{ number_format($wasteTransaction->weight,2) }} Kg
</td>

<td class="center">
{{ number_format($wasteTransaction->wasteType->point_per_kg) }}
</td>

<td class="right bold">
{{ number_format($wasteTransaction->total_point) }}
</td>

</tr>

</tbody>

</table>

</div>

<div class="total-box">

<table>

<tr>

<td class="total-title">
TOTAL POIN
</td>

<td class="right total-point">
{{ number_format($wasteTransaction->total_point) }}
</td>

</tr>

</table>

</div>

<div class="note">

<b>Catatan</b>

<br><br>

Terima kasih telah melakukan transaksi setoran sampah di
<b>Bank Sampah Digital</b>.

<br><br>

Poin yang diperoleh telah otomatis ditambahkan ke akun nasabah dan
dapat digunakan untuk melakukan penukaran hadiah sesuai ketentuan
yang berlaku.

</div>

<table class="signature">

<tr>



</tr>

</table>

</div>

<div class="section">

<div class="section-title">
STATUS TRANSAKSI
</div>

<table>

<tr>

<td>Status</td>

<td class="right bold">

Berhasil

</td>

</tr>

<tr>

<td>Dicetak Pada</td>

<td class="right">

{{ now()->format('d F Y H:i') }}

</td>

</tr>

</table>

</div>

<div class="footer">

==================================================

<br><br>

<b>BANK SAMPAH DIGITAL</b>

<br>

Terima kasih telah melakukan setoran sampah.

<br>

Poin telah berhasil ditambahkan ke akun Anda.

<br><br>

Dokumen ini merupakan bukti transaksi resmi.

<br>

Harap simpan dokumen ini dengan baik.

<br><br>

==================================================

</div>

</div>

</body>

</html>