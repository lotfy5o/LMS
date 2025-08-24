<?php

namespace App\Http\Controllers\instructor;

use Carbon\Carbon;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        $questions = Question::with([
            'user',                  // the student who asked the question
            'course.instructor'      // the course + its instructor
        ])
            ->where('instructor_id', $id)
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->get();

        return view('instructor.questions.index', get_defined_vars());
    }

    public function QuestionDetails(Question $question)
    {
        $replys = Question::where('parent_id', $question->id)->orderBy('id', 'asc')->get();
        return view('instructor.questions.question-details', get_defined_vars());
    }

    public function QuestionReply(Request $request)
    {
        $question_id = $request->question_id;
        $user_id = $request->user_id;
        $course_id = $request->course_id;
        $instructor_id = $request->instructor_id;

        Question::insert([
            'course_id' => $course_id,
            'user_id' => $user_id,
            'instructor_id' => $instructor_id,
            'parent_id' => $question_id,
            'question' => $request->question,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Message Send Successfully',
            'alert-type' => 'success'
        );
        // return redirect()->route('instructor.questions.index')->with($notification);
        return redirect()->back()->with($notification);
    }
}
