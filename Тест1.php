<?php
// session_start();
// if (!isset($_SESSION["hash"])) {
// 	header("Location: Тест.php"); exit();
// }
?>
<head>
	<meta charset="UTF-8">
	<title>ГПН</title>
	<link rel="stylesheet" href="params.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
	<div id="main">
		<div>
			<button id="containercall" >
			  Месторождение
			</button>
		</div>
		<div id="allbox">
			<div>   
		    	<button id="box1">Буровая установка БУ 4000/250ЭК-БМ</button>
		    </div>
				<div id="obor1">
			        <div id="nasos1"><span>Насос УНБТ-950А2, м3/ч: </span><span id="nasos_value1"></span></div>
			        <div id="lebedka1"><span>Лебедка ЛБУ - 1100, кВт: </span><span id="lebedka_value1"></span></div>
			        <div id="rastvor1"><span>Объем раствора циркуляционной системы, м3: </span><span id="rastvor_value1"></span></div>
				</div>
			<div>
				<button id="box2">Буровая БУ 500/320ЭК-БМЧ</button>
		    </div>
		        <div id="obor2">
			        <div id="nasos2"><span>Насос УНБТ-1180L: </span><span id="nasos_value2"></span></div>
			        <div id="lebedka2">Лебедка ЛБУ 1500-АС1, кВт: </span><span id="lebedka_value2"></span></div>
			        <div id="rastvor2"><span>Объем раствора циркуляционной системы, м3: </span><span id="rastvor_value2"></span></div>
		        </div>
		</div>
	</div>
	
	<div id="chart">
		<div id="curve_chart" style="width: 900px; height: 400px"></div>
	</div>
	
	<!-- Подключаем скрипт -->
	<script src="/ГПН/script.js"></script>
	<!-- Отправка запроса параметров и получение обратного ответа -->
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(start());

		//let get_params_button = document.querySelector('#get_params');

		function requestSender() {
			let nasos1 = document.querySelector('#nasos_value1');
			let nasos1value = getRandomArbitrary(42, 46);
			nasos1.textContent= nasos1value;
			nasos1.style.color = nasos1value<44? "red":"green";
		
			let lebedka1 = document.querySelector('#lebedka_value1');
			let lebedka1value = getRandomArbitrary(806, 810);
			lebedka1.textContent=lebedka1value;
			lebedka1.style.color = lebedka1value<807? "red":"green";
		
			let rastvor1 = document.querySelector('#rastvor_value1');
			let rastvor1value = getRandomArbitrary(300, 305);
			rastvor1.textContent=rastvor1value;
			rastvor1.style.color = rastvor1value<302? "red":"green";
		
			let sum1 = (nasos1value < 44? nasos1value*0.5:nasos1value) + (lebedka1value < 807? lebedka1value*0.5:lebedka1value)/18 + (rastvor1value < 302? rastvor1value*0.5:rastvor1value)/7;
		
			let nasos2 = document.querySelector('#nasos_value2')
			let nasos2value = getRandomArbitrary(96, 102);
			nasos2.textContent=nasos2value;
			nasos2.style.color = nasos2value<99? "red":"green";
		
			let lebedka2 = document.querySelector('#lebedka_value2');
			let lebedka2value = getRandomArbitrary(1500, 1510);
			lebedka2.textContent=lebedka2value;
			lebedka2.style.color = lebedka2value<1505? "red":"green";
		
			let rastvor2 = document.querySelector('#rastvor_value2');
			let rastvor2value = getRandomArbitrary(179, 183);
			rastvor2.textContent=rastvor2value;
			rastvor2.style.color = rastvor2value<181? "red":"green";
			
			let sum2 = (nasos2value < 99? nasos2value*0.5:nasos2value)/2 + (lebedka2value < 1505? lebedka2value*0.5:lebedka2value)/280 + (rastvor2value < 181? rastvor2value*0.5:rastvor2value)/3.6;
			ToExecute(sum1, sum2);
		};

		
	
		function sleep(ms) {
			return new Promise(
				resolve => setTimeout(resolve, ms)
			);
		}

		async function start(){
			while(true){
				await sleep(2000);
				requestSender();
				
			}
		}

		function ToExecute(point1, point2){
			var a = [
			['Дата', 'БУ 4000/250ЭК-БМ', 'БУ 500/320ЭК-БМЧ', 'Глубина прохождения в сутки'],
			['1 января',  0, 0, 0],
			['2 января',  (point1 / 3), (point2 / 3), 50],
			]; 
			drawChart(a);
		}

		function getRandomArbitrary(min, max) {
				return Math.round(Math.random() * (max - min) + min);
			}

		function drawChart(a) {
			var data = google.visualization.arrayToDataTable(a);

			var options = {
			title: 'Ежедневная глубина скважины',
			curveType: 'function',
			legend: { position: 'bottom' }
			};

			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

			chart.draw(data, options);
		}
	</script>
</body>
