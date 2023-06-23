<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicant;
use App\Models\ApplicantImage;
use App\Models\User;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use stdClass;


class AdminController extends Controller
{
   public function add_applicant(Request $request, $id = null)
   {
      $data = null;
      $search = '';
      $images = [];
      if ($id !== null) {
         $data = Applicant::where('id', $id)->first();
         $images = ApplicantImage::where('applicant_id', $id)->get()->toArray();
      }
      $search =  $request->input('search');
      if (isset($search) && $search !== '') {
         $data = new stdClass();
         $data->IDNumber =  $search;
      }


      return view('panel.add_applicant')->with(compact('data', 'images'));
   }
   public function show_reg()
   {
      return view('admin.register');
   }

   public function add_user()
   {
      return view('admin.user');
   }
   public function home()
   {
      $totalUser = User::count();
      $totalApplicant = Applicant::count();
      $recentUsers = User::latest()->take(5)->get()->toArray();
      $recentApplicant = Applicant::latest()->take(5)->get()->toArray();

      return view('panel.home')->with(compact('totalUser', 'totalApplicant', 'recentUsers', 'recentApplicant'));
   }

   public function logout()
   {
      return view('auth.login');
   }
   public function show_applicant(Request $request)
   {
      if (!$request->isMethod('post')) {

         return view('panel.show_applicant');
      }

      if ($request->ajax() && $request->isMethod('post')) {

         $applicant = applicant::select('*')
            ->get()->toArray();

         return DataTables::of($applicant)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

               $action =  '<a href="' . url("/add_applicant", $row['id']) . '" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Edit</button></a>';

               $action .= '<button  onclick="deleteApplicant(' . $row['id'] . ')" class=" ml-2 btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Delete</button>';

               return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
      }
   }
   public function show_charts()
   {
      $applicant = applicant::all();
      return view('admin.charts', compact('applicant'));
   }
   public function show_stats()
   {
      $applicant = applicant::all();
      return view('admin.stats', compact('applicant'));
   }
   public function updateApplicant($id)
   {
      $applicant = applicant::find($id);
      return view('admin.editApplicant', compact('applicant'));
   }
   // public function deleteApplicant($id)
   // {
   //    $applicant = applicant::find($id);
   //    $applicant->delete();

   //    return redirect()->back();
   // }

   public function deleteApplicant(Request $request)
   {
      $response['status'] = 0;
      $response['message'] = 'Oops! Applicant Not Deleted';

      $delete_id = $request->input('id');

      if ($delete_id != "" && $delete_id != null) {
         $delete = Applicant::where('id', $delete_id)->delete();
         if ($delete) {
            $response['status'] = 1;
            $response['message'] = "Applicant deleted successfully.";
         }
      }
      echo json_encode($response);
      exit();
   }
   public function upload_applicant(Request $request)
   {
      // echo '<pre>';
      // print_r($request->FirstName);
      // die;


      $res['status'] = 0;
      $res['message'] = "error";
      // $applicant = new applicant;
      $data = $request->all();
      $documnet = isset($data['documnet']) ? $data['documnet'] : [];
      $h_id = $data['h_id'];
      unset($data['h_id']);
      unset($data['documnet']);
      unset($data['_token']);

      if (!isset($data['flag'])) {
         $data['flag'] = null;
      }
      // echo '<pre>';
      // print_r($data);
      // die;

      if ($h_id == '') {
         $save = applicant::insertGetId($data);
      } else {
         if (!empty($documnet)) {
            ApplicantImage::where('applicant_id', $h_id)->delete();
         }
         $update = applicant::where('id', $h_id)->update($data);
         $save = $h_id;
      }
      if ($save) {
         $req['applicant_id'] = $save;
         if (!empty($documnet)) {

            foreach ($documnet as $key => $file) {
               $name = rand(1, 99999) . '.' . $file->getClientOriginalExtension();
               if (!file_exists(public_path('uploads/applicant'))) {
                  mkdir(public_path('uploads/applicant'), 0777, true);
               }
               $file->move(public_path('uploads/applicant'), $name);
               $req["name"] = $name;
               ApplicantImage::insert($req);
            }
         }
         $res['status'] = 1;
         $res['message'] = "success";
      }

      echo json_encode($res);
      exit();
      // $applicant->FirstName = $request->FirstName;
      // $applicant->SecondName = $request->SecondName;
      // $applicant->Surname = $request->Surname;
      // $applicant->IDNumber = $request->IDNumber;
      // $applicant->title = $request->title;
      // $applicant->title = $request->title;
      // $applicant->dob = $request->dob;
      // $applicant->status = $request->status;
      // $applicant->HOH = $request->HOH;
      // $applicant->Standtype = $request->Standtype;
      // $applicant->address1 = $request->address1;
      // $applicant->address2 = $request->address2;
      // $applicant->address3 = $request->address3;
      // $applicant->wardnum = $request->wardnum;
      // $applicant->town = $request->town;
      // $applicant->postalcode = $request->postalcode;
      // $applicant->suburbs = $request->suburbs;

      // $applicant->income = $request->income;
      // $applicant->employername = $request->employername;
      // $applicant->department = $request->department;
      // $applicant->emplcontactn = $request->emplcontactn;

      // $applicant->Gender = $request->Gender;
      // $applicant->dob = $request->dob;



      // $applicant->save();

   }

   public function editApplicant(Request $request, $id)
   {

      $applicant = applicant::find($id);


      $applicant->FirstName = $request->FirstName;
      $applicant->SecondName = $request->SecondName;
      $applicant->Surname = $request->Surname;
      $applicant->IDNumber = $request->IDNumber;
      $applicant->title = $request->title;
      $applicant->title = $request->title;
      $applicant->dob = $request->dob;
      $applicant->status = $request->status;
      $applicant->HOH = $request->HOH;
      $applicant->Standtype = $request->Standtype;
      $applicant->address1 = $request->address1;
      $applicant->address2 = $request->address2;
      $applicant->address3 = $request->address3;
      $applicant->wardnum = $request->wardnum;
      $applicant->town = $request->town;
      $applicant->postalcode = $request->postalcode;
      $applicant->suburbs = $request->suburbs;

      $applicant->income = $request->income;
      $applicant->employername = $request->employername;
      $applicant->department = $request->department;
      $applicant->emplcontactn = $request->emplcontactn;


      $applicant->save();
      return redirect()->back()->with('message', 'Applicant Updated Successful');
   }
}
