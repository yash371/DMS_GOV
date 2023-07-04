<!-- Header -->
<?php include 'Layout/header.php'; ?>
<div id="content" class="app-content">
    <!-- ============================================= -->

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <span class="flex-grow-1 fs-4">
                        <?= $update ?"Update Employee ":"Create Employee "?>
                        </span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>
                    
                    <form action="<?=$update ?'update_employee':'add_employee_post'?>"  id="myform" method="post" accept-charset="utf-8">
                        
                        <input type="hidden" name="reg_no" value="<?=$update ? $user_data[0]->regd_no:$reg_no?>" />
                        <?php
                        if($update){
                            echo "<input type='hidden' name='user_id' value='{$user_data[0]->user_id}' />";
                        }
                        ?>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Register No" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end bg-dark" type="text"
                                    value="<?=$update ? $user_data[0]->regd_no:$reg_no?>" disabled required /></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="First-Name" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end" type="text"
                                    placeholder="Employee FirstName" value="<?=$update? $user_data[0]->fname:""?>" name="emp_firstname" required /></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Mid-Name" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end" type="text"
                                    placeholder="Employee MiddleName" value="<?=$update? $user_data[0]->middle_name:""?>" name="emp_middlename" /></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Last-Name" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end" type="text"
                                    placeholder="Employee LastName" value="<?=$update? $user_data[0]->surname:""?>" name="emp_lastname" required /></div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Username" disabled /></div>
                            <div class="col-8 p-0">
                                <div class="input-group flex-nowrap">
                                    <input type="text" class="form-control rounded-0 rounded-end bg-dark"
                                        name="file_prefix" value="<?=$update ? $user_data[0]->regd_no:$reg_no?>" disabled required />
                                    <!-- <span class="input-group-text bg-dark"></span> -->
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Gender" disabled /></div>
                            <div class="col-8 p-0">
                                <select class="form-select rounded-0 rounded-end" name="gender" required>
                                    <option selected="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                    <?=$update ? "<option selected>{$user_data[0]->gender}</option>": ""?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Department" disabled /></div>
                            <div class="col-8 p-0">
                                <select class="form-select rounded-0 rounded-end" name="department" required>
                                    <option  value="2">Master</option>  
                                    <option  selected value="3">Scanner</option>
                                    <option value="4">Image QC</option>
                                    <?php
                                    if($update){
                                        switch($user_data[0]->dept_id){
                                            case 2:$depart= "Master";break;
                                case 3:$depart="Scanner";break;
                                case 4:$depart="Image QC";break;
                                default:$depart="Call Devloper";
                                        }
                                    }
                                    ?>
                                    <?php
                                    if($update){
                                        echo "<option selected value={$user_data[0]->dept_id}>{$depart}</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Mail" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-en" type="text"
                                    placeholder="Mail ID" name="mail" value="<?=$update ? $user_data[0]->email :""?>" required /></div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Password" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end " type="password"
                                    name="password" placeholder="Password" value="<?=$update ? $user_data[0]->password:""?>" required /></div>
                        </div>





                        <div class="row mb-3">
                            <div class="col-4 p-0"><input class="form-control rounded-0 rounded-start bg-dark"
                                    type="text" value="Mobile No" disabled /></div>
                            <div class="col-8 p-0"><input class="form-control rounded-0 rounded-end " value="<?=$update ? $user_data[0]->mobile:""?>"
                                    type="text" name="mobile" placeholder="Mobile Number" required /></div>
                        </div>

                        <div class="row">
                            <div class="col-12 p-0 text-end"><button class="btn btn-theme" name="add_employee"
                                    type="submit"><?=$update?"Update":"Create"?></button></div>
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


        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <span class="flex-grow-1 fs-4">List of Employee</span>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Data Entry</a></li>
                                <li><a class="dropdown-item" href="#">Scanner</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">QC & Validation</a></li>
                            </ul>
                        </li>
                        <form class="d-flex" style="margin: 0 10px;">
                            <input class="form-control me-2" type="search" name="search_query" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" name="search" type="submit">Search</button>
                        </form>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i
                                class="bi bi-fullscreen"></i></a>
                    </div>

                    <table class="table table-border" style="border: 1px solid rgba(255,255,255,0.1);">
                        <thead class="table-dark">
                            <tr>
                                <td>Sl No</td>
                                <td>Emp Name</td>
                                <td>Username</td>
                                <td>Password</td>
                                <td>Department</td>
                                <td class="text-end">Actions</td>
                            </tr>
                        </thead>
                        <?php
                        if(!empty($listOfUser)){
                            foreach($listOfUser as $key=>$emp){
                                ?>
                                <tr>
                            <td><?=$key+1?></td>
                            <td><?=$emp->fname?></td>
                            <td><?=$emp->username?></td>
                            <td><?=$emp->password?></td>
                            <td><?php switch($emp->dept_id){
                                case 2:echo "Master";break;
                                case 3:echo "Scanner";break;
                                case 4:echo "Image QC";break;
                                default:echo "Call Devloper";

                            }?></td>
                             <td class="text-end"><a href="add_employee?user_id=<?=$emp->user_id?>" class="btn btn-theme">Edit</a></td>
                                </tr>
                                <?php
                            }

                        }else{
                            echo "Empty";
                        }
                        ?>
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





    <!-- ============================================= -->
</div>
<!-- Footer -->
<?php include 'Layout/footer.php'; ?>