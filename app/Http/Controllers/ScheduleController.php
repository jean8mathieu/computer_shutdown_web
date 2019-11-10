<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $array = [];
        foreach(Schedule::query()->orderBy('day_int', 'ASC')->get() as $schedule){
            $array[] = [
                'day_int' =>$schedule->day_int,
                'day_string' => $schedule->day_string,
                'start' => $schedule->start,
                'end' => $schedule->end
            ];
        }

        return response($array, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request)
    {
        foreach ($request->start as $key => $value) {
            $schedule = Schedule::query()->where('day_int', $key)->first();

            if ($schedule) {
                $schedule->start = $value;
                $schedule->end = $request->end[$key];

                $schedule->save();
            }
        }

        return redirect()
            ->to(route('home'))
            ->with('status', 'The schedule have been updated!');
    }
}
