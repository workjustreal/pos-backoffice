<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'employee';
    protected $fillable = [
        'emp_id',
        'branch_id',
        'position_id',
        'dept_id',
        'emp_status',
        'title',
        'title_en',
        'name',
        'name_en',
        'surname',
        'surname_en',
        'nickname',
        'gender',
        'birth_date',
        'tel',
        'tel2',
        'phone',
        'phone2',
        'email',
        'detail',
        'address',
        'subdistrict',
        'district',
        'province',
        'country',
        'zipcode',
        'start_work_date',
        'end_work_date',
        'payment_type',
        'ethnicity',
        'nationality',
        'religion',
        'vehicle_registration',
        'user_manage',
        'ip_address'
    ];
}