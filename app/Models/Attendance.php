<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\StudentAcademicInfo;
use App\Models\Section;
use App\Models\studentpayment;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'class_id',
        'section_id',
        'session_id',
        'course_id',
        'status',
    ];

    /**
     * Get the student for attendances.
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

    /**
     * Get the schoolClass for attendance.
     */
    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the section for attendance.
     */
    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * Get the course for attendance.
     */
    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }
    
    public function studentpayment()
    {
        return $this->belongsTo(studentpayment::class, 'student_roll');
    }
}
