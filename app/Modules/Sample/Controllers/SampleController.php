<?php

namespace App\Modules\Sample\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Sample\SampleRepositoryInterface;


class SampleController extends Controller
{
    private $sampleRepository;

    public function __construct(SampleRepositoryInterface $sampleRepository)
    {
        $this->sampleRepository = $sampleRepository;
    }

    public function index(Request $request)
    {
        $data = $this->sampleRepository->all();

        return view('Sample::index', ['data' => $data]);

    }
}
