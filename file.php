<?php

session_start();

date_default_timezone_set("America/Lima");

define("SERVERNAME","10.144.254.146");
define("USER", "root");
define("PASSWORD","");
define("DATABASE","upnregistrosweb");

$accion = $_POST['accion'];
$paramfechainit = $_POST['paramfechainit'];
$paramfechafin = $_POST['paramfechafin'];


function EnviarDatosBD() {

  ini_set("memory_limit","2048M");
  set_time_limit(10800);

  require_once 'excel_reader2.php';

  $data = new Spreadsheet_Excel_Reader("rw_data.xls",false);

  $arreglo = array();

  $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 


  //Recorre el excel y guarda en la bd
  $columnas =  $data->colcount($sheet_index=0);
  $filas = $data->rowcount($sheet_index=0);

  for ($i = 2; $i <= $filas; $i++) {/*Filas*/

      for ($j = 1; $j <= $columnas; $j++) {/*Columnas*/
        $arreglo[$j] = $data->val($i,$j);
      }
      
      $fecha =  date("Y-m-d",strtotime(str_replace("/", "-", $arreglo[16])));
      $fechaenviocrm =  date("Y-m-d",strtotime(str_replace("/", "-", $arreglo[44])));

       $sql = "INSERT INTO rw_data VALUES ('".
        
         $arreglo[1]."','". 
         $arreglo[2]."','".
         $arreglo[3]."','".
         $arreglo[4]."','".
         $arreglo[5]."','".
         $arreglo[6]."','".
         $arreglo[7]."','".
         $arreglo[8]."','".
         $arreglo[9]."','".
         $arreglo[10]."','".
         $arreglo[11]."','".
         $arreglo[12]."','".
         $arreglo[13]."','".
         $arreglo[14]."','".
         $arreglo[15]."','".
         $fecha."','".
         $arreglo[17]."','".
         $arreglo[18]."','".
         $arreglo[19]."','".
         $arreglo[20]."','".
         $arreglo[21]."','".
         $arreglo[22]."','".
         $arreglo[23]."','".
         $arreglo[24]."','".
         $arreglo[25]."','".
         $arreglo[26]."','".
         $arreglo[27]."','".
         $arreglo[28]."','".
         $arreglo[29]."','".
         $arreglo[30]."','".
         $arreglo[31]."','".
         $arreglo[32]."','".
         $arreglo[33]."','".
         $arreglo[34]."','".
         $arreglo[35]."','".
         $arreglo[36]."','".
         $arreglo[37]."','".
         $arreglo[38]."','".
         $arreglo[39]."','".
         $arreglo[40]."','".
         $arreglo[41]."','".
         $arreglo[42]."','".
         $arreglo[43]."','".
         $fechaenviocrm."','".
         $arreglo[45]."')";
        
         if ($conn->query($sql) === TRUE) {
         } 
         else {
           echo "Error: " . $sql . "<br>" . $conn->error;
           echo "<br>";
         }
      
  }

  $conn->close();

}

function ObtenerRWCxFecha($pfechainit,$pfechafin) {


  if ($pfechainit != "" and $pfechafin != "") {

    list($mesinit, $diainit, $anioinit) = explode('/', $pfechainit);
    
    list($mesfin, $diafin, $aniofin) = explode('/', $pfechafin);
    
    $paramfechainittosend = $anioinit . "-" . $mesinit . "-" . $diainit;
    
    $paramfechafintosend = $aniofin . "-" . $mesfin . "-" . $diafin;

    $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{
        
       $sql = "select SEDE, count(DNI) as TOTAL from rw_data where TIPORW = 'C' and TIPOUSUARIO in ('N','R') and FECHA between '" . $paramfechainittosend . "' and '" . $paramfechafintosend . "'group by SEDE;";     

       $respuesta = $conn->query($sql);

       if (!$respuesta) {

          $result = "Se produjo un error al extraer los datos";

          echo json_encode($result);

       }
       else {
          $arraytemp = array();

          while ($row = mysqli_fetch_assoc($respuesta)) {
             $arraytemp[] = $row; 
          }

          echo json_encode($arraytemp); 
       }
    } 
  }
  else {  
      $respuesta = "no ha ingresado el dato";

      echo json_encode($respuesta);
  }

  
}

function ObtenerRWNCxFecha($pfechainit,$pfechafin) {


  if ($pfechainit != "" and $pfechafin != "") {

    list($mesinit, $diainit, $anioinit) = explode('/', $pfechainit);
    
    list($mesfin, $diafin, $aniofin) = explode('/', $pfechafin);
    
    $paramfechainittosend = $anioinit . "-" . $mesinit . "-" . $diainit;
    
    $paramfechafintosend = $aniofin . "-" . $mesfin . "-" . $diafin;

    $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{
        
       $sql = "select SEDE, count(DNI) as TOTAL from rw_data where FECHA between '" . $paramfechainittosend . "' and '" . $paramfechafintosend . "' and TIPORW = 'NC' group by SEDE;";  
       
       $respuesta = $conn->query($sql);

       if (!$respuesta) {

          $result = "Se produjo un error al extraer los datos";

          echo json_encode($result);

       }
       else {
          $arraytemp = array();

          while ($row = mysqli_fetch_assoc($respuesta)) {
             $arraytemp[] = $row; 
          }

          echo json_encode($arraytemp); 
       }
    } 
  }
  else {  
      $respuesta = "no ha ingresado el dato";

      echo json_encode($respuesta);
  }

  
}



function ObtenerTotalEmailing($pfechainit,$pfechafin) {


  if ($pfechainit != "" and $pfechafin != "") {

    list($mesinit, $diainit, $anioinit) = explode('/', $pfechainit);
    
    list($mesfin, $diafin, $aniofin) = explode('/', $pfechafin);
    
    $paramfechainittosend = $anioinit . "-" . $mesinit . "-" . $diainit;
    
    $paramfechafintosend = $aniofin . "-" . $mesfin . "-" . $diafin;

    $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{
        
       $sql = "select sum(envios) as envios, sum(rebotes) as rebotes,sum(efectivos) as efectivos,sum(removidos) as removidos from emailing_data where 
       fecha_envio between '" .$paramfechainittosend."' and '" .$paramfechafintosend."' ";  
       
       $respuesta = $conn->query($sql);

       if (!$respuesta) {

          $result = "Se produjo un error al extraer los datos";

          echo json_encode($result);

       }
       else {
          $arraytemp = array();

          while ($row = mysqli_fetch_assoc($respuesta)) {
             $arraytemp[] = $row; 
          }

          echo json_encode($arraytemp); 
       }
    } 
  }
  else {  
      $respuesta = "no ha ingresado el dato";

      echo json_encode($respuesta);
  }

  
}


function ObtenerTotalRWCPorCampus($pfechainit,$pfechafin) {
  
  $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

   if ($pfechainit != "" and $pfechafin != "") {

    list($mesinit, $diainit, $anioinit) = explode('/', $pfechainit);
    
    list($mesfin, $diafin, $aniofin) = explode('/', $pfechafin);
    
    $paramfechainittosend = $anioinit . "-" . $mesinit . "-" . $diainit;
    
    $paramfechafintosend = $aniofin . "-" . $mesfin . "-" . $diafin;

    $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{

      $sql = "select CASE SEDE
      WHEN 'EPECC' THEN 'Cajamarca'
      WHEN 'UPNC' THEN 'Cajamarca'
      WHEN 'WAC' THEN 'Cajamarca'
      WHEN 'EPECT' THEN 'Trujillo'
      WHEN 'UPNT' THEN 'Trujillo'
      WHEN 'WAT' THEN 'Trujillo'
      WHEN 'EPECLN' THEN 'Los Olivos'
      WHEN 'UPNLN' THEN 'Los Olivos'
      WHEN 'WALN' THEN 'Los Olivos'
      WHEN 'EPECLC' THEN 'Breña'
      WHEN 'UPNLC' THEN 'Breña'
      WHEN 'WALC' THEN 'Breña'
      WHEN 'EPECLE' THEN 'SJL'
      WHEN 'UPNLE' THEN 'SJL'
      WHEN 'WALE' THEN 'SJL'
      WHEN 'EPECCO' THEN 'Comas'
      WHEN 'UPNCO' THEN 'Comas'
      WHEN 'WACO' THEN 'Comas' END CAMPUS, COUNT(DNI) AS TOTAL
      FROM rw_data
      WHERE TIPORW = 'C' AND TIPOUSUARIO IN ('N','R') AND FECHA BETWEEN '2017-01-01' AND '" . $paramfechafintosend . "'
      GROUP BY CAMPUS";

       $respuesta = $conn->query($sql);

       if (!$respuesta) {

          $result = $respuesta;

          echo json_encode($result);

       }
       else {
          $arraytemp = array();

          while ($row = mysqli_fetch_assoc($respuesta)) {
             $arraytemp[] = $row; 
          }

          echo json_encode($arraytemp); 
       }
    } 
  }
  else {  
      $respuesta = "no ha ingresado el dato";

      echo json_encode($respuesta);
  }
}

function ObtenerTotalRWNCPorCampus($pfechainit,$pfechafin) {
  
  $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

   if ($pfechainit != "" and $pfechafin != "") {

    list($mesinit, $diainit, $anioinit) = explode('/', $pfechainit);
    
    list($mesfin, $diafin, $aniofin) = explode('/', $pfechafin);
    
    $paramfechainittosend = $anioinit . "-" . $mesinit . "-" . $diainit;
    
    $paramfechafintosend = $aniofin . "-" . $mesfin . "-" . $diafin;

    $conn = new mysqli(SERVERNAME, USER, PASSWORD, DATABASE);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{

      $sql = "select CASE SEDE
      WHEN 'EPECC' THEN 'Cajamarca'
      WHEN 'UPNC' THEN 'Cajamarca'
      WHEN 'WAC' THEN 'Cajamarca'
      WHEN 'EPECT' THEN 'Trujillo'
      WHEN 'UPNT' THEN 'Trujillo'
      WHEN 'WAT' THEN 'Trujillo'
      WHEN 'EPECLN' THEN 'Los Olivos'
      WHEN 'UPNLN' THEN 'Los Olivos'
      WHEN 'WALN' THEN 'Los Olivos'
      WHEN 'EPECLC' THEN 'Breña'
      WHEN 'UPNLC' THEN 'Breña'
      WHEN 'WALC' THEN 'Breña'
      WHEN 'EPECLE' THEN 'SJL'
      WHEN 'UPNLE' THEN 'SJL'
      WHEN 'WALE' THEN 'SJL'
      WHEN 'EPECCO' THEN 'Comas'
      WHEN 'UPNCO' THEN 'Comas'
      WHEN 'WACO' THEN 'Comas' END CAMPUS, COUNT(DNI) AS TOTAL
      FROM rw_data
      WHERE TIPORW = 'NC' AND FECHA BETWEEN '2017-01-01' AND '" . $paramfechafintosend . "'
      GROUP BY CAMPUS";

       $respuesta = $conn->query($sql);

       if (!$respuesta) {

          $result = $respuesta;

          echo json_encode($result);

       }
       else {
          $arraytemp = array();

          while ($row = mysqli_fetch_assoc($respuesta)) {
             $arraytemp[] = $row; 
          }

          echo json_encode($arraytemp); 
       }
    } 
  }
  else {  
      $respuesta = "no ha ingresado el dato";

      echo json_encode($respuesta);
  }
}

switch ($accion) {
  case 'upload':
      EnviarDatosBD();
      break;
  case 'closeconn':
        break;
  case 'obtener-reporte-comercial-registros-comerciales';  
      ObtenerRWCxFecha($paramfechainit,$paramfechafin);
      unset($accion);
      unset($paramfechainit);
      unset($paramfechafin);
      break;
  case 'obtener-reporte-comercial-registros-no-comerciales';  
      ObtenerRWNCxFecha($paramfechainit,$paramfechafin);
      unset($accion);
      unset($paramfechainit);
      unset($paramfechafin);
      break; 
  case 'obtener-total-registros-comerciales-campus';
      ObtenerTotalRWCPorCampus($paramfechainit,$paramfechafin);
      unset($accion);
      unset($paramfechainit);
      unset($paramfechafin);
      break;
   case 'obtener-total-registros-no-comerciales-campus';
      ObtenerTotalRWNCPorCampus($paramfechainit,$paramfechafin);
      unset($accion);
      unset($paramfechainit);
      unset($paramfechafin);
      break;   
   case 'obtener-reporte-emaling';
      ObtenerTotalEmailing($paramfechainit,$paramfechafin);
      unset($accion);
      unset($paramfechainit);
      unset($paramfechafin);
      break;           
}



?>