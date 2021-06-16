<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User Actions</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> 
        Generate Report
    </a>
</div>

 
<section class="d-flex flex-column">

    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="d-flex no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                       Total Employee
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                </div>
                <div class="col-auto">
                    <a href="#" class="d-none d-sm-inline-block btn btn-lg btn-success shadow-sm">
                        <i class="fas fa-arrow-left fa-sm"></i>
                    </a>
                    <a href="#" class="d-none d-sm-inline-block btn btn-lg btn-success shadow-sm">
                        <i class="fas fa-arrow-right fa-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="d-flex">
                <div class="p-2">
                    1 - 10
                </div>
                <div class="ml-auto p-2">
                    <a href="#" class="btn btn-primary btn-sm btn-circle" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-user-plus fa-sm"></i>
                    </a>
                </div>
            </div>
            <div class="row no-gutters align-items-center" style="overflow:auto !important">
                <table class="table">
                    <caption>List of users</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            <th scope="col">Handle</th>
                            <th scope="col">Handle</th>
                            <th scope="col" class="action-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            <td class="action-center">
                                <a href="#" class="btn btn-info btn-sm btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-circle">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<!-- Logout Modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add new user</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="b-username">
                                    <i class="fas fa-users"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="b-username">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="b-user_id">
                                    <i class="fas fa-id-card-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Employee Number" aria-label="b-user_id" aria-describedby="b-user_id">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="b-password">
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="b-password">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected>Choose access level . . .</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" type="button" data-dismiss="modal">Cancel</button>
                <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" href="Logout">Save</a>
            </div>
        </div>
    </div>
</div>
