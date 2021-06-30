<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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
                <table class="table table-striped table-hover" id="userTable">
                    <caption>List of users</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">IIS Employee Number</th>
                            <th scope="col hide_column">Responsibility ID</th>
                            <th scope="col">Responsibility Name</th>
                            <th scope="col" class="action-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add new user</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txtID" class="form-control" placeholder="ID"
                             aria-label="ID" aria-describedby="b-id">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="b-email">
                                    <i class="fas fa-users"></i>
                                </span>
                            </div>
                            <input type="email" id="txtEmail" class="form-control" placeholder="Email"
                             aria-label="Email" aria-describedby="b-email">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="b-user_id">
                                    <i class="fas fa-id-card-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="IIS Employee Number" id="txtIISEmployeeID" aria-label="b-user_id" aria-describedby="b-user_id" onkeyup="number(this);">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="b-password">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" id="txtPassword" aria-label="Password" aria-describedby="b-password">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="Access">Options</label>
                            </div>
                            <select class="custom-select" id="selAccess">
                                <option selected value="">Responsibility . . .</option>
                                <?php foreach($resList as $row){?>
                                    <option value="<?=$row['id']?>"><?=$row['responsibility_name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
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
<script  src = "<?php echo base_url();  ?>/assets/js/modules/user/UserActions.js"></script>
