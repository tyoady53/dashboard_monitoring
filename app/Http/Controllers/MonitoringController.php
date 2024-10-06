<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Apps/Dashboard/Monitoring');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arr_type = ['cito', 'noncito'];
        for($i=0;$i<(int)request()['length']; $i++){
            $array[$i] = [
                "dttm"          => Carbon::now()->format("Y-m-d H:i:s"),
                "cust_name"     => request()['cust_name'],
                "cust_branch"   => request()['cust_branch'],
                "regno"         => str_pad($i + 1,4,"0",STR_PAD_LEFT),
                "type"          => $arr_type[rand(0,1)],
                "sc" => rand(1,4),
                "ps" => rand(1,4),
                "rs" => rand(1,4),
                "vr" => rand(1,4),
                "au" => rand(1,4),
                "kr" => rand(0,1)
            ];
        };

        // dd(request(),$array,(int)request()['length']);
        return response()->json([
            'data' => $array
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(count($request->data) > 0) {
            Dashboard::truncate();
            for($i=0; $i < count($request->data); $i ++) {
                Dashboard::create([
                    "id"            => $i + 1,
                    "dttm"          => $request->data[$i]['dttm'],
                    "cust_name"     => strtoupper($request->data[$i]['cust_name']),
                    "cust_branch"   => $request->data[$i]['cust_branch'],
                    "regno"         => $request->data[$i]['regno'],
                    "type"          => $request->data[$i]['type'],
                    "sc"            => $request->data[$i]['sc'],
                    "ps"            => $request->data[$i]['ps'],
                    "rs"            => $request->data[$i]['rs'],
                    "vr"            => $request->data[$i]['vr'],
                    "au"            => $request->data[$i]['au'],
                    "kr"            => $request->data[$i]['kr']
                ]);
            }
        }

        return null;
        // dd(count($request->data));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_data($email)
    {
        $user = User::with('has_company')->where('email',$email)->first();
        // dd($email,$user->has_company->customer_id);
        $array = Dashboard::where('cust_name',$user->has_company->customer_id)->get();
        $data = array();
        $idx_cito = 0;
        $idx_non = 0;
        $idx_kritis = 0;
        $arr_type = ['cito', 'noncito'];

        foreach($array as $index=>$loop) {
            if($loop->cust_name) {

                // Speciment Collection
                $spe_col = null;
                $spe_col = ['regno' => str_pad($loop['regno'],4,"0",STR_PAD_LEFT), 'type' => $loop['sc']];
                if($loop['type'] == 'cito') {
                    if(count($data) > 0) {
                        $data['sc'][$idx_cito]['cito'] = $spe_col;
                        if($idx_cito >= $idx_non) {
                            $data['sc'][$idx_cito]['noncito'] = null;
                        }
                    } else {
                        $data['sc'][$idx_cito]['cito'] = $spe_col;
                        $data['sc'][$idx_cito]['noncito'] = null;
                    }
                } else {
                    if(count($data) > 0) {
                        if($idx_cito <= $idx_non) {
                            $data['sc'][$idx_non]['cito'] = null;
                        }
                        $data['sc'][$idx_non]['noncito'] = $spe_col;
                    } else {
                        $data['sc'][$idx_non]['cito'] = null;
                        $data['sc'][$idx_non]['noncito'] = $spe_col;
                    }
                }

                // Process Sample
                $pro_sam = null;
                $pro_sam = ['regno' => str_pad($loop['regno'],4,"0",STR_PAD_LEFT), 'type' => $loop['ps']];
                if($loop['type'] == 'cito') {
                    if(count($data) > 0) {
                        $data['ps'][$idx_cito]['cito'] = $pro_sam;
                        if($idx_cito >= $idx_non) {
                            $data['ps'][$idx_cito]['noncito'] = null;
                        }
                    } else {
                        $data['ps'][$idx_cito]['cito'] = $pro_sam;
                        $data['ps'][$idx_cito]['noncito'] = null;
                    }
                } else {
                    if(count($data) > 0) {
                        if($idx_cito <= $idx_non) {
                            $data['ps'][$idx_non]['cito'] = null;
                        }
                        $data['ps'][$idx_non]['noncito'] = $pro_sam;
                    } else {
                        $data['ps'][$idx_non]['cito'] = null;
                        $data['ps'][$idx_non]['noncito'] = $pro_sam;
                    }
                }

                // Result
                $result = null;
                $result = ['regno' => str_pad($loop['regno'],4,"0",STR_PAD_LEFT), 'type' => $loop['rs']];
                if($loop['type'] == 'cito') {
                    if(count($data) > 0) {
                        $data['rs'][$idx_cito]['cito'] = $result;
                        if($idx_cito >= $idx_non) {
                            $data['rs'][$idx_cito]['noncito'] = null;
                        }
                    } else {
                        $data['rs'][$idx_cito]['cito'] = $result;
                        $data['rs'][$idx_cito]['noncito'] = null;
                    }
                } else {
                    if(count($data) > 0) {
                        if($idx_cito <= $idx_non) {
                            $data['rs'][$idx_non]['cito'] = null;
                        }
                        $data['rs'][$idx_non]['noncito'] = $result;
                    } else {
                        $data['rs'][$idx_non]['cito'] = null;
                        $data['rs'][$idx_non]['noncito'] = $result;
                    }
                }

                // Verification
                $verif = null;
                $verif = ['regno' => str_pad($loop['regno'],4,"0",STR_PAD_LEFT), 'type' => $loop['vr']];
                if($loop['type'] == 'cito') {
                    if(count($data) > 0) {
                        $data['vr'][$idx_cito]['cito'] = $verif;
                        if($idx_cito >= $idx_non) {
                            $data['vr'][$idx_cito]['noncito'] = null;
                        }
                    } else {
                        $data['vr'][$idx_cito]['cito'] = $verif;
                        $data['vr'][$idx_cito]['noncito'] = null;
                    }
                } else {
                    if(count($data) > 0) {
                        if($idx_cito <= $idx_non) {
                            $data['vr'][$idx_non]['cito'] = null;
                        }
                        $data['vr'][$idx_non]['noncito'] = $verif;
                    } else {
                        $data['vr'][$idx_non]['cito'] = null;
                        $data['vr'][$idx_non]['noncito'] = $verif;
                    }
                }

                // Authorizazion
                $author = null;
                $author = ['regno' => str_pad($loop['regno'],4,"0",STR_PAD_LEFT), 'type' => $loop['au']];
                if($loop['type'] == 'cito') {
                    if(count($data) > 0) {
                        $data['au'][$idx_cito]['cito'] = $author;
                        if($idx_cito >= $idx_non) {
                            $data['au'][$idx_cito]['noncito'] = null;
                        }
                    } else {
                        $data['au'][$idx_cito]['cito'] = $author;
                        $data['au'][$idx_cito]['noncito'] = null;
                    }
                    $idx_cito += 1;
                } else {
                    if(count($data) > 0) {
                        if($idx_cito <= $idx_non) {
                            $data['au'][$idx_non]['cito'] = null;
                        }
                        $data['au'][$idx_non]['noncito'] = $author;
                    } else {
                        $data['au'][$idx_non]['cito'] = null;
                        $data['au'][$idx_non]['noncito'] = $author;
                    }
                    $idx_non += 1;
                }

                // Kritis
                $kritis = null;
                $kritis = ['regno' => str_pad($loop['regno'],4,"0",STR_PAD_LEFT), 'type' => $loop['kr']];
                if($loop['kr'] == '1') {
                    $data['kr'][$idx_kritis] = $kritis;
                    $idx_kritis += 1;
                }

            }

            // dd($data_);
            $data['cust_name'] = $loop->cust_name;
            $data['cust_branch'] = '1';
        }
        // $data['monitoring'] = $data_;

        return response()->json([
            'status'    => true,
            'message'   => 'Monitoring Data',
            'data'      => $data
        ]);
    }
}
