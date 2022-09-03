<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolClass;
use App\Models\StudentAcademicInfo;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['section_name', 'room_no', 'class_id', 'session_id'];

    public function schoolClass() {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
       /**
     * Get the academic_info.
     */
    public function academic_info()
    {
        return $this->belongsTo(StudentAcademicInfo::class, 'student_id', 'id');
    }
}
