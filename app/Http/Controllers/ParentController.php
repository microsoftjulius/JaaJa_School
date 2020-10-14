<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParentInformation;

class ParentController extends Controller
{
    //
    /** 
     * This function creates parents information
    */
    private function createParent(){
        $parent_information =new ParentInformation;
        $parent_information->parent_name =request()->parent_name;
        $parent_information->contact     =request()->contact;
        $parent_information->location    =request()->location;
        $parent_information->save();
        return Redirect()->back()->withErrors("Parent Information has been Captured successfully");
    }
    /** 
     * This function fetches all the parents details
    */
    protected function getParent(){
        $parent_information =ParentInformation::get();
        return view('admin.parent', compact('parent_information'));
    }
     /** 
     * This function edits the student information
    */
    protected function editParentInformation($id){
        ParentInformation::where('id',$id)->update(array(
            'parent_name' =>'Ociba James',
            'contact'     =>'0775401793',
            'location'    =>'Nsambya'
        ));
        return Redirect()->back()->withErrors("Parent Information has been updated successfully");
    }
     /** 
     * This function deletes parents information softly
    */
    protected function deleteParent($id){
        ParentInformation::where('id',$id)->update(array( 'status' => 'deleted'));
        return Redirect()->back()->withErrors("Parent has been deleted successfully");
    }
    /** 
     * This function validates the parents information created
    */
    protected function validateCreateParent(){
        if(empty(request()->parent_name)){
            return redirect()->back()->withErrors('Parent Name is required, please fill it to continue');
        }elseif(empty(request()->contact)){
            return redirect()->back()->withErrors('Contact is required, please fill it to continue');
        }elseif(empty(request()->location)){
            return redirect()->back()->withErrors('Location is required, please fill it to continue');
        }else{
            return $this->createParent();
        }
    }
}
