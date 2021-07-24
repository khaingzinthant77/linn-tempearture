<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'employee-list',
           'employee-create',
           'employee-edit',
           'employee-delete',
           'ro-list',
           'ro-create',
           'ro-edit',
           'ro-delete',
           'offday-list',
           'offday-create',
           'offday-edit',
           'offday-delete',
           'training-list',
           'training-create',
           'training-edit',
           'training-delete',
           'trainingemployee-list',
           'trainingemployee-create',
           'trainingemployee-edit',
           'trainingemployee-delete',
           'trainingattendance-list',
           'trainingattendance-create',
           'trainingattendance-edit',
           'trainingattendance-delete',
           'testresult-list',
           'testresult-create',
           'testresult-edit',
           'testresult-delete',
           'salary-list',
           'salary-create',
           'salary-edit',
           'salary-delete',
           'job-list',
           'job-create',
           'job-edit',
           'job-delete',
           'jobopen-list',
           'jobopen-create',
           'jobopen-edit',
           'jobopen-delete',
           'branch-list',
           'branch-create',
           'branch-edit',
           'branch-delete',
           'department-list',
           'department-create',
           'department-edit',
           'department-delete',
           'rank-list',
           'rank-create',
           'rank-edit',
           'rank-delete',
           'nrc-code-list',
           'nrc-code-create',
           'nrc-code-edit',
           'nrc-code-delete',
           'nrc-state-list',
           'nrc-state-create',
           'nrc-state-edit',
           'nrc-state-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'dashboard',
           'hostel-list',
           'hostel-create',
           'hostel-edit',
           'hostel-delete',
           'room-list',
           'room-create',
           'room-edit',
           'room-delete',
           'hostel-employee-list',
           'hostel-employee-create',
           'hostel-employee-edit',
           'hostel-employee-delete',
           'backup-list',
           'backup-create',
           'backup-delete'
        ];
   
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}