<style>


#columnchart_values {
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height:500px;
}
</style>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        $.ajax({
            
        })

      var data = google.visualization.arrayToDataTable([
        ["Secretaria", "Litros", { role: "style" } ],
				["<?php echo "Enero" ?>", <?php if(isset($enero)){echo $enero->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Febrero" ?>", <?php if(isset($febrero)){echo $febrero->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Marzo" ?>", <?php if(isset($marzo)){echo $marzo->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Abril" ?>", <?php if(isset($abril)){echo $abril->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Mayo" ?>", <?php if(isset($mayo)){echo $mayo->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Junio" ?>", <?php if(isset($junio)){echo $junio->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Julio" ?>", <?php if(isset($julio)){echo $julio->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Agosto" ?>", <?php if(isset($agosto)){echo $agosto->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Septiembre" ?>", <?php if(isset($septiembre)){echo $septiembre->litros;}else{echo "0";} ?>, "orange"],
        ["<?php echo "Octubre" ?>", <?php if(isset($octubre)){echo $octubre->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Noviembre" ?>", <?php if(isset($noviembre)){echo $noviembre->litros;}else{echo "0";} ?>, "orange"],
				["<?php echo "Diciembre" ?>", <?php if(isset($diciembre)){echo $diciembre->litros;}else{echo "0";} ?>, "orange"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Litros cargados por mes",
        width: 1100,
        height: 900,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
	
  </script>

<div class="panel panel-primary" style="border-color: black; width: 50%; margin-left: 23% ">
				<div class="panel-body clearfix">
					<div class="row" >
						<div class="col-md-12 col-sm-12 col-xs-12">
							<form method="POST" action="<?php echo base_url()?>Ticket/litrosPorSec">
								<div class="row">
									
									<!-- <div class=" col-md-4 col-sm-12 col-xs-12 ">
										<label>Desde:</label>
										<input type="date" class="form-control" value="<?php if(ISSET($fechadesde)){echo $fechadesde; }?>"  name="desde" required="required">
									</div>
									<div class="col-md-4 col-sm-12 col-xs-12 ">
										<label>Hasta:</label>
										<input type="date" class="form-control" value="<?php if(ISSET($fechadesde)){echo $fechahasta; }?>" name="hasta" required="required">
									</div> -->
									<div class="col-md-4 col-sm-12 col-xs-12 ">
										<label>Secretaria </label>
									<select name="secretaria" id="secretaria" class="form-control">
									<option selected value="0">SELECCIONAR:</option>
											<option value="1">SECRETARIA DE GOBIERNO Y COORDINACION</option>
											<option value="2">SECRETARIA DE ECONOMIA Y FINANZAS</option>
											<option value="3">SECRETARIA DE TURISMO, CULTURA Y DEPORTES</option>
											<option value="4">SECRETARIA DE DESARROLLO URBANO AMBIENTAL</option>
											<option value="5">SECRETARIA DE SALUD PUBLICA</option>
											<option value="6">SECRETARIA DE DESARROLLO SOCIAL, EDUCACION, GENERO Y DIVERSIDAD</option>
									</select>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 ">
									<label>Seleccione Año:</label>
									<select name="ano_filtro" id="ano_filtro" class="form-control">
									<option selected value="2020">SELECCIONAR:</option>
									<option  value="2020">2020</option>
									<option  value="2021">2021</option>
									<option  value="2022">2022</option>
									</select>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 " align="center">
										<br>
										<button class="btn btn-primary">Consultar</button>
										<input class="btn btn-success" type="button" onclick="printDiv('imprimir')" value="Imprimir" />
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php if(isset($sec)){ ?>

				<?php 
					$litros=0;
					if(isset($enero)){
						$mes1= $enero->litros;
					}else{
						$mes1=0;
					}
					if(isset($febrero)){
						$mes2= $febrero->litros;
					}else{
						$mes2=0;
					}

					if(isset($marzo)){
						$mes3= $marzo->litros;
					}else{
						$mes3=0;
					}
					if(isset($abril)){
						$mes4= $abril->litros;
					}else{
						$mes4=0;
					}
					if(isset($mayo)){
						$mes5= $mayo->litros;
					}else{
						$mes5=0;
					}
					if(isset($junio)){
						$mes6= $junio->litros;
					}else{
						$mes6=0;
					}
					if(isset($julio)){
						$mes7= $julio->litros;
					}else{
						$mes7=0;
					}
					if(isset($agosto)){
						$mes8= $agosto->litros;
					}else{
						$mes8=0;
					}
					if(isset($septiembre)){
						$mes9= $septiembre->litros;
					}else{
						$mes9=0;
					}
					if(isset($octubre)){
						$mes10= $octubre->litros;
					}else{
						$mes10=0;
					}
					if(isset($noviembre)){
						$mes11= $noviembre->litros;
					}else{
						$mes11=0;
					}
					if(isset($diciembre)){
						$mes12= $diciembre->litros;
					}else{
						$mes12=0;
					}

					
				$litros=$mes1+$mes2+$mes3+$mes4+$mes5+$mes6+$mes7+$mes8+$mes9+$mes10+$mes11+$mes12
				
					?>
<div id="imprimir">
			<div class="container">
    <div class="row">
        <div class=" col-md-10 col-sm-12 col-xs-12">
				<h3 style="margin-left: 20%;">Litros totales <?php echo $litros; echo "<br>"; echo "En la secretaria de: ";echo $sec; echo "<br>"; echo "En el año: "; echo $ano ?> </h3> <br>
				</div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12">
				
        <div id="chart_wrap">
        <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
        </div></div>
    </div>
</div>
			<?php }else{ ?>
				<div align="center">
				<h3>Debe seleccionar una secretaria para ver resultados.</h3>
				</div>
			<?php } ?>




<script>
	function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
</script>

  
