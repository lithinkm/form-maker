<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Form;
use App\Models\Option;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function list(Request $request,$id=''){
        $form ='';
        if($id){
            $form = Form::where('id',$request->id)->first();
        }
        $forms  = Form::paginate();
        return view('admin.showForms')->with(['forms' => $forms,'form'=>$form]);
    }
    public function save(Request $request){
        try {
            if($request->id){
                $form = Form::find($request->id);
            }else{
                $form = new Form();
                $form->code = time() . rand(111, 999);
            }
            if($request->type[0]!='' && isset($request->name)){
                $form->name = $request->name;
                if($form->save()){
                    if($request->id){
                        $field = Field::where('form',$form->id)->delete();
                    }
                    for($x=0;$x<count($request->type);$x++){
                        $field = new Field();
                        $field->form = $form->id;
                        $field->type = $request->type[$x];
                        $field->label = $request->display_name[$x];
                        if($request->type[$x] != 'select'){
                            $field->placeholder = $request->placeholder[$x];
                            $field->length = $request->length[$x];
                        }
                        $field->save();
                        if($request->type[$x] == 'select'){
                            $option = new Option();
                            $option->field = $field->id;
                            $option->name = $request->option[$x];
                            $option->save();
                        }
                    }
                    if($request->id){
                        return redirect('admin/forms')->with('message', 'Form updated successfully');
                    }
                    return redirect()->back()->with('message', 'Form added successfully');
                }else{
                    return redirect()->back()->with('message', 'Something went wrong');
                }
            }else{
                return redirect()->back()->with('message', 'Please fill all the fields');
            }
        } catch (\Exception  $e) {
            // print_R($e->getMessage()); exit;
            return redirect()->back()->with('message', 'Something went wrong.');
        }

    }
    public function delete($id){
        try {
            $form = Form::find($id);
            $field = Field::where('form',$id)->delete();
            $form->delete();
            return redirect()->back()->with('message', 'Form deleted successfully');
        } catch (\Exception  $e) {
            // print_R($e->getMessage());exit;
            return redirect()->back()->with('message', 'Could not delete');
        }

    }
}
