<html>
<head>
	<title>Auction List Report</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>
<body>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding-top: 8px;
  padding-bottom: 8px;
  padding-left: 2px;
  padding-right: 2px;
}


#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: center;
  background-color: #000;

  color: white;
}
div.c {
  position: absolute;
  margin-top:20px;

 right: 0px;
  width: 200px;
  height: 120px;

} 
div.d {
  position: absolute;
  margin-top:20px;

 right: 0px;
  width: 200px;
  height: 120px;

}
#footer {
		position:absolute;
   bottom:0;

   text-align: right;
} 
</style>
	<center>
		<h1 style="margin-top: 10px; color: #000">Sneakers Auction List Report</h1>
			<h4 style="color: #000"> SMK NEGERI 2 CIMAHI</h4>
			<p style="color: #000"> AZRIEL FADILLAH JANUAR XII RPLA</p>
		     <hr  style="color: black;  width:100%; size:100%">
	</center>
 
	<h4 style="color: black">Auction Reports From Date {{date('d-m-Y', strtotime($from))}} To {{date('d-m-Y', strtotime($date2))}}	</h4>
    <div class="table-responsive">
	<table id="customers" style=" border-collapse: collapse;">
		<thead class="thead-light">
			<tr>
				<th>No</th>
				<th>Name Of Item</th>
				<th>Auction Winner</th>
				<th>Phone</th>
				<th>Date Auction</th>
				<th>Final Price</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			  @foreach($data as $p)
			<tr>
				<td><center>{{ $i++ }}</center></td>
				<td><center>{{$p->nama_barang}}</center></td>
				<td><center>{{$p->nama_lengkap}}</center></td>
				<td><center>{{$p->no_telp}}</center></td>
				<td><center>{{date('d-m-Y', strtotime($p->tanggal_ditutup))}}</center></td>
				<td>Rp. {{number_format($p->harga_akhir, 0, ".", ".")}}</td>
			</tr>
			@endforeach
		</tbody>

	</table>
	<h4 style="color: black;text-align: right;">Total : Rp. {{number_format($sum, 0, ".", ".")}} 	</h4>
	<footer id="footer">
		<div style="margin-right: 20px">
  <p style="text-align: right;">Cimahi ,{{date('d-F-Y', strtotime($datenow))}}</p>
  <p style="text-align: right;margin-top: 50px; margin-right: 40px"><a>Admin</a></p>
  </div>
</footer>

 </div>
</body>
</html>