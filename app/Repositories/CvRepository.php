<?php

namespace App\Repositories;

use App\Models\Cv;
use Illuminate\Support\Facades\Auth;

class CvRepository
{
    public function get(){
        $cvs = Cv::with(['user','city','language','job'])->paginate(5);
        return $cvs;
    }
    public function store(array $data) {
        return Cv::create([
            'FilePath' => $data['FilePath'],
            'user_id'=>Auth::User()->id,
            'city_id' => $data['ville'],
            'job_id' => $data['metier'],
            'email' => $data['email'],
            'language_id' => $data['langue'],
            'contact_name' =>$data['contact_name'],
            'due_date' =>now()->format('Y-m-d'),
        ]);

    }
    public function destroy($id)
    {
        $cv = Cv::find($id);

        if (!$cv) {
            return redirect()->back()->with('error', 'Cv not found.');
        }

        try {
            $cv->delete();
            return redirect()->back()->with('success', 'Cv deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors
            return redirect()->back()->with('error', 'An error occurred while deleting the Cv.');
        }
    }


}


