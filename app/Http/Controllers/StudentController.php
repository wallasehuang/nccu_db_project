<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Student;
use Redirect;
use Response;
use Validator;
use View;

class StudentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $student = Student::all();
        return view('student.list')->withAction('student')->withStudents($student);
    }

    public function add(){
        return view('student.add')->withAction('add');
    }

    public function add_func(){
        $data  = Input::all();
        $rules = array(
            'studentNo' => 'required|unique:students,studentNo',
            'name' => 'required|max:255',
            'phone' => 'required',
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('student/add')->withErrors($validator, 'add_func');
        } else {
            Student::create([
                'studentNo' => $data['studentNo'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                ]);
        }
        return Redirect::to('student/list');
    }

    public function edit(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $student = Student::find(Input::get('id'));
            return view('student.edit')->withAction('edit')->withStudent($student);
        }
    }

    public function edit_func(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $rules = array(
                'studentNo' => 'required|unique:students,studentNo,'.Input::get('id'),
                'name' => 'required|max:255',
                'phone' => 'required',
                );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::to('student/edit?id='.Input::get('id'))->withErrors($validator, 'edit');
            } else {
                $id = Input::get('id');
                Student::find($id)->update(Input::all());
                return Redirect::to('student/list');
            }

        }
        return Response::json([
            'Message' => 'Success',
            ], 200);
    }

    public function check(){
        if (Input::has('id') == null) {
            $rules = array(
                'studentNo' => 'unique:students,studentNo',
            );
        } else {
            $rules = array(
                'student' => 'unique:students,studentNo,' . Input::get('id'),
            );
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return "false";
        } else {
            return "true";
        }
    }
}
