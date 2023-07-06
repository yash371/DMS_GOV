<?php
include_once('Layout/header.php');
?>
<div id="content" class="app-content">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <span class="flex-grow-1 fs-4">Case Documents</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>
                    <?php 
                      $i=0;
                      if(!empty($fetch_data)){ ?>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php 
                              foreach($fetch_data as $img){
                            ?>
                            <div class="carousel-item <?=$i==0?'active':''?>">
                                <img src="<?=PUBLIC_URL?>/<?=$img?>" class="d-block w-100" alt="...">
                            </div>
                            <?php
                            $i++;
                            }
                            ?>

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon  bg-dark" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon  bg-dark" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <?php } else { ?>
                        <p>No Document Found!!</p>
                        <a href="scan_accept_case" class="btn btn-sm btn-theme">Refresh</a>
                        <h3>Note : Please kindly Config your Printer Document Save Location To "<?=$folder?>"</h3>
                        <?php }?>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <?php if($case_details != null){ ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <span class="flex-grow-1 fs-4">Case Details</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>
                    <form>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Barcode" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end bg-dark" type="text"
                                    value="<?=$case_details->barcode?>" disabled required /></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Case No" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end bg-dark" type="text"
                                    value="<?=$case_details->case_no?>" disabled required /></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Case Name" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end bg-dark" type="text"
                                    value="<?=$case_details->case_name?>" disabled required /></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Case Type" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end bg-dark" type="text"
                                    value="<?=$case_details->case_type_id?>" disabled required /></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Scan Fetch Document Length" disabled /></div>
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-end bg-dark" type="text"
                                    value="<?=count($fetch_data)?>" disabled required /></div>
                        </div>
                    </form>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>



            </div>

        </div>
        <?php }?>
        
    </div>

    <?php
include_once('Layout/footer.php');
?>