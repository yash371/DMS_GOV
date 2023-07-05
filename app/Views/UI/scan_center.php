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
                            <span class="flex-grow-1 fs-4">Data Center</span>
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
                            if(!empty($scan_list)){
                                foreach($scan_list as $key=>$Case){
                                    if($Case->user_id == $_SESSION['User']->user_id){
                                    ?>
                                    <tr style="background: rgba(0,0,0,0.5);">
                                        <td valign="middle"><?=$key+1?></td>
                                        <td valign="middle"><?=$Case->barcode?></td>
                                        <td valign="middle"><?=$Case->case_no?></td>
                                        <td valign="middle"><?=$Case->case_name?></td>
                                        <td valign="middle"><?=$Case->case_type_id?></td>
                                        <td valign="middle"><?=$Case->case_year?></td>
                                        <td class="text-end" valign="middle">
                                        <button class="btn btn-sm btn-theme">Accept</button>
                                        </td>
                                        
                                    </tr>
                                    <?php
                                }}
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