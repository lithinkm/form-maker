<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Storage;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome() {
        $forms = Form::orderBy('created_at','DESC')->get();
        $data['forms'] = $forms;
        return view('web.showHome',$data);
    }
    public function viewForm(Request $request, $id) {
        $data['form'] = Form::where('code',$id)->first();
        $data['storages'] = Storage::where('form',$data['form']->id)->get();
        return view('web.viewForm',$data);
    }
    public function save(Request $request){
        try {
            $store = New Storage();
            $field_json = $_POST;
            unset($field_json['_token']);
            unset($field_json['id']);
            $field_json_data =  json_encode($field_json);
            $store->data = $field_json_data;
            $store->form = $request->id;
            $store->save();
            return redirect()->back()->with('message', 'Data saved successfully');
        } catch (\Exception  $e) {
            return redirect()->back()->with('message', 'Something went wrong.');
        }
    }
}
