<?php

namespace App\Models;

use App\Models\User;
use App\Models\studentpayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAcademicInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'board_reg_no',
    ];

    /**
     * Get the sections for the blog post.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function studentpayment()
    {
        return $this->belongsTo(StudentPayment::class, 'student_id');
    }
}
