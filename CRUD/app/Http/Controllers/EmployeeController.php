<?php

namespace App\Http\Controllers;

use App\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /*
    Загрузка всех существующих записей
     */
    public function index()
    {
        $employees = employee::all();
        return response()->json([
           'employees'    => $employees,
       ], 200);
    }

    /*
    Создание новой записи
     */
    public function create()
    {
        //проверка данных
        $data = request();
        $validatedData = $data->validate([
                'name' => 'required',
                'birthday' => 'required|date',
                'position' => 'required',
            ]);
        $employee = employee::create([
                'name' => request('name'),
                'birthday' => request('birthday'),
                'position' => request('position'),
            ]);
        return response()->json([
           'validationResult'    => $validatedData,
       ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        //
    }

    /*
    Обновление существующей записи
    id - индентификатор нужной запис в таблице
     */
    public function update($id)
    {
        //проверка данных
        $data = request();
        $validatedData = $data->validate([
                'name' => 'required',
                'birthday' => 'required|date',
                'position' => 'required',
            ]);
        employee::where('id',$id)->update([
            'name' => request('name'),
            'birthday' => request('birthday'),
            'position' => request('position'),
            ]);
        return response()->json([
           'validationResult'    => $validatedData,
       ], 200);
    }

    /*
    Удаление записи
    id - идентификатор записи в таблице
     */
    public function destroy($id)
    {
        employee::destroy($id);
    }
}
