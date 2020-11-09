<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDashboardBlade()
    {
        $file_logs = $this->getFileLogs();
        $all_users = User::where('id','!=',auth()->user()->id)->get();
        $number_of_students = $this->countnumberOfStudents();
        $number_of_parents = $this->countNumberOfParents();
        $number_of_offline_users = $this->countOfflineMembers();
        $number_of_online_users  = $this->countOnlineMembers();
        return view('admin.index',compact('all_users','number_of_parents','number_of_students','number_of_offline_users','number_of_online_users',
        'file_logs'));
    }

    /**
     * This function gets the logs of all files uploaded
     */
    private function getFileLogs(){
        $home_work_logs = $this->getHomeWorkLogs();
        $questions_logs = $this->getQuestionsLogs();
        $notes_logs     = $this->getNotesLogs();
        $merge_homework_and_questions = $home_work_logs->merge($questions_logs);
        $then_add_notes = $merge_homework_and_questions->merge($notes_logs);
        return $then_add_notes;
    }
    /**
     * This function gets the collection of uploaded homework
     */
    private function getHomeWorkLogs(){
        return DB::table('homework')->join('teachers','teachers.teachers_login_id','homework.teacher_id')
        ->join('subjects','subjects.id','homework.subject_id')
        ->join('levels','levels.id','homework.level_id')
        ->get();
    }

    /**
     * This function gets the questions logs
     */
    private function getQuestionsLogs(){
        return DB::table('questions')->join('teachers','teachers.teachers_login_id','questions.teacher_id')
        ->join('subjects','subjects.id','questions.subject_id')
        ->join('levels','levels.id','questions.class_id')
        ->get();
    }

    /**
     * This function gets the notes logs
     */
    private function getNotesLogs(){
        return DB::table('notes')->join('teachers','teachers.teachers_login_id','notes.teacher_id')
        ->join('subjects','subjects.id','notes.subject_id')
        ->join('levels','levels.id','notes.level_id')
        ->get();
    }

    /**
     * This function logs out a user
     */
    protected function logout(){
        User::where('id',auth()->user()->id)->update(array( 'user_online' => 'false' ));
        Auth::logout();
        return redirect('/');
    }

    /**
     * This function counts the number of parents
     */
    private function countNumberOfParents(){
        return DB::table('parent_information')->count();
    }

    /**
     * This function counts the number of students
     */
    private function countnumberOfStudents(){
        return DB::table('students')->count();
    }

    /**
     * This function counts the number of offline members
     */
    private function countOfflineMembers(){
        return User::where('user_online','false')->count();
    }

    /**
     * This function counts the number of online members
     */
    private function countOnlineMembers(){
        return User::where('user_online','true')->count();
    }

    /**
     * This function gets the change password form
     */
    protected function getChangePasswordForm(){
        $all_users = User::where('id','!=',auth()->user()->id)->get();
        return view('admin.change_password_form',compact('all_users'));
    }

    /**
     * This function validates the user password being changed
     */
    protected function validateUserPassword(){
        if(empty(request()->current_password)){
            return redirect()->back()->withErrors("Please enter your current password to proceed");
        }elseif(empty(request()->new_password)){
            return redirect()->back()->withErrors("Please enter the new password to proceed");
        }elseif(empty(request()->confirm_password)){
            return redirect()->back()->withErrors("Please confirm your password to proceed");
        }elseif(request()->new_password != request()->confirm_password){
            return redirect()->back()->withErrors("Please make sure the two passwords match");
        }elseif(Hash::check(request()->new_password, User::find(Auth::user()->id)->password)){
            return Redirect()->back()->withErrors("You can't reuse this password, kindly choose a password you haven't used before");
        }elseif(Hash::check(request()->current_password, User::find(Auth::user()->id)->password)){
            return $this->updateUserPassword();
        }else{
            return redirect()->back()->withErrors("The password you entered is wrong, enter a correct password to proceed")->withInput();
        }
    }

    /**
     * This function does the actual password update
     */
    private function updateUserPassword(){
        $new_password = request()->new_password;
        $this->realPasswordUpdate($new_password);
        Auth::logout();
        return redirect('/login')->with('msg', 'Password was Updated successfully, kindly login now');
    }

    /**
     * update the password
     */
    private function realPasswordUpdate($new_password){
        User::where('id',auth()->user()->id)->update(array(
            'password' => Hash::make($new_password)
        ));
    }
}
