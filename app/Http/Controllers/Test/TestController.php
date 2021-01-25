<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {

    }

    public function testModalOpen(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('test._partial.test_open_modal', ['id' => $containerId, 'class' => 'modal-xl', 'data' => null])->render();
        return $this->success('success', ['html' => $html]);
    }

    public function testMethod(Request $request)
    {

        $requestData = $request->toArray();
        $value = $requestData['dev_method'] ?? 'testFun';
        switch ($value) {
            case 'testForm':
                $this->testForm();
                break;
            case 'testAgora':
                $this->testAgora();
                break;
            default:
                $this->$value($request);
        }
        exit;
    }
    public function upload()
    {
        return view('test');
    }

    public function testFun()
    {
        echo 'Test fun';
    }



}
