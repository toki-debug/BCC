<?php
//WebScraping_v1.1
//Arissa Yoshida :D


//URL DO SITE
$url = 'http://ti.saude.rs.gov.br/covid19/';
$html='';
//PEGANDO CONTEUDO
$dadosSite = file_get_contents($url);
$dia1 = explode('</small><br /><small>',$dadosSite);
$dia2 = explode('</small></div> <a href="download"',$dia1[1]);
$hosp1 = explode('es</div> <div class="row no-gutters align-items-center"><div class="col-auto"> <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">',$dadosSite);
$hosp2 = explode('</div></div><div class="col">',$hosp1[1]);
$array1 =explode('Confirmados</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$array2 = explode('<small class="text-xs text-danger">',$array1[1]);
$incidencia1=explode('ncia</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$incidencia2 =explode('<small class="text-xs">',$incidencia1[1]);
$obitos1=explode('bitos</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$obitos2 =explode('<small class="text-xs text-danger">',$obitos1[1]);
$letalidade1 = explode('Letalidade aparente</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$letalidade2 = explode('<small class="text-xs">%</small>',$letalidade1[1]);

//Testes
$test = 0;

$teste1=explode('RT-PCR</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$teste2 =explode('</div></div><div class="col mr-2">',$teste1[1]);
$teste2 = str_replace(".", "", $teste2);
$teste[0] = (int) $teste2[0];
$teste3=explode('pido</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$teste4 =explode('</div></div><div class="col mr-2">',$teste3[1]);
$teste4	= str_replace(".", "", $teste4);
$teste[1] = (int) $teste4[0];
$teste5=explode('>Outros</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$teste6 =explode('</div></div><div class="col mr-2">',$teste5[1]);
$teste6 = str_replace(".", "", $teste6);
$teste[2] = (int) $teste6[0];
$teste7=explode('gico</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$teste8 =explode('</div></div></div><b class="text-danger p-2">',$teste7[1]);
$teste8 = str_replace(".", "", $teste8);
$teste[3] = (int) $teste8[0];
$teste9=explode('Total</div> <div class="h5 mb-0 font-weight-bold text-gray-800">',$dadosSite);
$teste10 =explode('</div></div></div><b class="text-danger p-2">',$teste9[1]);
$teste10 = str_replace(".", "", $teste10);
$teste[4] = (int) $teste10[0];
//$html .='<table border="0">';
for ($i = 0; $i <= 4; $i++) {
	//$html .= '<th>'.$teste[$i].'</th>';
	$test += (int)$teste[$i];
	}
//$html .= '</table>';



$faixa1 = explode('GraphFaixaEtaria_labels = [',$dadosSite);
$faixa2 = explode('];GraphFaixaEtaria_values',$faixa1[1]);
$faixa_etaria1 = explode('GraphFaixaEtaria_values = [',$dadosSite);
$faixa_etaria2 = explode ('];GraphFaixaEtariaObitos_values',$faixa_etaria1[1]);
$nome1 = explode('rus RS </h1><small>Base de dados: ',$dadosSite);
$nome2 = explode ('</small><br /><small>Painel atualizado',$nome1[1]);


$nome3 = (explode(" ",$nome2[0]));
$string1 = (explode(",",$faixa2[0]));
$string2 = (explode(",",$faixa_etaria2[0]));

$html .='<table border="0">';
	//$html .= '<th>';

	$tam =0;
	$sum=0;
	//$html .= '<tr>';
	for ($i = 7; $i <= 11; $i++) {
				$sum+=(int) $string2[$i];
				if($i==11){
				/*$html .= '<td>'.'0-19'.'</td>';
				$html .= '<td>'.$sum.'</td>';*/
				$val[$tam] = $sum;
				$tam++;
				}
	}
	//$html .= '</tr>';

	/*$html .= '<td>'.'20-29'.'</td>';
	$html .= '<td>'.$string2[6].'</td>';*/
	$val[$tam] = (int) $string2[6];
	$tam++;
	$sum=0;
	//$html .= '<tr>';
	for ($i = 3; $i <= 5; $i++) {
				$sum+=(int) $string2[$i];
				if($i==5){
				/*$html .= '<td>'.'30-59'.'</td>';
				$html .= '<td>'.$sum.'</td>';*/
				$val[$tam] = $sum;
				$tam++;
				}
	}
	//$html .= '</tr>';

	$sum=0;

	//$html .= '<tr>';
	for ($i = 0; $i <= 2; $i++) {
				$sum+=(int) $string2[$i];
				if($i==2){
					/*$html .= '<td>'.'60+'.'</td>';
				$html .= '<td>'.$sum.'</td>';*/
				$val[$tam] = $sum;
				$tam++;
				}
	}
	//$html .= '</tr>';
	//$html .= '</th>';
	$html .= '</table>';


$html .='<table border="0">';
	$html .= $dia2[0];
	$html .= '<tr>';
	$html .= '<th>'.'Confirmados:'.'</th>';
	$html .= '<th>'.'Mortos:'.'</th>'; 
	$html .= '<th>'.'Hospitalizacoes:'.'</th>';
	$html .= '<th>'.'Incidencia:'.'</th>'; 
	$html .= '<th>'.'Letalidade:'.'</th>'; 
	$html .= '<th>'.'Data:'.'</th>';
	$html .= '<th>'.'Testes'.'</th>';
	$html .= '<th>'.'0-19'.'</th>';
	$html .= '<th>'.'20-29'.'</th>'; 
	$html .= '<th>'.'30-59'.'</th>';
	$html .= '<th>'.'60+'.'</th>';	
	$html .= '</tr>';
	$html .= '<tr>';
	$html .= '<td>'.$array2[0].'</td>';	
	$html .= '<td>'.$obitos2[0].'</td>';
	$html .= '<td>'.$hosp2[0].'</td>';
	$html .= '<td>'.$incidencia2[0].'</td>';
	$html .= '<td>'.$letalidade2[0].'</td>';
	$html .= '<td>'.$nome3[0].'</td>';
	$html .= '<td>'.$test.'</td>';
	for ($i = 0; $i < $tam; $i++) {
		$html .= '<td>'.$val[$i].'</td>';
	}
	$html .= '</tr>';
	
	/*
	$html .= '<tr>';
	$html .= '<th>'.'Confirmados por idade:'.'</th>';
	$html .= '</tr>';
	for ($i = 0; $i <= 11; $i++) {
	$html .= '<tr>';
    $html .= '<td>'.$string1[$i].'</td>';
	$html .= '<td>'.$string2[$i].'</td>';
	$html .= '</tr>';
	}
	*/
	$html .= '</table>';

$arquivo = $nome3[0].".xls";


// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

echo $html;

?>
