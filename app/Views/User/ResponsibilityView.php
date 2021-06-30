<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User Responsibility</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<section class="d-flex flex-column">
    <div class="spacer"></div>
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="d-flex">
                <div class="p-2">
                   User Table
                </div>
                <div class="ml-auto p-2">
                    <a href="#" class="btn btn-primary btn-sm btn-circle" id="btnAddModal" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-user-plus fa-sm"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive-sm table-responsive-lg table-responsive-xl">
                <table class="table table-striped table-hover" id="resTable">
                    <caption>List of users</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Responsibility</th>
                            <th scope="col">Module Codes</th>
                            <th scope="col" class="action-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add new responsibility</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type='hidden' class="form-control" id="txtResID"> 
                <input type='text' class="form-control" id="txtResName" placeholder="Responsibility Name">  
                <div class="spacer"></div>
                <nav class="nav nav-pills nav-fill">
                    <a class="nav-item nav-link active" data-toggle="pill" href="#um">User Management</a>
                    <a class="nav-item nav-link" data-toggle="pill" href="#app">Annual Procurement Plan</a>
                    <a class="nav-item nav-link" data-toggle="pill" href="#wfp">Work Financial Plan</a>
                    <a class="nav-item nav-link" data-toggle="pill" href="#ppmp">Project Procurement Management Plan</a>
                </nav>
                <div class="spacer"></div>
                <div class="tab-content">
                    <div class="tab-pane container active" id="um">
                        <div class="row">
                            <label>
                                <input class='chkUsers' type='checkbox' id='chkUsersID' value="chkUser">
                                <span><span>User Management</span></span>
                            </label>                                                    
                        </div>
                        <?php foreach($userLinks as $key => $row){?>
                            <div class="row margin-15px">
                                <label>
                                    <input class='chkUsers' id='<?php echo $row["code"]?>' name='chkFormFunction' type='checkbox' value='<?php echo $row["code"]?>'>
                                    <span><span><?php echo $row['form_function']?></span></span>
                                </label>  
                            </div>
                        <?php }?>
                    </div>
                    <div class="tab-pane container fade" id="app">Annual Procurement Plan</div>
                    <div class="tab-pane container fade" id="wfp">Work Financial Plan</div>
                    <div class="tab-pane container fade" id="ppmp">Project Procurement Management Plan</div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-secondary shadow-sm" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-sm btn-success shadow-sm" id="btnAdd">Save</a>
                <a class="btn btn-sm btn-success shadow-sm" id="btnUpdate">Update</a>
            </div>
            <div class="alert"><p class="alert-message"></p></div>
            <?= csrf_field() ?>
        </div>
    </div>
</div>
<script  src = "<?php echo base_url();  ?>/assets/js/modules/user/ResponsibilityActions.js"></script>