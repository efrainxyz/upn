<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">

    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/modules/exporting.js"></script>
    <script src="js/main-config.js"></script>
     <script src="js/emailing.js"></script>

  </head>


  <body>
    <div class="container-fluid">
 
        <div id="panel-left-container" class="col-md-2">
          <ul class="nav nav-pills nav-stacked">
            <li id="reporte-comercial-section-li"><a href="#reporte-comercial-section" onclick="return false">Reporte Comercial</a></li>
            <li id="reporte-quincenal-section-li" ><a href="#reporte-quincenal-section" onclick="return false">Reporte Personalizdo</a></li>
            <li id="reporte-emailing-section-li" ><a href="#reporte-emailing-section" onclick="return false">Reporte Emailing</a></li>
          </ul>
        </div>

        <div id="panel-right-container" class="col-md-10">

           <div id="reporte-comercial-section" class="container-fluid">
              
              <div class="row">

                   <div class="col-md-12">
                      <div class="col-xs-3">
                        <div class="input-group date" id="datetimepicker-reporte-comercial-init" name="datetimepicker-reporte-comercial-init"> 
                          <input  id="fecha-reporte-rc-init" type='text' class="form-control"/>

                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                      <div class="col-xs-3">
                        <div class="input-group date" id="datetimepicker-reporte-comercial-fin" name="datetimepicker-reporte-comercial-fin"> 
                          <input  id="fecha-reporte-rc-fin" type='text' class="form-control"/>

                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>

                      <div class="form-group">
                        <input type="submit" id="reporte-comercial-btn" name="reporte-comercial-btn" value="Obtener Reporte Comercial" class="btn btn-primary">
                      </div>

                   
                      <div class="col-xs-12">
                          <h1 id="reporte-comercial-anual-title"></h1>
                      </div>  


                      <div id="reporte-comercial-data" class="col-xs-4">
                      
                        <h2>Registros Web C</h2> 

                       <div class="dataTable_wrapper">
                          <table class="table table-striped table-bordered table-hover" id="datatable-rwc-campus">
                              <thead>
                                  <tr>
                                      <th>CAMPUS</th>
                                      <th>TOTAL</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                              </tbody>
                          </table>
                      </div> 

                      <h3 id="reporte-comercial-suma-rwc-campus">Total RWC = </h3> 
                    </div>   


                    <div id="reporte-comercial-data" class="col-xs-4">
                      

                       <h2>Registros Web NC</h2>  


                       <div class="dataTable_wrapper">
                          <table class="table table-striped table-bordered table-hover" id="datatable-rwnc-campus">
                              <thead>
                                  <tr>
                                      <th>CAMPUS</th>
                                      <th>TOTAL</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                              </tbody>
                          </table>
                      </div> 

                      <h3 id="reporte-comercial-suma-rwnc-campus">Total RWNC = </h3> 
                    </div>    


                    <div class="col-xs-12">
                        <h1 id="reporte-comercial-title"></h1>
                    </div>  


                    <div id="reporte-comercial-data" class="col-xs-4">
                      
                       <h2>Registros Web C</h2> 

                       <div class="dataTable_wrapper">
                          <table class="table table-striped table-bordered table-hover" id="datatable-rwc">
                              <thead>
                                  <tr>
                                      <th>SEDE</th>
                                      <th>TOTAL</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                              </tbody>
                          </table>
                      </div> 

                      <h3 id="reporte-comercial-suma-rwc">Total RWC = </h3> 
                    </div>  

                    <div id="reporte-comercial-data" class="col-xs-4">
                      
                       <h2>Registros Web NC</h2> 

                       <div class="dataTable_wrapper">
                          <table class="table table-striped table-bordered table-hover" id="datatable-rwnc">
                              <thead>
                                  <tr>
                                      <th>SEDE</th>
                                      <th>TOTAL</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                              </tbody>
                          </table>
                      </div>  

                      <h3 id="reporte-comercial-suma-rwnc">Total RWNC = </h3> 

                    </div> 
                  
                  </div>   

              </div>

              <div class="col-md-12">
                <div id="container-rw-history-week"></div>
              </div>
           </div> 
  
           <div id="reporte-quincenal-section" class="container-fluid">

              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                      <input type="submit" id="upload-file" name="upload-file" value="Subir archivo" class="btn btn-primary">
                      <input type="submit" id="close-conn" name="Cerrar Conexión" value="Cerrar Conexion" class="btn btn-primary">
                    </div>
                </div>
               
                <div class="col-md-4"></div>
              </div>

              <div class="row">
                  <div class="col-md-4">
                       <div class="col-xs-12">
                          <div class="input-group date" id="datetimepicker-quincenal-init"> 
                            <input  id="fecha-reporte-quincenal-init" type='text' class="form-control"/>

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                       </div>
                  </div>

                  <div class="col-md-4">
                       <div class="col-xs-12">
                          <div class="input-group date" id="datetimepicker-quincenal-fin"> 
                            <input  id="fecha-reporte-quincenal-fin" type='text' class="form-control"/>

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                       </div>
                  </div>   

                  
                  <div class="col-md-4">
                    <div class="col-xs-12">
                      <div class="form-group">
                          <input type="submit" id="reporte-quincenal-btn" value="Obtener Reporte Quincenal" class="btn btn-primary">
                      </div>  
                    </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-12">
                    <div id="reporte-quincenal-title" class="col-xs-12">
                        <h1></h1>
                    </div>   
                  </div> 
              </div>
           </div>    

           <div id="reporte-emailing-section" class="container-fluid">

            
              <div class="row">
                  <div class="col-md-4">
                       <div class="col-xs-12">
                          <div class="input-group date" id="datetimepicker-emailing-init"> 
                            <input  id="fecha-reporte-emailing-init" type='text' class="form-control"/>

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                       </div>
                  </div>

                  <div class="col-md-4">
                       <div class="col-xs-12">
                          <div class="input-group date" id="datetimepicker-emailing-fin"> 
                            <input  id="fecha-reporte-emailing-fin" type='text' class="form-control"/>

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                       </div>
                  </div>   

                  
                  <div class="col-md-4">
                    <div class="col-xs-12">
                      <div class="form-group">
                          <input type="submit" id="reporte-emailing-btn" value="Obtener Reporte Emaling " class="btn btn-primary">
                      </div>  
                    </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-12">
                    <div id="reporte-quincenal-title" class="col-xs-12">
                        <h1></h1>
                    </div>   
                  </div> 
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th>Envios</th>
                          <th>Rebotes</th>
                          <th>Efectivos</th>
                          <th>Removidos</th>
                        </tr>
                    </thead>
                    <tbody id="report-total-emailing">
                      
                    </tbody>
                  </table>
                  </div>
                </div>
                  <div class="col-md-12">
                <div id="graficos-emailing"></div>
              </div>
              </div>
           </div>
           
        </div>

    </div> 
  </div>
  </div>


  </body>
</html>

