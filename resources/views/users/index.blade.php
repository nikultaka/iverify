@include('panel.header')
@include('panel.sidebar')


<!-- partial -->
<div class="main-panel">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">Users</div>
                            <div class="card-body">
                                <a href="{{url('add_user')}}" class="btn btn-success btn-sm" title="Add New Contact">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                                <br />
                                <br />
                                <div class="table-responsive">
                                    <table class="table" id="userTable">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
<script src="{{asset('assets/js/user.js')}}"></script>


<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
@include('panel.footer')