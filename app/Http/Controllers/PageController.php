<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function kriteria()
    {
        return view('kriteria');
    }

    public function kriteriaUpdate()
    {
        return view('kriteria_update');
    }

    public function subkriteria()
    {
        return view('subkriteria');
    }

    public function subkriteriaUpdate()
    {
        return view('subkriteria_update');
    }

    public function dataset()
    {
        return view('dataset');
    }

    public function datasetUpdate()
    {
        return view('dataset_update');
    }

    public function passwordUpdate()
    {
        return view('password_update');
    }

    public function hasil()
    {
        return view('hasil');
    }

    public function analisa()
    {
        return view('analisa');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}