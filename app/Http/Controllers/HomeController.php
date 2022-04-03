<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome() {
        $forms = Form::orderBy('created_at','DESC')->get();
        $data['forms'] = $forms;
        return view('web.showHome',$data);
    }
    public function viewForm(Request $request, $id) {
        $strArray = explode('-',$id);
        $code = end($strArray);
        $data['form'] = Form::where('code',$code)->first();
        return view('web.viewForm',$data);
    }
    public function save(Request $request){

        return redirect()->back()->with('message', 'Data saved successfully');
    }
}
