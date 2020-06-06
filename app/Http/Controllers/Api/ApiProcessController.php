<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Process;
use App\Product;
use Illuminate\Http\Request;

class ApiProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $print = 0;
        $cut_paper = 0;
        $heat_press = 0;
        $cut_print = 0;
        $edging = 0;
        $pip_side = 0;
        $cut_edge = 0;
        $pip_strap = 0;
        $lock_strap = 0;
        $cut_strap = 0;
        $pic_pack = 0;

//        echo $product->processes->heat_press;

        $processOfProduct = $product->processes;
        foreach ($processOfProduct as $process){
            $print = $print +  $process->print;
            $cut_paper = $cut_paper + $process->cut_paper;
            $heat_press = $heat_press + $process->heat_press;
            $cut_print = $cut_print + $process->cut_print;
            $edging = $edging + $process->edging;
            $pip_side = $pip_side + $process->pip_side;
            $cut_edge = $cut_edge + $process->cut_edge;
            $pip_strap = $pip_strap + $process->pip_strap;
            $lock_strap = $lock_strap + $process->lock_strap;
            $cut_strap = $cut_strap + $process->cut_strap;
            $pic_pack = $pic_pack + $process->pic_pack;
        }

        return $all = [$print, $cut_paper, $heat_press, $cut_print, $edging, $pip_side, $cut_edge, $pip_strap, $lock_strap, $cut_strap, $pic_pack];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employee $employee)
    {
        $request->request->add(['employee_id' => $employee->id]);
        Process::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
