<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use App\Repositories\CvRepository;
use App\Repositories\JobRepository;
use App\Repositories\LanguageRepository;
use App\Services\CvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(CvRepository $cvRepository, CvService $cvService,
                                JobRepository $jobRepository,CityRepository $cityRepository ,
                                LanguageRepository $languageRepository )
    {
        $this->cvRepository = $cvRepository;
        $this->jobRepository = $jobRepository;
        $this->languageRepository = $languageRepository;
        $this->cityRepository = $cityRepository;
        $this->cvService = $cvService;
    }

    public function index(){
        $languages = $this->languageRepository->get();
        $jobs      = $this->jobRepository->get();
        $cities    = $this->cityRepository->get();
        $cvs       = $this->cvRepository->get();
        $user      = Auth::user();
        return view('dashboard.dashboard',[
            'cities'=>$cities,
            'languages'=>$languages,
            'jobs'=>$jobs,
            'cvs' => $cvs,
            'user' => $user,
        ]);
    }

    public function addCv(Request $request){
        $validated = $request->validate([
            'ville' => 'required|string',
            'metier' => 'required|string',
            'email' => 'required|email',
            'langue' => 'nullable|string',
        ]);
        $filePath = $this->cvService->handleFileUpload($request);
        $cvData = array_merge($validated, ['FilePath' => $filePath]);
        if($cvData){
            $this->cvRepository->store($cvData);

        }
        return response()->json([
            'success' => true,
            'message' => 'CV uploaded successfully!',
        ]);
    }

}
