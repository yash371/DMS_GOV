<?php
include_once('Layout/header.php');
?>

<?php
include_once('Layout/header.php');
?>

<div id="content" class="app-content">
     <div class="row g-3">
     <div class="col-md-12">
        <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <span class="flex-grow-1 fs-4">Bundle/Batch List</span>
                        </div>
                        <table class="table table-border" style="border: 1px solid rgba(255,255,255,0.1);">
                        <thead class="table-dark">
                            <tr>
                                <td>Sl No.</td>
                                <td>Bundle No</td>
                                <td>Bundle Length</td>
                                <td>Created By</td>
                                <td>Case List</td>
                                <td class="text-end">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($bundle_list)){
                                foreach($bundle_list as $key=>$Bundle){
                                    ?>
                                    <tr style="background: rgba(0,0,0,0.5);">
                                        <td valign="middle"><?=$key+1?></td>
                                        <td valign="middle"><?="BUN".$Bundle->bundle_no?></td>
                                        <td valign="middle"><?=$Bundle->bundle_length?></td>
                                        <td valign="middle"><?=$Bundle->created_by_user_id == 1?"Super Admin":"Admin"?></td>
                                        <td valign="middle">
                                            <select class="form-select">
                                                <?php
                                                if(!empty($case_list)){
                                                            foreach($case_list as $index=>$case){
                                                                if($case->bundle_no == $Bundle->bundle_no ){
                                                                    ?>
                                                                    <option><?=$case->case_name?></option>
                                                                    <?php
                                                                }
                                                            }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="text-end" valign="middle">
                                        <a href=""  class="btn btn-sm btn-theme">Add More</a>
                                        </td>
                                        
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

<?php
include_once('Layout/footer.php');
?>