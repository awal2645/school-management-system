<?php

namespace App\Models;

use App\Models\Section;
use App\Models\SchoolClass;
use App\Models\studentpayment;
use App\Models\StudentAcademicInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
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
        'id_card_number',
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
        return $this->belongsTo(StudentAcademicInfo::class, 'student_id');
    }


    /**
     * Get the schoolClass.
     */
    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the section.
     */
    public function section() {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function studentpayment()
    {
        return $this->belongsTo(StudentPayment::class, 'student_id');
    }
}
