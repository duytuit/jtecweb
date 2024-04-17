<?php

namespace App\Http\Controllers;

use App\Exports\QrCodeExport;
use Illuminate\Http\Request;
use App\Imports\QrcodeImport;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class QrcodeController extends Controller
{
    public function index()
    {
        return view('qrcode.index');
    }
    public function importQrcodeData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
            ],
        ]);
        $collection = Excel::toArray(new QrcodeImport, $request->file('import_file'));

        return view('qrcode.index', compact('collection'));
        // return Excel::download(new QrCodeExport($collection), 'qrcode.xlsx');
    //    return (new QrCodeExport($collection))->download('qrcode.xlsx');


    }
    public function QrcodeGenerate(Request $request)
    {
        $request->validate([
            'InputCode' => 'required',
        ]);
        $inputCode = $request->input('InputCode');
        return view('qrcode.index', compact('inputCode'));
        // dd($inputCode);
    }
    public function QrCodePrint(Request $request)
    {
        $request->validate([
            'import_file_print' => [
                'required',
                'file',
            ],
        ]);
        $printcollection = Excel::toArray(new QrcodeImport, $request->file('import_file_print'));
        return view('qrcode.print', compact('printcollection'));
    }
}
