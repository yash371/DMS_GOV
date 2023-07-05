<?php
include_once('Layout/header.php');
?>

<div id="content" class="app-content">
     <div class="row g-3">
     <div class="col-md-12">
        <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <span class="flex-grow-1 fs-4">Case Assignment</span>
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
                                <td>Assignment</td>
                                <td class="text-end">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($case_bucket)){
                                foreach($case_bucket as $key=>$Case){
                                    ?>
                                     <form action="case_assignment_post"  id="assign" method="post" accept-charset="utf-8">
                                    <tr style="background: rgba(0,0,0,0.5);">
                                        <td valign="middle"><?=$key+1?></td>
                                        <td valign="middle"><?=$Case->barcode?></td>
                                        <td valign="middle"><?=$Case->case_no?></td>
                                        <td valign="middle"><?=$Case->case_name?></td>
                                        <td valign="middle"><?=$Case->case_type_id?></td>
                                        <td valign="middle"><?=$Case->case_year?></td>
                                        <td class="text-end">
                                           
                                                <input type="hidden" name="case_id" value="<?=$Case->case_id?>"/>
                                            <select name="user_id"  class="form-select"  required>
                                            <option value="">---Allocate---</option>
                                            <?php
                                            if(!empty($users)){
                                                foreach($users as $key=>$user){
                                                    ?>
                                                    <option  value="<?=$user->user_id?>"><?=$user->fname." ".$user->middle_name." ".$user->surname?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </select>
                                           
                                           
                                    </td>
                                    <td>
                                    <button type="submit" class="btn btn-sm btn-theme">Save</button>
                                    </td>
                                    </tr>
                                    </form>
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