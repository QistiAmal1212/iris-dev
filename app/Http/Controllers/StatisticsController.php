<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterMonth;
use Illuminate\Http\Request;

class StatisticsController extends Controller
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
    public function index(Request $request)
    {
        return view('content.statistics.index');
    }
    public function generateChart2(Request $request)
    {dd($request->all());

        $response['config'] = $config;

        return response()->json($response);
    }
    public function generateChart(Request $request)
    {
        $region = $request->region;
        $branch_office = $request->branch_office;
        $isMonthly = $request->isMonthly;
        $tahunAkhir = $request->tahunAkhir;
        $startYear = $request->startYear;
        $startMonth = $request->startMonth;
        $endYear = $request->endYear;
        $endMonth = $request->endMonth;
        $facility_type = $request->facility_type;
        $value_type = $request->value_type;

        //For month/year label
        $Duration = [];
        $DurationLabel = [];

        if ($isMonthly == 1) {

            //Calculate for months
            for ($i = $startYear; $i <= $endYear; $i++) {
                if ($i == $endYear) {
                    $maxMonth = $endMonth;
                } else {
                    $maxMonth = 12;
                }
                if ($i == $startYear) {
                    $minMonth = $startMonth;
                } else {
                    $minMonth = 1;
                }
                for ($j = $minMonth; $j <= $maxMonth; $j++) {
                    $Duration[] = $j;
                }
            }

            $getAllMonth = MasterMonth::select('id', 'name')->get();

            $yearCount = $startYear;

            foreach ($Duration as $month) {
                foreach ($getAllMonth as $monthName) {
                    if ($monthName->id == $month) {

                        $DurationLabel[] = $monthName->name . " " . $yearCount;
                        if ($month == 12) {
                            $yearCount++;
                        }
                        break;
                    }
                }
            };
        } else {
            for ($i = $startYear; $i <= $endYear; $i++) {
                $Duration[] = $i;
                $DurationLabel[] = $i;
            }
        }

        // //Make graph have gap between start and end
        // array_unshift($DurationLabel,"");
        // $DurationLabel[]="";
        // array_unshift($Duration,"");
        // $Duration[]="";

        //Title
        $title[] = "REPORT OF  " . strtoupper($facility_type) . " (" . strtoupper($value_type) . ")";
        $title[] = "IN " . strtoupper($branch_office) . " (" . strtoupper($region) . ")";
        if ($isMonthly == 1) {
            $title[] = "(" . $DurationLabel[0] . " - " . $DurationLabel[count($DurationLabel) - 2] . ")";
        } else {
            $title[] = "(" . $startYear . " - " . $endYear . ")";
        }

        //hardcoded color (navy,green,purple,maroon, dark blue)
        $colors = ['rgb(0, 0, 139)', 'rgb(78, 14, 135, 1)', 'rgb(0,0,128)', 'rgb(128,128,128)', 'rgb(128,0,128)', 'rgb(0, 63, 92, 1)'];
        //(red, red 0.5 opac, yellow, yellow 0.5 opac, green, green 0.5 opac, light blue, light blue 0.1 opac, orange, orange 0.5 opac)
        $colorForIndex = ['rgb(241, 9, 23, 1)', 'rgb(241, 9, 23, 0.1)', 'rgb(255, 195, 0, 1)', 'rgb(255, 195, 0,0.1)', 'rgb(0, 168, 2, 1)', 'rgb(0, 168, 2, 0.1)', 'rgb(37, 150, 190, 1)', 'rgb(37, 150, 190, 0.1)', 'rgb(255, 165, 0, 1)', 'rgb(255, 165, 0, 0.3)'];
        //(red, yellow, green, silver, grey, web orange, light pink)
        $colorsForStandard = ['rgb(241, 9, 23, 1)', 'rgb(255, 195, 0,0.5)', 'rgb(0, 168, 2, 1)', 'rgb(218, 247, 166)', 'rgb(192,192,192)', 'rgb(255, 166, 0, 1)', 'rgb(188, 80, 144, 1)'];

        //Insert any label and data
        $dataset = [];
        $ylabel = "";
        $config = "";

        //First Dataset
        //Randomizer
        $data = [];
        foreach ($Duration as $month) {
            $data[] = rand(150, 350);
        }

        $dataset[] = [
            'label' => strtoupper($value_type),
            'backgroundColor' => '#aaadff',
            'borderColor' => '#ffffff',
            "borderWidth" => '1',
            'data' => $data,
            "fill" => true,
        ];

        //Start graph config
        $config = [
            "type" => "bar",
            "data" => [
                "labels" => $DurationLabel,
                "datasets" => $dataset,
            ],
            "options" => [
                "maintainAspectRatio" => false,
                "plugins" => [
                    "title" => [
                        "display" => true,
                        "text" => $title,
                        "font" => [
                            "size" => 20,
                        ],
                    ],
                    "legend" => [
                        "display" => true,
                        "position" => "bottom",
                        "labels" => [
                            "color" => "rgb(0,0,0)",
                            "usePointStyle" => true,
                            "textAlign" => "center",
                            "font" => [
                                "weight" => "bold",
                            ],
                            "title" => [
                                "padding" => 20,
                            ],
                        ],
                    ],
                ],
                "scales" => [
                    "x" => [
                        "title" => [
                            "color" => 'black',
                            "display" => true,
                            "text" => $isMonthly == 1 ? "Months" : "Year",
                            "font" => [
                                "size" => 16,
                                "weight" => "bold",
                            ],
                        ],
                        "ticks" => [
                            "sampleSize" => 32,
                            "padding" => 0,
                        ],
                    ],
                    "y" => [
                        "title" => [
                            "color" => 'black',
                            "display" => true,
                            "text" => "Total (number)",
                            "font" => [
                                "size" => 16,
                                "weight" => 'bold',
                            ],
                        ],
                        'grace' => '30%',
                        'beginAtZero' => true,
                    ],
                ],
            ],
        ];
        //End graph config

        //    $response['dataset'] = $dataset;
        //    $response['titleText'] = $title;
        //    $response['monthNames'] = $monthNames;
        //    $response['ylabel'] = $ylabel;
        $response['config'] = $config;

        return response()->json($response);
    }

}
