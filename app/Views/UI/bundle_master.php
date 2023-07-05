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
                <form action="bundle_master_temp_post"  id="addTemp" method="post" accept-charset="utf-8">
                <div class="row mb-3">
                    <input type="hidden" name="bundle_no" value="<?=$_SESSION['Session_Bundle_no']?>" required/>
                    <input type="hidden" name="barcode" value="<?=$_SESSION['Session_Case_no']?>" required/>
                    <div class="col-3">Bundle No/Batch Code: <input  class="form-control bg-dark" type="text" value="<?="BUN".$_SESSION['Session_Bundle_no']?>" disable required /></div>
                    <div class="col-3">Barcode: <input  class="form-control bg-dark" type="text" value="<?=$_SESSION['Session_Case_no']?>" disable required /></div>
                    <div class="col-3">Case No/File No: <input name="case_no" class="form-control " type="text"  required /></div>
                    <div class="col-3">Case Type/File type: <select name="case_type" class="form-select" type="text"  required >
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
                    <div class="col-9">Case Name/File Name: <input name="case_name" class="form-control " type="text"  required /></div>
                    <div class="col-3">Case Year/File Year: <input name="case_year" class="form-control " type="text"  required /></div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-default" id="clock" disabled></button>
                    <button type="submit" class="btn btn-theme">Insert</button>
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
    <div class="col-md-12">
        <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <span class="flex-grow-1 fs-4">Temp Case/File</span>
                        </div>
                        <table class="table table-border" style="border: 1px solid rgba(255,255,255,0.1);">
                        <thead class="table-dark">
                            <tr>
                                <td>Sl No.</td>
                                <td>Barcode</td>
                                <td>Case/File No.</td>
                                <td>Case/File Name</td>
                                <td>Case Type</td>
                                <td>Case Year</td>
                                <td class="text-end">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($temp_case_bucket)){
                                foreach($temp_case_bucket as $key=>$tempCase){
                                    ?>
                                    <tr style="background: rgba(0,0,0,0.5);">
                                        <td valign="middle"><?=$key+1?></td>
                                        <td valign="middle"><?=$tempCase->barcode?></td>
                                        <td valign="middle"><?=$tempCase->case_no?></td>
                                        <td valign="middle"><?=$tempCase->case_name?></td>
                                        <td valign="middle"><?=$tempCase->case_type_id?></td>
                                        <td valign="middle"><?=$tempCase->case_year?></td>
                                        <td class="text-end"><a href="bundle_master?temp_id=<?=$tempCase->case_id?>" class="btn btn-sm btn-theme bg-danger">X</a></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-end mt-4">
                    <a href="bundle_master_final_post" type="submit" class="btn btn-theme">Final Submit</a>
                </div>
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
<script>
function updateClock() {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();

  var time = "Timer:"+ hours + ":" + minutes + ":" + seconds +"++";

  document.getElementById("clock").textContent = time;
}

// Update the clock every second
setInterval(updateClock, 1000);

</script>