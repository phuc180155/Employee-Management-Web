<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\Salary\SalaryRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected $attendanceRepo;
    public function __construct(SalaryRepository $salaryRepo, AttendanceRepository  $attendanceRepo)
    {
        parent::__construct($salaryRepo);
        $this->attendanceRepo = $attendanceRepo;
    }

    public function index(){
        /**
         * Tạo attendance cho ngày hôm nay (nếu chưa tồn tại)
         */
        $employee_id = Auth::user()->employee()->first()->id;
        $curDate = $this->curDate();
        $attendance = Attendance::where('employee_id', $employee_id)->where('date', $curDate)->first();
        if (!$attendance){
            $this->attendanceRepo->custom_create($employee_id, $curDate);
            $this->update_info_details_month($employee_id, 0, 8, 1, 0, 0);
        }
        return view('employee.index');
    }
}
