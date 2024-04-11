<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\QrcodeImport;
use Maatwebsite\Excel\Facades\Excel;

class QrcodeController extends Controller
{
    public function index()
    {
        return view('qrcode.index');
    }
    public function importQrcodeData(Request $request)
    {
        $request->validate([
            'import_file'=>[
                'required',
                'file',
            ],
        ]);
        $collection = Excel::toArray(new QrcodeImport, $request->file('import_file'));
        return view('qrcode.index', compact('collection'));
        // dd($inputCode);
    }
}

class QrcodeGenerateController extends Controller
{
    public function QrcodeGenerate(Request $request)
    {
        $request->validate([
            'InputCode' => 'required',
        ]);

        $inputCode = $request->input('InputCode');
        return view('qrcode.index', compact('inputCode'));
        dd($inputCode);
    }
}