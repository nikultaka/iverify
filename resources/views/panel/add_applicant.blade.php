@include('panel.header')
@include('panel.sidebar')


<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <form action="" onsubmit="return false" method="post" id="applicationform" name="applicationform" enctype="multipart/form-data" class="forms-sample">
      <!-- {!! Csrf_field() !!} -->
      <input type="hidden" name="h_id" id="h_id" value="{{isset($data->id) ? $data->id : ''}}">
      @csrf
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Personal Information</h4>

              <div class="form-group">
                <label for="exampleInputUsername1">FirstName</label>
                <input type="text" class="form-control" name="FirstName" value="{{isset($data->FirstName) ? $data->FirstName : ''}}" placeholder="First Name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">SecondName</label>
                <input type="text" class="form-control" name="SecondName" value="{{isset($data->SecondName) ? $data->SecondName : ''}}" placeholder="Second Name">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Surname</label>
                <input type="text" class="form-control" name="Surname" value="{{isset($data->Surname) ? $data->Surname : ''}}" placeholder="Surname">

              </div>
              <div class="form-group">
                <label for="exampleInputConfirmPassword1">Gender</label>
                <select class="form-control w-100" id="Gender" name="Gender">
                  <option value="" disabled>Select Gender</option>
                  <option value="male" {{isset($data->Gender) && $data->Gender == 'male' ? "selected" : ''}}>Male</option>
                  <option value="female" {{isset($data->Gender) && $data->Gender == 'female' ? "selected" : ''}}>Female</option>

                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputConfirmPassword1">ID Number</label>
                <input type="text" class="form-control" id="IDNumber" name="IDNumber" value="{{isset($data->IDNumber) ? $data->IDNumber : ''}}" placeholder="ID Number">
              </div>
              <div class="form-group">
                <label for="exampleInputConfirmPassword1">Date Of Birth</label>
                <input type="date" class="form-control" name="dob" value="{{isset($data->dob) ? $data->dob : ''}}" placeholder="Date Of Birth">
              </div>

              <div class="form-group">
                <div style="display: flex;align-items: center;justify-content: space-between;">
                  <label for="exampleInputConfirmPassword1">Merital Status</label>
                  <div style="display: flex;align-items: center;gap: 10px;">
                    <input type="radio" class="form-control" name="merital_status" value="yes" {{isset($data->merital_status) && $data->merital_status == 'yes' ? "checked" : ''}}> Yes </input>
                    <input type="radio" class="form-control" name="merital_status" {{isset($data->merital_status) && $data->merital_status == 'no' ? "checked" : ''}} value="no"> No</input>
                  </div>
                </div>
                <label id="merital_status-error" class="error" for="merital_status"></label>
              </div>

              <div class="form-group">
                <div style="display: flex;align-items: center;justify-content: space-between;">
                  <label for="exampleInputConfirmPassword1">Is the applicant the head of the household ?</label>
                  <div style="display: flex;align-items: center;gap: 10px;">
                    <input type="radio" class="form-control" id="is_house_hold_yes" name="is_house_hold" value="yes" {{isset($data->is_house_hold) && $data->is_house_hold == 'yes' ? "checked" : ''}}> Yes </input>
                    <input type="radio" class="form-control" id="is_house_hold_no" name="is_house_hold" value="no" {{isset($data->is_house_hold) && $data->is_house_hold == 'no' ? "checked" : ''}}> No</input>
                  </div>
                </div>
                <label id="is_house_hold-error" class="error" for="is_house_hold"></label>
              </div>
              @php
              $is_h_s = isset($data->is_house_hold) && $data->is_house_hold == 'no' ? 'block' : 'none';
              @endphp
              <div id="household_data" style="display: <?php echo $is_h_s; ?>">
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Household First Name</label>
                  <input type="text" class="form-control" name="household_first_name" value="{{isset($data->household_first_name) ? $data->household_first_name : ''}}" placeholder="Household First Name">
                </div>

                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Household Last Name</label>
                  <input type="text" class="form-control" name="household_last_name" value="{{isset($data->household_last_name) ? $data->household_last_name : ''}}" placeholder="Household Last Name">
                </div>

                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Household Relation</label>
                  <input type="text" class="form-control" name="household_relation" value="{{isset($data->household_relation) ? $data->household_relation : ''}}" placeholder="Household Relation">
                </div>
              </div>

              <div class="form-group">
                <div style="display: flex;align-items: center;justify-content: space-between;">
                  <label for="exampleInputConfirmPassword1">Does the household head have dependant ?</label>
                  <div style="display: flex;align-items: center;gap: 10px;">
                    <input type="radio" class="form-control" id="is_dependant_yes" {{isset($data->is_dependant) && $data->is_dependant == 'yes' ? "checked" : ''}} name="is_dependant" value="yes"> Yes </input>
                    <input type="radio" class="form-control" id="is_dependant_no" {{isset($data->is_dependant) && $data->is_dependant == 'no' ? "checked" : ''}} name="is_dependant" value="no"> No</input>
                  </div>
                </div>
                <label id="is_dependant-error" class="error" for="is_dependant"></label>
              </div>

              @php
              $is_d_s = isset($data->is_dependant) && $data->is_dependant == 'yes' ? 'block' : 'none';
              @endphp

              <div id="dependant_data" style="display: <?php echo $is_d_s; ?>">
                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Dependant First Name</label>
                  <input type="text" class="form-control" name="dependant_first_name" value="{{isset($data->dependant_first_name) ? $data->dependant_first_name : ''}}" placeholder="dependant First Name">
                </div>

                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Dependant Last Name</label>
                  <input type="text" class="form-control" name="dependant_last_name" value="{{isset($data->dependant_last_name) ? $data->dependant_last_name : ''}}" placeholder="dependant Last Name">
                </div>

                <div class="form-group">
                  <label for="exampleInputConfirmPassword1">Dependant Relation</label>
                  <input type="text" class="form-control" name="dependant_relation" value="{{isset($data->dependant_relation) ? $data->dependant_relation : ''}}" placeholder="dependant Relation">
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Address Information</h4>

              <!-- <form class="forms-sample"> -->
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="address" value="{{isset($data->address) ? $data->address : ''}}" placeholder="Address">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Stund type</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="Standtype" value="{{isset($data->Standtype) ? $data->Standtype : ''}}" placeholder="Stand type">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputMobile" class="col-sm-3 col-form-label">ward num</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="wardnum" value="{{isset($data->wardnum) ? $data->wardnum : ''}}" placeholder="ward num">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">town</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="town" value="{{isset($data->town) ? $data->town : ''}}" placeholder="town">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">postal code</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="postalcode" value="{{isset($data->postalcode) ? $data->postalcode : ''}}" placeholder="postal code">
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">suburbs name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="suburbs" value="{{isset($data->suburbs) ? $data->suburbs : ''}}" placeholder="suburbs name">
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Contect Information</h4>


              <!-- <form action="{{url('upload_applicant')}}" method="post" class="forms-sample">
              {!! Csrf_field() !!} -->
              <div class="form-group">
                <label for="exampleInputUsername1">Cellphone Number</label>
                <input type="text" class="form-control" name="cellphone_number" value="{{isset($data->cellphone_number) ? $data->cellphone_number : ''}}" placeholder="Cellphone Number">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Cellphone Number 2</label>
                <input type="text" class="form-control" name="cellphone_number2" value="{{isset($data->cellphone_number2) ? $data->cellphone_number2 : ''}}" placeholder="Cellphone Number 2">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Work Tel Number</label>
                <input type="text" class="form-control" name="work_tel_number" value="{{isset($data->work_tel_number) ? $data->work_tel_number : ''}}" placeholder="Work Tel Number">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Document Upload</h4>


              <!-- <form action="{{url('upload_applicant')}}" method="post" class="forms-sample"> -->
              <!-- {!! Csrf_field() !!} -->
              <div class="form-group">
                <label for="exampleInputUsername1">Documents Upload</label>
                <input type="file" id="documnet" class="form-control" name="documnet[]" multiple>
              </div>
              <?php
              if (isset($images) && !empty($images)) { ?>
                <ol>
                  <?php foreach ($images as $img) { ?>
                    <li><a target="_blank" href="{{asset('uploads/applicant/').'/'.$img['name']}}">{{$img['name']}}</a></li>
                  <?php
                  } ?>
                </ol>

              <?php }

              ?>

              <!-- <a target="_blank" href="{{asset('uploads/applicant/66665.pdf')}}">djjd</a> -->
            </div>
          </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Source of income</h4>
              <div class="form-group">

                <select class="js-example-basic-single form-control w-100" id="sourceOfIncom" name="sourceOfIncom">
                  <option {{isset($data->sourceOfIncom) && $data->sourceOfIncom == 'salary' ? "selected" : ''}} value="salary">Salary</option>
                  <option {{isset($data->sourceOfIncom) && $data->sourceOfIncom == 'bussiness' ? "selected" : ''}} value="bussiness">bussiness</option>
                  <option {{isset($data->sourceOfIncom) && $data->sourceOfIncom == 'other' ? "selected" : ''}} value="other">other</option>

                </select>
              </div>
              <div class="form-group">
                <label>company/employer name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" value="{{isset($data->employername) ? $data->employername : ''}}" name="employername" placeholder="employername">
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Observation</h4>


              <!-- <form action="{{url('upload_applicant')}}" method="post" class="forms-sample">
              {!! Csrf_field() !!} -->
              <div class="form-group">
                <div style="display: flex;justify-content: space-between;align-items: center;">
                  <label for="exampleInputUsername1">Flag suspicious application</label>
                  <input style="width: 10%;" type="checkbox" class="form-control" id="flag" name="flag" value="flag" {{isset($data->flag) ? 'checked' : ''}}>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Comments</label>
                <textarea id="Comments" name="Comments" class="form-control" rows="4" cols="50">{{isset($data->Comments) ? $data->Comments : ''}}</textarea>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Optional info</h4>

              <div class="form-group row">
                <div class="col">
                  <label>work department</label>
                  <div id="the-basics">
                    <input type="text" class="form-control" value="{{isset($data->department) ? $data->department : ''}}" name="department" placeholder="employername">
                  </div>
                </div>
                <div class="col">
                  <label>employer contact</label>
                  <div id="bloodhound">
                    <input type="text" class="form-control" value="{{isset($data->emplcontactn) ? $data->emplcontactn : ''}}" name="emplcontactn" placeholder="employername">
                  </div>
                </div>
              </div>
              <input type="submit" value="Save" class="btn btn-success w-100"></br>
            </div>
          </div>
        </div>

      </div>
    </form>

  </div>

  <script src="{{asset('assets/js/application.js')}}"></script>

  @include('panel.footer')