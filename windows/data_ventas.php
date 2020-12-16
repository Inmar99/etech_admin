<?php


?>
    </div>
    </div>
    </div>
    </div>
<div class="modal fade" id="totalizar_ventas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <!-- Company Information -->
                    <h6 class="heading-small text-muted mb-4">DATOS DE VENTAS </h6>
                    <div class="form-row">

                        <div class='form-group col-md-12'>
                            <input type="text" style="display: inline-block; width: 85%;" class="form-control form-control-lg" id="txt_normal" name="txt_normal" 
                            onkeypress="return valid_enter(event)" onkeyup="total_entrega(this.value)" readonly required>
                            <label for="cmpSlogan">
                                <span id="usrAvailable" class="badge badge-success" style="font-size: medium;" data-toggle="tooltip" data-placement="top">
                                    <i id="tipIcon" class="ni ni-check-bold"></i>
                                </span>
                            </label>
                        </div>

                        <div class="form-group col-md-12">
                            <input type="text" style="display: inline-block; width: 85%;" class="form-control form-control-lg" id="txt_bajo" name="txt_bajo" 
                            onkeypress="return valid_enter(event)" onkeyup="total_entrega(this.value)" readonly required>
                            <label for="cmpSlogan">
                                <span id="usrAvailable" class="badge badge-danger" style="font-size: medium;" data-toggle="tooltip" data-placement="top">
                                    <i id="tipIcon" class="ni ni-check-bold"></i>
                                </span>
                            </label>
                        </div>

                        


                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    </div>
        </div>
    </div>
</div>

<script>

</script>