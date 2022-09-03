<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\UserInterface;
use App\Interfaces\SectionInterface;
use App\Interfaces\SchoolClassInterface;
use App\Repositories\PromotionRepository;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\TeacherStoreRequest;
use App\Interfaces\SchoolSessionInterface;
use App\Models\StudentAcademicInfo;
use App\Models\StudentPayment;
use App\Repositories\StudentParentInfoRepository;
use Illuminate\Support\Facades\DB;

class StudentPaymentController extends Controller
{
    use SchoolSession;
    protected $userRepository;
    protected $schoolSessionRepository;
    protected $schoolClassRepository;
    protected $schoolSectionRepository;
    public function __construct(UserInterface $userRepository, SchoolSessionInterface $schoolSessionRepository,
    SchoolClassInterface $schoolClassRepository,
    SectionInterface $schoolSectionRepository)
    {
        $this->middleware(['can:view users']);

        $this->userRepository = $userRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
    }
    public function getStudentPayment(Request $request) {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $class_id = $request->query('class_id', 0);
        $section_id = $request->query('section_id', 0);

        try{

            $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

            $studentList = $this->userRepository->getAllStudents($current_school_session_id, $class_id, $section_id);
            
           

            $data = [
                'studentList'       => $studentList,
                'school_classes'    => $school_classes,
                
                
            ];

            return view('payment.list', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function paymnetStore(Request $request ){
       
      
        $student_roll=$request->student_roll;
        $student_name=$request->student_name; 
        $total_fee=$request->total_fee;
        $due=$request->ammount;
        
        
        for($i=0;$i<count($student_roll);$i++)
        {
            $datasave=
            [
                'student_roll' => $student_roll[$i],
                'student_name' => $student_name[$i],
                'due'          => $total_fee[$i]-$due[$i],
                
             ];
            DB::table('student_payments')->insert($datasave);
        }
       
        return redirect()->back();

    }
    
}
