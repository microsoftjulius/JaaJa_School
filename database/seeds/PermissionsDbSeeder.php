<?php

use Illuminate\Database\Seeder;
use App\Permissions;

class PermissionsDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_array = [
            "","Can view home dashboard","Can view notes reports","Can view homework reports","Can view questions reports",
            "Can view answers reports","Can delete a class","Can edit a class","Can view homeworks for a class","Can view notes for a class",
            "Can view questions for a class","Can view past papers for a class","Can add a class","Can add a subject","Can delete a subject",
            "Can edit a subject","Can add homework","Can delete a homework","Can view homework","Can edit homework","Can add questions",
            "Can add answers to question for he or she added","Can delete questions","Can edit questions","Can view answers to questions","Can delete notes",
            "Can edit notes","Can add notes","Can view notes page","Can view questions page","Can view homeworks page","Can view classes page",
            "Can view past papers page","Can add past papers","Can delete past papers","Can edit past papers","Can view parents page",
            "Can add parents","Can suspend parents","Can view students page","Can add students","Can suspend students","Can view teachers page",
            "Can add a teacher","Can suspend a teacher","Can activate a teacher","Can activate a student","Can view all users","Can create roles",
            "Can assign permissions to a role","Can delete a role","Can activate parents","Can assign roles to users","Can View Roles and Permissions"
        ];

        for($i=1; $i<count($permissions_array); $i++){
            if(Permissions::where('id',$i)->exists()){
                $i = $i+1;
            }
            $new_permission = new Permissions;
            $new_permission->id = $i;
            $new_permission->Permissions = $permissions_array[$i];
            $new_permission->save();
        }
    }
}
