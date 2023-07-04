<?php
include_once('Layout/header.php');
?>

<div id="content" class="app-content">
    <div class="row g-3">
    <div class="col-md-12">
        <div class="fs-4 mb-4">Bundle Master</div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <span class="flex-grow-1 fs-4">Bundle Creation</span>
                    <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                </div>
                <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col-3">Bundle No: <input name="bundle_no" class="form-control bg-dark" type="text" value="BFF" disable required /></div>
                    <div class="col-3">Barcode: <input name="barcode" class="form-control bg-dark" type="text" value="BFF" disable required /></div>
                    <div class="col-3">Case No: <input name="case_no" class="form-control " type="text"  required /></div>
                    <div class="col-3">Case Type: <select name="case_type" class="form-select" type="text"  required >
                        <?php 
                        foreach($_SESSION['caseTypes'] as $key=>$types){
                            ?>
                            <option value="<?=$types->case_type_id?>"><?=$types->case_type?></option>
                            <?php
                        }
                        ?>
                    </select></div>
                </div>
                <div class="row mb-3">
                    <div class="col-9">Case Name: <input name="case_name" class="form-control " type="text"  required /></div>
                    <div class="col-3">Case Year: <input name="case_year" class="form-control " type="text"  required /></div>
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
    </div>
</div>

<?php
include_once('Layout/footer.php');
?>