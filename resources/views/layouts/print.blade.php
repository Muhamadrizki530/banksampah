<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title','Struk Bank Sampah')</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f4f6f9;
    font-family:'Inter',sans-serif;
    color:#1e293b;
    padding:30px;
}

.receipt{
    width:100%;
    max-width:850px;
    margin:auto;
    background:#fff;
    border-radius:18px;
    border:1px solid #e5e7eb;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.receipt-header{
    padding:22px 28px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #ececec;
}

.brand{
    display:flex;
    align-items:center;
    gap:15px;
}

.brand-icon{
    width:58px;
    height:58px;
    border-radius:14px;
    background:#2563eb;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.brand h3{
    margin:0;
    font-size:24px;
    font-weight:700;
}

.brand p{
    margin:2px 0 0;
    color:#64748b;
    font-size:14px;
}

.status{
    background:#dcfce7;
    color:#15803d;
    padding:10px 18px;
    border-radius:999px;
    font-weight:600;
    font-size:14px;
}

.receipt-body{
    padding:26px;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
    margin-bottom:20px;
}

.info-box{
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:18px;
}

.info-box h5{
    font-size:15px;
    margin-bottom:14px;
    font-weight:700;
}

.info-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
}

.info-row:last-child{
    margin-bottom:0;
}

.info-row span{
    color:#64748b;
}

.section-title{
    font-weight:700;
    margin-bottom:14px;
}

.summary{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:18px;
    margin-top:20px;
}

.note-box,
.point-box{
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:18px;
}

.point-box{
    text-align:center;
}

.point-box small{
    color:#64748b;
}

.point-box h1{
    font-size:42px;
    color:#2563eb;
    margin:6px 0;
    font-weight:700;
}

.signature{
    margin-top:28px;
    padding-top:20px;
    border-top:1px solid #e5e7eb;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
    text-align:center;
}

.signature p{
    margin-bottom:45px;
    color:#64748b;
}

.receipt-action{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top:25px;
}

@media print{

@page{
    size:A4;
    margin:10mm;
}

body{
    background:#fff;
    padding:0;
}

.receipt{
    max-width:100%;
    border:none;
    border-radius:0;
    box-shadow:none;
}

.receipt-action{
    display:none;
}

.point-box h1{
    font-size:34px;
}

.info-grid{
    gap:12px;
}

.summary{
    gap:12px;
}

.signature{
    margin-top:18px;
    padding-top:15px;
}

}

</style>

</head>

<body>

@yield('content')

</body>

</html>