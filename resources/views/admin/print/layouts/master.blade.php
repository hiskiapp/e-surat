<!DOCTYPE html>
<html
	xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<link rel="stylesheet" href="{{ asset('assets/letter/base.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('assets/letter/fancy.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('assets/letter/main.css') }}"/>
		<script src="{{ asset('assets/letter/compatibility.min.js') }}"></script>
		<script src="{{ asset('assets/letter/theViewer.min.js') }}"></script>
		<script>
		try{
			theViewer.defaultViewer = new theViewer.Viewer({});
		}catch(e){}
	</script>
		<title></title>
	</head>
	<body>
		<div id="sidebar">
			<div id="outline"></div>
		</div>
		<div id="page-container">
			<div id="pf1" class="pf w0 h0" data-page-no="1">
				<div class="pc pc1 w0 h0">
					<img class="bi x0 y0 w1 h1" alt="" src="{{ asset('assets/letter/bg1.png') }}"/>
					<div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0">PEMERINTAH KABUPATEN GIANYAR</div>
					<div class="t m0 x2 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0">KECAMATAN PAYANGAN</div>
					<div class="t m0 x3 h3 y3 ff2 fs0 fc0 sc0 ls0 ws0">DESA BRESELA</div>
					<div class="t m0 x4 h4 y4 ff2 fs1 fc0 sc0 ls0 ws0"> Alamat : Jln Raya  Bresela, Kode Pos : 80572 , Telp : (0361) 9081598</div>

					@yield('content')

					<div class="t m0 xa h5 y1c ff1 fs2 fc0 sc0 ls0 ws0"></div>
					<div class="t m0 xb h5 y1d ff1 fs2 fc0 sc0 ls0 ws0"></div>
					<div class="c xc y1e w2 h6">
						<div class="t m0 xd h5 y1f ff1 fs2 fc0 sc0 ls0 ws0">Bresela, 17 April 2020</div>
						<div class="t m0 xe h5 y20 ff1 fs2 fc0 sc0 ls0 ws0">Perbekel Bresela</div>
						<div class="t m0 xf h5 y21 ff1 fs2 fc0 sc0 ls0 ws0"></div>
						<div class="t m0 x10 h5 y22 ff1 fs2 fc0 sc0 ls0 ws0">I Wayan Dirka</div>
						<div class="t m0 x11 h5 y23 ff1 fs2 fc0 sc0 ls0 ws0"></div>
					</div>
				</div>
				<div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
			</div>
		</div>
		<div class="loading-indicator"></div>
	</body>
</html>
