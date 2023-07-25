<?php
include("header.php");
?>

<div class="card">
    <div class = "card-body">

        <div class="row m-b-30">
            <div class="col-lg-4 text-left">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="anticon anticon-plus-circle m-r-5"></i>
                    <span>Agregar Proveedor</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Proveedor</h5>
                                <button type="button" onclick="cancelarform()" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Asegurate de escribir bien los datos del Proveedor.</p>
                                <br>  
                                <form name="formulario" id="formulario" method="POST">
                                    <input type="text" hidden style="display: none;" name="id_proveedor" id="id_proveedor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    
                                    <div class="input-group mb-3">
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Proveedor: </span>
                                        </div>
                                        
                                        <input type="text" name="nombre_proveedor" id="nombre_proveedor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Número de telefono: </span>
                                        </div>
                                        
                                        <input type="text" name="telef_proveedor" id="telef_proveedor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Descripción: </span>
                                        </div>
                                        
                                        <input type="text" name="descripcion_proveedor" id="descripcion_proveedor" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancelarform()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




                
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-11 mx-auto">
            <!-- Card View -->
                <div class="row" id="listaProveedor">
                
                </div>
            </div>
        </div>
        
        
    </div>
    
</div>






<?php
include("footer.php");
?>
<script type="text/javascript" src="script/proveedor.js"></script> 
                                
       