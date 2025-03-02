<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\TestSeries\StudentDetail;
use ReflectionClass;
use Illuminate\Support\Facades\Schema;

class StudentReportController extends Controller
{
    private $modelNamespace = 'App\Models\TestSeries\\';

    // public function index()
    // {
    //     $models = [
    //         'StudentDetail' => 'Student Details',
    //         'PreparationDetail' => 'Preparation Details',
    //         'SourcesUsed' => 'Sources Used',
    //         'CsatPreparation' => 'CSAT Preparation',
    //         'AdditionalPreparation' => 'Additional Preparation',
    //         'PersonalityDetail' => 'Personality Details',
    //         'SfgProgramKnowledge' => 'SFG Program Knowledge'
    //     ];

    //     return view('deepseek.reports.student-reports', compact('models'));
    // }

    public function index()
    {
        $models = [
            'StudentDetail' => 'Student Details',
            'PreparationDetail' => 'Preparation Details',
            'SourcesUsed' => 'Sources Used',
            'CsatPreparation' => 'CSAT Preparation',
            'AdditionalPreparation' => 'Additional Preparation',
            'PersonalityDetail' => 'Personality Details',
            'SfgProgramKnowledge' => 'SFG Program Knowledge'
        ];
    
        $fieldLabels = [];
    
        foreach ($models as $modelKey => $modelName) {
            $modelClass = $this->modelNamespace . $modelKey;
            
            if (class_exists($modelClass)) {
                $modelInstance = new $modelClass;
                
                $excludedColumns = [
                    'id', 'student_id', 'unique_id', 
                    'created_at', 'updated_at', 'deleted_at'
                ];
                
                $fieldLabels[$modelKey] = collect($modelInstance->getFillable())
                    ->reject(fn($field) => in_array($field, $excludedColumns))
                    ->mapWithKeys(fn($field) => [
                        $field => getFieldLabel($field)
                    ])
                    ->toArray();
            }
        }
    
        return view('deepseek.reports.student-reports', compact('models', 'fieldLabels'));
    }

    public function getQuestions(Request $request)
    {
        $request->validate(['model' => 'required|string']);

        $modelClass = $this->modelNamespace . $request->model;
        
        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Invalid model'], 400);
        }

        $model = new $modelClass;
        $questions = $this->getModelQuestions($model);

        return response()->json(['questions' => $questions]);
    }

    public function getAnswers(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'question' => 'required|string'
        ]);

        $modelClass = $this->modelNamespace . $request->model;
        $question = $request->question;

        // Validate model and column existence
        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Invalid model'], 400);
        }

        $modelInstance = new $modelClass;
        if (!Schema::hasColumn($modelInstance->getTable(), $question)) {
            return response()->json(['error' => 'Invalid question'], 400);
        }

        $questionLabel = getFieldLabel($question); // Get custom label

        $answers = $modelClass::with(['student' => function($query) {
                $query->select('id', 'first_name', 'last_name', 'email', 'mobile_number');
            }])
            ->select('student_id', $question)
            ->get()
            ->filter(function($item) use ($question) {
                return !is_null($item->$question);
            })
            ->map(function($item) use ($question) {
                return [
                    'student' => $item->student,
                    'answer' => $item->$question,
                    'question_label' => getFieldLabel($question) // Add label to response
                ];
            });

        // return view('deepseek.reports.answer-results', compact('answers', 'question'));

        return view('deepseek.reports.answer-results', [
            'answers' => $answers,
            'question' => $questionLabel // Pass formatted question
        ]);

    }

    private function getModelQuestions($model)
    {
        $excludedColumns = ['id', 'student_id', 'unique_id', 'created_at', 'updated_at', 'deleted_at'];
        
        return collect($model->getFillable())
            ->reject(fn($col) => in_array($col, $excludedColumns))
            ->mapWithKeys(fn($col) => [
                // $col => ucwords(str_replace('_', ' ', $col))
                $col => getFieldLabel($col) // Use your helper here
            ]);
    }

    // In StudentReportController.php
    public function getStudentDetails($id)
    {
        try {
            $student = Student::with([
                'studentDetails', 
                'PreparationDetails', // Match exact relationship method name
                'SourcesUseds', 
                'CsatPreparations',
                'AdditionalPreparations',
                'PersonalityDetails',
                'SfgProgramKnowledges'
            ])->findOrFail($id);

            return response()->json($student->toArray());

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Student not found',
                'details' => $e->getMessage()
            ], 404);
        }
    }
}
