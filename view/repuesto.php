

<?php
include("header.php");
?> 
<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    <i class="anticon anticon-plus-circle m-r-5"></i>
    <span>Agregar Repuesto</span>
</button>
<div class="card">
    <div class = "card-body">
        <table id="data-table" class="table table-hover e-commerce-table">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Codigo</th>
                    <th>Marca</th>
                    <th>Medida</th>
                    <th>Stock</th>
                    <th>Opciones</th>
                </tr>
            </thead>                 
        </table>

        
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Repuesto</h5>
                                <button type="button" onclick="cancelarform()" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Asegurate de escribir bien el nombre del repuesto.</p>
                                <br>  
                                <form name="formulario" id="formulario" method="POST">
                                    <input type="text" hidden name="id_repuesto" id="id_repuesto">
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Categoria: </span>
                                        </div>
                                        <select id="categoria" name="categoria" class="form-control" data-live-search="true" required>
                                        </select>
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Codigo: </span>
                                        </div>
                                        <input type="text" name="codigo_repuesto" id="codigo_repuesto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Marca del repuesto: </span>
                                        </div>
                                        
                                        <select name="marca" id="marca" class="form-control" data-live-search="true" required>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Medida: </span>
                                        </div>
                                        <input type="text" name="medida_repuesto" id="medida_repuesto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Stock: </span>
                                        </div>
                                        <input type="text" name="stock_repuesto" id="stock_repuesto" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Stock minimo: </span>
                                        </div>
                                        <input type="text" name="stock_minimo" id="stock_minimo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Precio sugerido: </span>
                                        </div>
                                        <input type="text" name="precio_sugerido" id="precio_sugerido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text">Descripción</span>
                                        <textarea class="form-control" aria-label="With textarea" id="descripcion_repuesto" name="descripcion_repuesto"></textarea>
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


<?php
include("footer.php");
?>
<script type="text/javascript" src="script/repuesto.js"></script> 
                                
                                
