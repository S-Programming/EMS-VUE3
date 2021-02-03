<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PdfService;
use App\Models\Holiday;
use PDF;
use App;
use Route\Http\Pdf as HttpPdf;

class PdfController extends Controller
{
    //
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->middleware('auth');
        $this->pdfService = $pdfService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    /**
     * It will return Attendance History in PDF
     *
     * @return Body
     */

    public function attendanceHistory(Request $request)
    {
        if ($request->has('download')) {
            $holidays = Holiday::all();
            // dd($holidays);
            $pdf = PDF::loadView('pages.admin._partial._holidays_list_html', ['holidays' => $holidays]);
            // $pdf = PDF::loadView('pages.holidays.holidays',['holidays' => $holidays]);
            return $pdf->download('history.pdf');
        }
    }
}
