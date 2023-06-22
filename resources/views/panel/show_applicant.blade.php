@include('panel.header')
@include('panel.sidebar')


<!-- partial -->
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Striped Table</h4>
            <p class="card-description">
                Add class <code>.table-striped</code>
            </p>


            <div class="row">
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">Applicant</div>
                        <div class="card-body">
                            <a href="{{url('add_applicant')}}" class="btn btn-success btn-sm" title="Add New Contact">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                            </a>
                            <br />
                            <br />
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID Number</th>
                                            <th>First Name</th>
                                            <th>Second Name</th>
                                            <th>Surname</th>
                                            <th>Student ID</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($applicant as $item)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->FirstName }}</td>
                                            <td>{{ $item->SecondName }}</td>
                                            <td>{{ $item->Surname }}</td>
                                            <td>{{ $item->IDNumber}} </td>
                                            <td>{{ $item->address1 }}</td>

                                            <td>
                                                <a href="{{url('add_applicant',$item->id)}}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Edit</button></a>

                                                <a href="{{url('deleteApplicant',$item->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> delete</button></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    @include('panel.footer')