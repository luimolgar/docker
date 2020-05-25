<?php
class html {

private static $etis=[];
private static $etis_simples=['BR','HR','IMG','INPUT'];
private static $col_rejilla=[];
private static $cont_rejilla=[];
private static $rejilla=NULL;
private static $acordeon=NULL;
private static $acordeones=[];
private static $open_acordeon=[];
private static $cont_acordeon=[];
private static $cont_etis=[];
private static $id_captcha='********** CLAVE PUBLICA RECAPTCHA DE GOOGLE *********';
private static $sin_id=['BR','HR','TBODY','TR','LABEL', 'EM','I','STRONG','HEADER'];
const TABULADOR="\t";
private static $tabuladores=0;
private static $sw_sangria=false;
private static $sin_sangria=['A','EM','I','STRONG','SPAN','SMALL','U','INS'];
private static $aumentan_sangria=['ARTICLE','SECTION','ASIDE','DIV','FORM','UL','TBODY','TR','TABLE','BLOCKQUOTE','ADDRESS'];
private static $css_estados=['primary','success','info','warning','danger','default'];
private static $css_alerts=['','ok-sign','info-sign','question-sign','exclamation-sign'];
private static $css_tablas=['','bordered','striped','hover','condensed'];
private static $css_inputs=['email'=>'glyphicon-envelope','text'=>'glyphicon-font','password'=>'glyphicon-asterisk','date'=>'glyphicon-calendar','color'=>'glyphicon-tint','time'=>'glyphicon-time', 'url'=>'glyphicon-link', 'number'=>'glyphicon-sound-5-1'];
private static $css_lineas=['border-top: 1px solid;','border-top: 3px double;', 'border-top: 2px dashed;','border-top: 1px dotted;','height: 10px; border: 0; box-shadow: 0 10px 10px -10px inset;','height: 0; border: 0;'];
private static $css_videos=['16by9','4by3'];

static private function aumenta_sangria($eti) {
	if(self::$sw_sangria):
		if(in_array($eti,self::$aumentan_sangria)) self::$tabuladores++;
	endif;
}

static private function reduce_sangria($eti) {
	if(self::$sw_sangria):
		if(in_array($eti,self::$aumentan_sangria))  self::$tabuladores--;
	endif;
}

static private function sangria($eti, $es_cierre=false) {
	if(self::$sw_sangria):
		if($es_cierre):
			return (in_array($eti,self::$aumentan_sangria))? self::valor_sangria():'';
		else:
			return (in_array($eti,self::$sin_sangria))? '':self::valor_sangria();
		endif;
	else:
		return '';
	endif;
}

static private function valor_sangria() {
	return ((self::$tabuladores>0)? str_repeat(self::TABULADOR,self::$tabuladores):'');
}

static private function salto_cierre($eti) {
	$salto='';
	if(self::$sw_sangria):
		if(!in_array($eti,self::$sin_sangria)) $salto=PHP_EOL;
	endif;
	return $salto;
}

static private function salto_apertura($eti) {
	if(self::$sw_sangria):
		$con_salto=array_merge(self::$aumentan_sangria,self::$etis_simples);
		if(in_array($eti,$con_salto)) echo PHP_EOL;
	endif;
}

static private function open_eti($eti) {
	array_push(self::$etis,$eti);
}

static public function close_eti($ncierres=1, $vacia=false)  {
  for($i=0;$i<$ncierres;$i++):
	if(($eti=array_pop(self::$etis))):
		$salto='';
		$sangria='';
		if(!$vacia):
		 	self::reduce_sangria(strtoupper($eti));
			$sangria=self::sangria(strtoupper($eti),true);
		endif;
		$salto=self::salto_cierre(strtoupper($eti));
		echo "$sangria</$eti>$salto";
	endif;
  endfor;
}

static private function quita_espacios($cadena) {
	$cadena=trim($cadena);
	return preg_replace('/\s+/',' ',$cadena);
}

static private function id_eti($eti) {
		if(self::key($eti,self::$cont_etis)):
				self::$cont_etis[$eti]++;
		else:
			self::$cont_etis[$eti]=1;
		endif;
		return $eti.'_'.self::$cont_etis[$eti];
}

static private function valor_key($key, $datos=[]) {
	return (isset($datos[$key])? $datos[$key]:'');
}

static private function key($key, $datos=[]){
	$estado=false;
	if(array_key_exists($key,$datos)) {
		if(strlen($datos[$key])) {
			$estado=true;
		}
	} 
	return $estado;
}

static public function activa_sangrado($estado=true) {
	self::$sw_sangria=$estado;
	if(!$estado) self::$tabuladores=0;
}

static public function eti_html($datos=[], $autocierre=true) {
	$eti=((self::key('eti',$datos))? $datos['eti']:'P');
	if($eti==='#') { echo self::valor_key('contenido',$datos); return; }
	$contenido=((self::key('contenido',$datos))? $datos['contenido']:'');
	$clase=((self::key('clase',$datos))? ('class="'.$datos['clase'].'"'):'');
	$titulo=((self::key('titulo',$datos))? ('title="'.$datos['titulo'].'"'):'');
	$atributos=((self::key('atributos',$datos))? $datos['atributos']:'');
	$id=((self::key('id',$datos))? $datos['id']:self::id_eti($eti));
	$txt_id=((!in_array(strtoupper($eti),self::$sin_id))? 'id="'.$id.'"':'');
	if(self::key('noid',$datos)) $txt_id='';	
	$eti_simple=in_array(strtoupper($eti),self::$etis_simples);	
	if(!$eti_simple) self::open_eti($eti); 
	$sangria=self::sangria(strtoupper($eti));
	echo $sangria.'<'.self::quita_espacios("$eti $txt_id $atributos $clase $titulo").(($eti_simple)? ' />':'>').$contenido;
	if($eti_simple):
		self::salto_apertura(strtoupper($eti));
	elseif($autocierre):
	 	self::close_eti(1,(strlen($contenido)==0));
	else:
		self::aumenta_sangria(strtoupper($eti));
		self::salto_apertura(strtoupper($eti));
	endif;
	return $id;
}

static public function parrafo($texto='',$alineacion=3,$aumentar=false) {
	$alineaciones=['text-left','text-center','text-right','text-justify'];
	if(!is_numeric($alineacion)) $alineacion=3;
	if(!($alineacion>=0 && $alineacion<count($alineaciones))) $alineacion=3;
	$clase=$alineaciones[$alineacion].(($aumentar)? ' lead':'');
	if(empty($texto)): 	
		self::eti_html(['eti'=>'P','clase'=>$clase,'noid'=>true],false);
	else:
		self::eti_html(['eti'=>'P','contenido'=>$texto,'clase'=>$clase,'noid'=>true]);
	endif;
}

static public function texto($texto) {
	if(empty($texto)) return;
	self::eti_html(['contenido'=>$texto, 'eti'=>'#']);
}

static public function citabloque($texto,$pie='',$derecha=false) {
	static $contador=0;
	if(empty($texto)) return;
	$id='CITABLOQUE_'.$contador++;
	$clase=(($derecha)? 'blockquote-reverse':'');
	self::eti_html(['eti'=>'BLOCKQUOTE','clase'=>$clase, 'id'=>$id],false);
	self::parrafo($texto);
	if(!empty($pie)) {
		self::eti_html(['eti'=>'FOOTER','contenido'=>$pie]);
	}
	self::close_eti();
	return $id;
}

static public function datoscontacto($datos=[]) {
	static $contador=0;
	if(empty($datos)) return;
	$id='DIRECCION_'.$contador++;
	self::eti_html(['eti'=>'ADDRESS','id'=>$id],false);
	foreach($datos as $campo => $valor):
		if(self::$sw_sangria) echo self::valor_sangria();
		echo '<strong>'.$campo.'</strong>: <em>'.$valor.'</em><br />';
		if(self::$sw_sangria) echo PHP_EOL;		
	endforeach;
	self::close_eti();
	return $id;
}

static public function titulo($titulo, $nivel=1, $clase='') {
	if(empty($titulo)) return;
	if(!is_numeric($nivel)) $nivel=1;
	if(!($nivel>=1 && $nivel<=5)) $nivel=1;
	self::eti_html(['eti'=>'H'.$nivel,'contenido'=>$titulo, 'clase'=>$clase, 'noid'=>1]);
}

static public function div($datos=[],$cerrar=false) {
	if(!is_array($datos)) {
		$args['clase']=$datos;
		$args['eti']='DIV';
		$datos=$args;		
	} else {
		$datos['eti']='DIV';
	}
	return(self::eti_html($datos,$cerrar));
}

static private function div_clear() {
	self::div('clearfix',true);
}

static public function alerta($texto, $estilo=1) {
	static $contador=0;
	if(empty($texto)) return;
	if(!is_numeric($estilo)) $estilo=1;
	if(!($estilo>=1 && $estilo<5)) $estilo=1;
	$id='ALERTA_'.$contador++;
	$clase='alert alert-dismissible alert-'.self::$css_estados[$estilo];
	self::div(['clase'=>$clase,'atributos'=>'role="alert"','id'=>$id]);
	self::boton(['clase'=>'close','atributos'=>'data-dismiss="alert"','texto'=>'x']);
	self::parrafo();
	$clase='glyphicon glyphicon-'.self::$css_alerts[$estilo];	
	self::eti_html(['eti'=>'SPAN', 'clase'=>$clase, 'atributos'=>'aria-hidden="true"']);
	self::texto(' '.$texto);
	self::close_eti(2);
	return $id;
}

static public function linea($estilo=0) {
	if(!is_numeric($estilo)) $estilo=0;
	if(!($estilo>=0 && $estilo<count(self::$css_lineas))) $estilo=0;
	self::eti_html(['eti'=>'HR','atributos'=>'style="'.self::$css_lineas[$estilo].'"']);
}

static public function enlace($datos=[]) {
	$datos['eti']='A';
	$href='href="'.((self::key('href',$datos))? $datos['href']:'#').'"';
	$target=((self::key('target',$datos))? 'target="'.$datos['target'].'"':'');
	$datos['contenido']=((self::key('contenido',$datos))? $datos['contenido']:'<i class="glyphicon glyphicon-link" aria-hidden="true"></i>');	
	$datos['titulo']=((self::key('titulo',$datos))? $datos['titulo']:'Enlace');		
	$datos['atributos']=self::quita_espacios("$href $target").((self::key('atributos',$datos))? (' '.$datos['atributos']):'');
	return(self::eti_html($datos));
}

static public function lista($lineas=[], $enlinea=false) {
	static $contador=0;
	if(count($lineas)==0) return;
	$id='LISTA_'.$contador++;	
	$clase='';
	if($enlinea) $clase="list-inline";
	self::eti_html(['eti'=>'UL','clase'=>$clase,'id'=>$id],false); 
	foreach($lineas as $linea):
		self::eti_html(['eti'=>'LI'],false); 
		if(isset($linea['href'])):
			self::enlace($linea);	
		else:
			echo $linea;	
		endif;
		self::close_eti(); 
	endforeach;
	self::close_eti(); 
	return $id;
}

static public function panel_open($titulo, $estilo=0) {
	static $contador=0;
	if(!is_numeric($estilo)) $estilo=0;
	if(!($estilo>=0 && $estilo<count(self::$css_estados))) $estilo=0;
	$id='PANEL_'.$contador++;
	$clase='panel panel-'.self::$css_estados[$estilo].' text-justify';
	self::div(['clase'=>$clase,'id'=>$id]);
	self::div('panel-heading');
	$titulo=((empty($titulo))? 'PANEL DE CONTENIDOS':$titulo);	
	self::titulo($titulo,3,'panel-title');
	self::close_eti();
	self::div('panel-body');
	return $id;
}

static public function panel_close() {
	self::close_eti(2);
}

static public function rejilla_open($columnas=3) {
	if(!is_numeric($columnas)) $columnas=3;
	if(!($columnas>0 && $columnas<7)) $columnas=3;	
	if(!isset(self::$rejilla)) self::$rejilla=0;
	else self::$rejilla++;
	self::$col_rejilla[self::$rejilla]=$columnas;
	self::$cont_rejilla[self::$rejilla]=0;
	$id='REJILLA_'.self::$rejilla;
	self::div(['clase'=>'row', 'id'=>$id]);
	return $id;
}

static public function rejilla_col() {
	if(!isset(self::$rejilla)) return;
	if(self::$cont_rejilla[self::$rejilla]>0) self::close_eti();
	$columnas=intval(12/self::$col_rejilla[self::$rejilla]);
	$resto=intval(12%self::$col_rejilla[self::$rejilla]);
	if($resto>0) $resto=intval($resto/2);
	self::$cont_rejilla[self::$rejilla]++;
	if(self::$cont_rejilla[self::$rejilla]>self::$col_rejilla[self::$rejilla]) {
		self::div_clear();
		self::$cont_rejilla[self::$rejilla]=1;
	}
	if($resto>0 && self::$cont_rejilla[self::$rejilla]===1) $ajuste="col-sm-$columnas col-sm-offset-$resto col-md-$columnas col-md-offset-$resto col-lg-$columnas col-lg-offset-$resto";
	else $ajuste="col-sm-$columnas col-md-$columnas col-lg-$columnas";
	self::div($ajuste);
}

static public function rejilla_close() {
	if(!isset(self::$rejilla)) return;
	if(self::$cont_rejilla[self::$rejilla]>0) self::close_eti();
	self::close_eti();
	unset(self::$col_rejilla[self::$rejilla]);
	self::$rejilla--;
	if(self::$rejilla<0) self::$rejilla=NULL;
}

static public function acordeon_open($clase='',$id=NULL) {
	if(!isset(self::$acordeon)) self::$acordeon=0;
	else self::$acordeon=count(self::$acordeones);
	$id=(empty($id)? ('ACORDEON_'.self::$acordeon):$id);
	self::div(['clase'=>'panel-group '.$clase,'id'=>$id]);
	self::$acordeones[self::$acordeon]=$id;
	self::$cont_acordeon[self::$acordeon]=0;
	array_push(self::$open_acordeon,self::$acordeon);
	return $id;
}

static public function acordeon_div($titulo, $estilo=0, $clase_panel='',$clase_titulo='') {
	if(!isset(self::$acordeon)) return;
	if(!is_numeric($estilo)) $estilo=0;
	if(!($estilo>=0 && $estilo<count(self::$css_estados))) $estilo=0;	
	if(self::$cont_acordeon[self::$acordeon]>0) {
			self::close_eti(3);
	}
	self::$cont_acordeon[self::$acordeon]++;
	static $contador=0;
	$contador++;
	$id_acordeon=self::$acordeones[self::$acordeon];
	$id_panel=$id_acordeon.'-'.$contador;
	self::div('panel panel-'.self::$css_estados[$estilo].' text-justify');
	self::div('panel-heading');
	self::eti_html(['eti'=>'h3','clase'=>'panel-title '.$clase_titulo],false);
	self::enlace(['atributos'=>"data-toggle=\"collapse\" data-parent=\"#$id_acordeon\"", 'href'=>"#$id_panel", 'contenido'=>$titulo]);
	self::close_eti(2);
	self::div(['clase'=>'panel-collapse collapse','id'=>$id_panel]);
	self::div('panel-body '.$clase_panel);	
}

static public function acordeon_close() {
	if(!isset(self::$acordeon)) return;
	if(self::$cont_acordeon[self::$acordeon]>0) {
		self::close_eti(3);
	}
	array_pop(self::$open_acordeon);
	$i=count(self::$open_acordeon);
	if($i>0) self::$acordeon=self::$open_acordeon[$i-1];
	self::close_eti();
}

static public function form_open($datos=[]) {
	static $contador=0;
	$titulo=((self::key('titulo',$datos))? $datos['titulo']:'FORMULARIO');
	self::panel_open($titulo);
	$enctype='';
	if(self::key('enctype',$datos)) {
		switch($datos['enctype']) {
			case 0: $enctype='enctype="multipart/form-data"';
			break;				
			case 1:	$enctype='enctype="application/x-www-form-urlencoded"';
			break;		
		}
	}
	$id=((self::key('id',$datos))? $datos['id']:('FORM_'.$contador++));
	$name="name=\"$id\"";
	$metodo='method="'.((self::key('metodo',$datos))? $datos['metodo']:'POST').'"';
	$accion='action="'.((self::key('accion',$datos))? $datos['accion']:'').'"';
	$datos['titulo']='';
	$datos['eti']='FORM';
	$datos['atributos']=self::quita_espacios("$metodo $accion $enctype $name");

	self::eti_html($datos,false);
	return $id;
}

static public function form_close($botones=true) {
	if($botones) {
		self::boton(['clase'=>'btn-'.self::$css_estados[0],'texto'=>'Enviar']);
		self::boton(['clase'=>'btn-'.self::$css_estados[3],'texto'=>'Reiniciar','tipo'=>'reset','id'=>'ReiniciarFrm']);
		self::boton(['clase'=>'btn-'.self::$css_estados[4],'texto'=>'Cancelar','tipo'=>'reset','id'=>'CancelarFrm']);
	}
	self::close_eti();
	self::panel_close();
}

static public function campo($datos=[]) {
	static $contador=0;
	$eti='INPUT';
	$id=((self::key('id',$datos))? $datos['id']:($eti.'_'.$contador++));
	$tipo=((self::key('tipo',$datos))? $datos['tipo']:'text');
	$tipo_input='type="'.$tipo.'"';
	$valor=((self::key('valor',$datos))? ('value="'.$datos['valor'].'"'):'');
	$nombre='name="'.((self::key('nombre',$datos))? $datos['nombre']:$id).'"';
	$placeholder=((self::key('marca',$datos))? ('placeholder="'.$datos['marca'].'"'):'');
	$ayuda=((self::key('ayuda',$datos))? $datos['ayuda']:'');		
	$atributos=((self::key('atributos',$datos))? $datos['atributos']:'');	
	$ico=((self::key($tipo,self::$css_inputs))? self::$css_inputs[$tipo]:'');
	$ariadescribed=(($ico!='')? 'aria-describedby="span'.$id.'"':'');
	$datos['clase']='form-control'.((self::key('clase',$datos))? ' '.$datos['clase']:'');	
	$datos['atributos']=self::quita_espacios("$tipo_input $nombre $ariadescribed $placeholder $valor $atributos");
	$datos['eti']=$eti;
	$datos['id']=$id;
	self::div('form-group has-feedback');
	if(self::key('etiqueta',$datos)) self::eti_html(['eti'=>'label','atributos'=>'for="'.$id.'" role="button"','contenido'=>$datos['etiqueta']]);	
	self::eti_html($datos);
	if($ayuda!=''):
	    if(self::$sw_sangria) echo self::valor_sangria();
		self::eti_html(['eti'=>'SMALL','clase'=>'form-text text-muted', 'id'=>$id, 'contenido'=>$ayuda]);
		if(self::$sw_sangria) echo PHP_EOL;
	endif;
	if($ico!=''):
		if(self::$sw_sangria) echo self::valor_sangria();	
		self::eti_html(['eti'=>'SPAN','clase'=>'glyphicon '.$ico.' form-control-feedback']);
		if(self::$sw_sangria) { echo PHP_EOL; echo self::valor_sangria();	}
		self::eti_html(['eti'=>'SPAN','clase'=>'sr-only','contenido'=>'...','id'=>'span'.$id]);
		if(self::$sw_sangria) echo PHP_EOL;
	endif;
	if(self::key('extra',$datos)):
		echo $datos['extra'];
	endif;
	self::close_eti();
	return $id;
}

static public function boton($datos=[]) {
	$datos['eti']='BUTTON';
	$datos['clase']='btn btn-sm '.((self::key('clase',$datos))? ($datos['clase']):'');
	$datos['contenido']=((self::key('texto',$datos))? ($datos['texto']):'');
	$atributos=((self::key('tipo',$datos))? (' type="'.$datos['tipo'].'"'):' type="submit"');
	$datos['atributos']=((self::key('atributos',$datos))? $datos['atributos']:'').$atributos;
	$id=self::eti_html($datos);
	return $id;
}

static public function area($datos=[]) {
	static $contador=0;
	$eti='TEXTAREA';
	$id=((self::key('id',$datos))? $datos['id']:($eti.'_'.$contador++));
	$valor=((self::key('valor',$datos))? ($datos['valor']):'');
	$nombre='name="'.((self::key('nombre',$datos))? $datos['nombre']:$id).'"';
	$filas=((self::key('filas',$datos))? ('rows="'.$datos['filas'].'"'):'rows="3"');
	$ayuda=((self::key('ayuda',$datos))? $datos['ayuda']:'');
	$atributos=((self::key('atributos',$datos))? $datos['atributos']:'');
	$datos['clase']='form-control'.((self::key('clase',$datos))? ' '.$datos['clase']:'');		
	$datos['contenido']=$valor;
	$datos['atributos']=self::quita_espacios("$nombre $filas $atributos");
	$datos['eti']=$eti;
	$datos['id']=$id;
	self::div('form-group');
	if(self::key('etiqueta',$datos)) self::eti_html(['eti'=>'label','atributos'=>'for="'.$id.'" role="button"','contenido'=>$datos['etiqueta']]);	
	self::eti_html($datos);
	if($ayuda!=''):
    	if(self::$sw_sangria) echo self::valor_sangria();
		self::eti_html(['eti'=>'SMALL','clase'=>'form-text text-muted', 'id'=>$id, 'contenido'=>$ayuda]);
		if(self::$sw_sangria) echo PHP_EOL;
	endif;
	self::close_eti();
	return $id;
}

static public function captcha() {
	html::div('form-group col-sm-12 col-md-12 col-lg-12');
	html::div(['clase'=>'g-recaptcha', 'atributos'=>'data-sitekey="'.self::$id_captcha.'"'],true);
	html::close_eti();
}

static public function tabla($filas = [], $titulos=[], $estilo=0, $clasetabla='') {
	if(count($filas)==0) return;
	if(!is_numeric($estilo)) $estilo=0;
	if(!($estilo>=0 && $estilo<count(self::$css_tablas))) $estilo=0;
	$clase=(($estilo>0)? ('table table-'.self::$css_tablas[$estilo]):'table');
	self::div('table-responsive');
	$id=self::eti_html(['eti'=>'TABLE','clase'=>$clase.' '.$clasetabla],false);
	self::eti_html(['eti'=>'TBODY'],false);
	if(!empty($titulos)):
		self::eti_html(['eti'=>'TR'],false);
		foreach($titulos as $titulo):
			self::eti_html(['eti'=>'TH','contenido'=>$titulo]);
		endforeach;
		self::close_eti();
	endif;
	foreach($filas as $fila => $valores):
		$clase='';
		if(($pos=stripos($fila,'-'))) {
			$clase=substr($fila,0,$pos);
		}
		self::eti_html(['eti'=>'TR', 'clase'=>$clase],false);
		foreach($valores as $valor):
			self::eti_html(['eti'=>'TD','contenido'=>$valor]);
		endforeach;
		self::close_eti();
	endforeach;
	self::close_eti(3);
	return $id;
}

static public function botonera($botones=[], $vertical=false) {
	if(empty($botones)) return;
	static $contador=0;
	$id='BOTONERA_'.$contador++;
	self::div(['id'=>$id,'clase'=>'btn-group'.(($vertical)? '-vertical':''), 'atributos'=>'role="toolbar" aria-label="Justified button group"']);
	foreach($botones as $linea) {
		$tipo=((self::key('tipo',$linea))? $linea['tipo']:5);
		$href=((self::key('href',$linea))? $linea['href']:'');			
		$target=((self::key('target',$linea))? $linea['target']:'');
		$titulo=((self::key('titulo',$linea))? $linea['titulo']:'');
		$id=((self::key('id',$linea))? $linea['id']:'');
		if(self::$sw_sangria) echo self::valor_sangria();	
		self::enlace(['href'=>$linea['href'],
					  'contenido'=>$linea['texto'], 
					  'clase'=>'btn btn-'.self::$css_estados[$tipo], 
					  'atributos'=>'role="button" style="margin: 1px"', 
					  'target'=>$target, 
					  'titulo'=>$titulo, 
					  'id'=>$id]);
		if(self::$sw_sangria) echo PHP_EOL;
	}
	self::close_eti();
	return $id;
}	
	
static public function youtube($src,$estilo=0) {
	if(empty($src)) return;
	if(!is_numeric($estilo)) $estilo=0;
	if(!($estilo>=0 && $estilo<count(self::$css_videos))) $estilo=0;	
	static $contador=0;
	$id='EMBED_VIDEO_'.$contador++;
	self::div(['id'=>$id,'clase'=>'embed-responsive embed-responsive-'.self::$css_videos[$estilo]],false);
	self::eti_html(['eti'=>'IFRAME','clase'=>'embed-responsive-item','atributos'=>"src=\"$src\""]);
	self::close_eti();
	return $id;
}

static public function rejilla_imagenes($imagenes=[], $columnas=4) {
	if(empty($imagenes)) return;
	if(!is_numeric($columnas)) $columnas=4;
	if(!($columnas>0 && $columnas<6)) $columnas=4;	
	static $contador=0;
	$id='REJILLA_IMAGENES_'.$contador++;
	self::div(['clase'=>"row", 'id'=>$id]);
	$col=0;
	$ancho=intval(12/$columnas);
	foreach($imagenes as $imagen => $datos):
		if($col++==$columnas) { self::div_clear(); $col=1;}	
		self::div("col-md-$ancho col-lg-$ancho");
		$href=((self::key('href',$datos))? $datos['href']:'');
		if(empty($href)):
			self::div('thumbnail');
			$alt=((self::key('tip',$datos))? $datos['tip']:'Imagen');
			self::eti_html(['eti'=>'img','atributos'=>'src="'.$datos['img'].'" alt="'.$alt.'"','titulo'=>$alt]);
		else:
			$alt=((self::key('tip',$datos))? $datos['tip']:'Imagen');
			$contenido='<img src="'.$datos['img'].'" alt="'.$alt.'" />';
			$target=((self::key('target',$datos))? $datos['target']:'');
			if(self::$sw_sangria) echo self::valor_sangria();			
			$titulo=((self::key('tip',$datos))? $datos['tip']:'');
			self::enlace(['href'=>$href,'target'=>$target,'clase'=>'thumbnail','contenido'=>$contenido,'titulo'=>$titulo]);
			if(self::$sw_sangria) echo PHP_EOL;	
		endif;
		if(self::key('cabecera',$datos) || self::key('texto',$datos)):
			self::div("caption");
			if(self::key('cabecera',$datos)) self::titulo($datos['cabecera'],3);
			if(self::key('texto',$datos)) self::eti_html(['contenido'=>$datos['texto']]);
			self::close_eti();
		endif;
		
		if(empty($href)) self::close_eti();
		self::close_eti();
	endforeach;
 	self::close_eti();
	return $id;
}

static public function imagen($src,$clase='') {
	if(empty($src)) return;
	self::div('thumbnail');
	$nombre=basename($src);
	$id=self::eti_html(['eti'=>'IMG','titulo'=>$nombre,'atributos'=>'src="'.$src.'" alt="'.$src.'"','clase'=>$clase]);
	self::close_eti();
	return $id;
}

static public function seccion_open($titulo, $clase='') {
	$id=html::eti_html(['eti'=>'SECTION'],false);
	html::titulo($titulo,3,$clase);	
	return $id;
}

static public function seccion_close() {
	html::close_eti();
}

static public function articulo_open($titulo, $estilo=0) {
	$eti="ARTICLE";
	if(!is_numeric($estilo)) $estilo=0;
	if(!($estilo>=0 && $estilo<count(self::$css_estados))) $estilo=0;
	$clase='panel-'.self::$css_estados[$estilo].' text-justify';
	$id=html::eti_html(['eti'=>$eti,'clase'=>$clase],false);
	html::eti_html(['eti'=>'HEADER', 'noid'=>1],false);
	html::titulo($titulo,2,'inicio_articulo bg-primary');
	html::close_eti();
	return $id;
}

static public function articulo_close() {
	html::close_eti();
}

}