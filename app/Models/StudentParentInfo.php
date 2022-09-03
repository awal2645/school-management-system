<?php

namespace App\Models;

use App\Models\User;
use App\Models\StudentAcademicInfo;
use App\Models\studentpayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentParentInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'father_name',
        'father_phone',
        'mother_name',
        'mother_phone',
        'parent_address',
    ];

    /**
     * Get the sections for the blog post.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    /**
     * Get the academic_info.
     */
    public function academic_info()
    {
        return $this->belongsTo(StudentAcademicInfo::class, 'student_id', 'id');
    }

    public function studentpayment()
    {
        return $this->belongsTo(StudentPayment::class, 'student_id');
    }
}
