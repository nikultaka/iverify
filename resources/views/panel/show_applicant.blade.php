@include('panel.header')
@include('panel.sidebar')


<!-- partial -->
<div class="main-panel">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Applicants</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">Applicant</div>
                            <div class="card-body">
                                <!-- <a href="{{url('add_applicant')}}" class="btn btn-success btn-sm" title="Add New Contact">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a> -->
                                <button  type="button" id="add_applicant" class="btn btn-success btn-sm" title="Add New Contact">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </button>
                                <br />
                                <br />
                                <div class="table-responsive">
                                    <table class="table" id="applicantTable">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Second Name</th>
                                                <th>Surname</th>
                                                <th>ID Number</th>
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
    <script src="{{asset('assets/js/application.js')}}"></script>

    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    @include('panel.footer')