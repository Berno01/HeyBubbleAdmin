<?php
include("header.php");
?> <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Venta de bubbles &nbsp; 
                                        <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="bx bx-add-to-queue"></i> Nuevo</button></h4>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                <div class="card-body" id="listadoregistros">
                                    <h4 class="card-title">Listado de Registros</h4>
                                    <table id="tbllistado" class="table table-hover e-commerce-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Estado</th>
                                                <th>Cliente</th>
                                                <th>Vasos</th>
                                                <th>Hora</th>
                                                <th>Total Compra</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                                    <div class="card-body" id="formularioregistros">
                                        <form name="formulario" id="formulario" method="POST">
                                            <h4 class="card-title">Registro de Datos</h4>  
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label">Cliente:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="cliente_venta" name="cliente_venta" placeholder="Nombre del cliente">
                                                </div>
                                            </div> 
                                            
                                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">     
                                                <button id="btnAgregarBuba" type="button" class="btn btn-primary waves-effect waves-light" onclick="agregarBubaB()"><span class="fa fa-plus"></span>Agregar Buba</button>
                                            </div>

                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <table id="detalles" class="table table-hover e-commerce-table">
                                                <thead style="background-color:#A9D0F5">
                                                        <th>Op</th>
                                                        <th>Cant</th>
                                                        <th>Sabor</th>
                                                        <th>Buba</th>
                                                        <th>Tamaño</th>
                                                        <th>Pago</th>
                                                        <th>Precio</th>
                                                        <th>Subtotal</th>
                                                        <th>Refresh</th>
                                                    </thead>
                                                    <tfoot>
                                                        <th>TOTAL</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th><h4 id="total">Bs/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th> 
                                                    </tfoot>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>                  
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="bx bx-save"></i> Guardar</button>
                                                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                            </div>
                                        </form>
                                        <!-- Modal -->
                                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Seleccione un Artículo</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
                                                                    <thead>
                                                                        <th>Opciones</th>
                                                                        <th>Nombre</th>
                                                                        <th>Categoría</th>
                                                                        <th>Código</th>
                                                                        <th>Stock</th>
                                                                        <th>Imagen</th>
                                                                    </thead>
                                                                    <tbody>                                                                    
                                                                    </tbody>
                                                                    <tfoot>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>  
                                                <!-- Fin modal -->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->            
                </div>
            


            <?php
include("footer.php");
?>
<script type="text/javascript" src="script/venta1.js"></script> 
            