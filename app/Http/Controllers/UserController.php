<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (!$request->isMethod('post')) {

            return view('users.index');
        }

        if ($request->ajax() && $request->isMethod('post')) {

            $users = User::select('*')
                ->get()->toArray();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $action =  '<a href="' . url("/add_user", $row['id']) . '"  title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Edit</button></a>';

                    $action .= '<button  onclick="deleteUser(' . $row['id'] . ')" class=" ml-2 btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Delete</button>';

                    return $action;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addUserForm(Request $request, $id = null)
    {

        if (!$request->isMethod('post')) {

            $userDetails = null;

            if ($id !== null) {
                $userDetails =  User::where('id', $id)->first();
            }

            return view('users.add_user', compact('userDetails', 'id'));
        }

        if ($request->ajax() && $request->isMethod('post')) {

            $post = $request->all();

            $validation = Validator::make($request->all(), [
                'firstname'               => 'required',
                'lastname'                => 'required',
                'role'                     => 'required',
            ]);

            if (isset($post['userId']) && $post['userId'] != '') {
                $validation->email   = 'required|email';

                if (isset($post['password']) && $post['password'] != '') {
                    $validation->password   = 'required|min:8|max:20';
                }
            } else {
                $validation->email   = 'required|email|unique:users';
                $validation->password   = 'required|min:8|max:20';
            }


            if ($validation->fails()) {
                $data['status'] = -1;
                $data['message'] = $validation->errors()->all();
                echo json_encode($data);
                exit();
            }



            $response['status'] = 0;
            $response['message'] = 'Oops! User Not Saved';


            if (isset($post['userId']) && $post['userId'] !== null) {

                $updateUser = User::where('id', $post['userId'])->first();
                $updateUser->name = $post['firstname'];
                $updateUser->last_name = $post['lastname'];
                $updateUser->email = $post['email'];
                $updateUser->usertype = $post['role'];
                $updateUser->updated_at = Carbon::now();

                if (isset($post['password']) && $post['password'] !== null) {
                    $updateUser->password = Hash::make($post['password']);
                }

                $updateUser->role = $post['role'];
                $updateUser->save();

                if ($updateUser) {
                    $response['status'] = 1;
                    $response['message'] = 'User Updated Successfully!';
                }
            } else {

                $insertUser = new User;
                $insertUser->name = $post['firstname'];
                $insertUser->last_name = $post['lastname'];
                $insertUser->usertype = $post['role'];
                $insertUser->email = $post['email'];
                $insertUser->password = Hash::make($post['password']);
                $insertUser->role = $post['role'];
                $insertUser->created_at = Carbon::now();
                $insertUser->save();

                if ($insertUser->id) {
                    $response['status'] = 1;
                    $response['message'] = 'User Created Successfully!';
                }
            }

            echo json_encode($response);
            exit();
        }
    }

    public function emailExistOrNot(Request $request)
    {
        $count = User::where('email', '=', $request->email);
        if ($request->input('hid') > 0) {
            $count->where('id', '!=', $request->input('hid'));
        }
        $count = $count->count();

        if ($count > 0) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function deleteUser(Request $request)
    {
        $response['status'] = 0;
        $response['message'] = 'Oops! User Not Deleted';

        $delete_id = $request->input('id');

        if ($delete_id != "" && $delete_id != null) {
            $delete = User::where('id', $delete_id)->delete();
            if ($delete) {
                $response['status'] = 1;
                $response['message'] = "User deleted successfully.";
            }
        }
        echo json_encode($response);
        exit();
    }
}
