<?php
include("header.php");
?> 
<div class="card">
    <div class = "card-body">

        <div class="row m-b-30">
            <div class="col-lg-4 text-left">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="anticon anticon-plus-circle m-r-5"></i>
                    <span>Agregar marca</span>
                </button>

                

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">marca</h5>
                                <button type="button" onclick="cancelarform()" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Asegurate de escribir bien el nombre de la categoría.</p>
                                <br>  
                                <form name="formulario" id="formulario" method="POST">
                                    <input type="text" hidden style="display: none;" name="id_marca" id="id_marca" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    
                                    <div class="input-group mb-3">
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Categoría: </span>
                                        </div>
                                        
                                        <input type="text" name="nombre_marca" id="nombre_marca" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
        
        <table id="data-table" class="table table-hover e-commerce-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>                 
        </table>
        
        
    </div>
    
</div>


<?php
include("footer.php");
?>
<script type="text/javascript" src="script/marca.js"></script> 
                                
                                
