<?php

namespace App\Http\Controllers;

use App\Events\NewEvent;
use App\Events\NewMessage;
use App\Events\PrivateMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $url_data = [
            0 => [
                'title' => 'Kev Travel',
                'url' => 'https://kiev.travel'
            ],
            1 => [
                'title' => 'YouTube',
                'url' => 'https://www.youtube.com'
            ]
        ];

        return view('home')->with(compact('url_data'));
    }

    public function getJson()
    {
        return response()->json([
            0 => [
                'title' => 'google',
                'url' => 'https://kiev.travel'
            ],
            1 => [
                'title' => 'Yandex',
                'url' => 'https://www.youtube.com'
            ]
        ]);
    }

    public function dataChart()
    {
        return response()->json([
            'labels' => ['jan', 'feb', 'march', 'oct'],
            'datasets' => array([
                'label' => 'Sales',
                'backgroundColor' => '#F26202',
                'data' => [15000, 50000, 10000, 30000]
            ])
        ]);

    }

    public function randomChart()
    {
        return response()->json([
            'labels' => ['jan', 'feb', 'march', 'oct'],
            'datasets' => [[
                'label' => 'Toyota',
                'backgroundColor' => '#F26202',
                'data' => [rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000)]
            ], [
                'label' => 'BMW',
                'backgroundColor' => 'blue',
                'data' => [rand(0, 1000), rand(0, 1000), rand(0, 1000), rand(0, 1000)]
            ]]
        ]);

    }

    public function newEvent(Request $request)
    {
        $result = [
            'labels' => ['jan', 'feb', 'march', 'oct'],
            'datasets' => array([
                'label' => 'Sales',
                'backgroundColor' => '#F26202',
                'data' => [15000, 50000, 10000, 30000]
            ])
        ];

        if ($request->has('label')) {
            $result['labels'][] = $request->input('label');
            $result['datasets'][0]['data'][] = $request->input('sale');

            if ($request->has('realtime') && filter_var($request->input('realtime'), FILTER_VALIDATE_BOOLEAN)) {
                event(new NewEvent($result));
            }
        }

        return $result;
    }

    public function sendMessage(Request $request)
    {
        event(new NewMessage($request->input('message')));
    }

    public function sendPrivateMessage(Request $request)
    {
        event(new PrivateMessage($request->all()));

        return $request->all();
    }
}
