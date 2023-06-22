@include('panel.header')
@include('panel.sidebar')

<?php

// echo '<pre>';
// print_r($userDetails);
// die;

?>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex;justify-content: space-between;align-items: center;">
                            <h4 class="card-title"><?php echo $id !== null ? "Update User" : "Add User" ?></h4>
                            <a class="btn btn-info" href="{{url('users')}}">Back</a>
                        </div>
                        <form method="post" class="forms-sample" id="addUserForm" name="addUserForm" onsubmit="return false">
                            {!! Csrf_field() !!}
                            <input type="hidden" id="userId" name="userId" value="{{isset($userDetails['id']) ? $userDetails['id'] : '' }}">
                            <div class="form-group">
                                <label for="exampleInputUsername1">First Name</label>
                                <input type="text" value="{{isset($userDetails['name']) ? $userDetails['name'] : '' }}" class="form-control" name="firstname" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" value="{{isset($userDetails['last_name']) ? $userDetails['last_name'] : '' }}" name="lastname" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="text" class="form-control" value="{{isset($userDetails['email']) ? $userDetails['email'] : '' }}" <?php echo isset($id) && $id !== null ? "readonly" : "" ?> name="email" placeholder="Email">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="" selected disabled>Select Role</option>
                                    <option value="USER" {{ isset($userDetails['role']) && $userDetails['role'] == 'USER' ? 'selected' : '' }}>User</option>
                                    <option value="ADMIN" {{ isset($userDetails['role']) && $userDetails['role'] == 'ADMIN' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <input type="submit" value="Save" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/user.js')}}"></script>






    @include('panel.footer')