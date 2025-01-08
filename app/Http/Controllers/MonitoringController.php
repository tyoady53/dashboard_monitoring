<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\DashMonitoringTat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(auth()->user()->getAllPermissions());
        $permissions = $this->get_permissions();
        // dd($permissions);
        return Inertia::render('Apps/Dashboard/Monitoring', [
            'permissions'     => $permissions
        ]);
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
                "reg_no"        => Carbon::now()->format("ym").str_pad($i + 1,4,"0",STR_PAD_LEFT),
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
        // if(count($request->data) > 0) {
        //     $cust_name = '';
        //     $cust_branch = '';

        //     // Dashboard::truncate();
        //     for($i=0; $i < count($request->data); $i ++) {
        //         $cust_name_old = $cust_name; $cust_branch_old = $cust_branch;
        //         $cust_name = $request->data[0]['cust_name'];
        //         $cust_branch = $request->data[0]['cust_branch'];
        //         if($cust_name_old != $cust_name && $cust_branch_old != $cust_branch) {
        //             Dashboard::where('cust_name',$cust_name)->where('cust_branch',$cust_branch)->delete();
        //             // $last =
        //         }
        //         Dashboard::create([
        //             // "id"            => $i + 1,
        //             "dttm"          => $request->data[$i]['dttm'],
        //             "cust_name"     => $cust_name,
        //             "cust_branch"   => $cust_branch,
        //             "reg_no"         => $request->data[$i]['reg_no'],
        //             "type"          => $request->data[$i]['type'],
        //             "sc"            => $request->data[$i]['sc'],
        //             "ps"            => $request->data[$i]['ps'],
        //             "rs"            => $request->data[$i]['rs'],
        //             "vr"            => $request->data[$i]['vr'],
        //             "au"            => $request->data[$i]['au'],
        //             "kr"            => $request->data[$i]['kr']
        //         ]);
        //     }
        // }

        // return null;
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
        $parameters = [1,2,3,5];
        $user = User::with('has_company','has_branch')->where('email',$email)->first();
        $array = Dashboard::where('cust_name',$user->has_company->customer_id)->where('cust_branch',$user->has_branch->outlet_id)->orderBy('reg_no')->get();
        $data = array();
        $idx_cito_sc = 0;
        $idx_non_sc = 0;
        $idx_cito_ps = 0;
        $idx_non_ps = 0;
        $idx_cito_rs = 0;
        $idx_non_rs = 0;
        $idx_cito_vr = 0;
        $idx_non_vr = 0;
        $idx_cito_au = 0;
        $idx_non_au = 0;
        $idx_kritis = 0;
        $arr_type = ['cito', 'noncito'];

        $data['cust_name'] = $user->has_company->customer_name;
        $data['cust_branch'] = $user->has_branch->branch_name;
        if(count($array)){
            $data['last_update'] = $array[0]->dttm;
        } else {
            $data['last_update'] = null;
        }

        foreach($array as $index=>$loop) {
            if($loop->cust_name) {
                // Speciment Collection
                $spe_col = null;
                if(in_array($loop['sc'], $parameters)){
                    $spe_col = ['reg_no' => str_pad($loop['reg_no'],4,"0",STR_PAD_LEFT), 'type' => $loop['sc']];
                    if(strtoupper($loop['type']) == 'CITO') {
                        if(count($data) > 0) {
                            $data['sc'][$idx_cito_sc]['cito'] = $spe_col;
                            if($idx_cito_sc >= $idx_non_sc) {
                                $data['sc'][$idx_cito_sc]['noncito'] = null;
                            }
                        } else {
                            $data['sc'][$idx_cito_sc]['cito'] = $spe_col;
                            $data['sc'][$idx_cito_sc]['noncito'] = null;
                        }
                        $idx_cito_sc += 1;
                    } else {
                        if(count($data) > 0) {
                            if($idx_cito_sc <= $idx_non_sc) {
                                $data['sc'][$idx_non_sc]['cito'] = null;
                            }
                            $data['sc'][$idx_non_sc]['noncito'] = $spe_col;
                        } else {
                            $data['sc'][$idx_non_sc]['cito'] = null;
                            $data['sc'][$idx_non_sc]['noncito'] = $spe_col;
                        }
                        $idx_non_sc += 1;
                    }
                }

                // Process Sample
                $pro_sam = null;
                if(in_array($loop['ps'], $parameters)){
                    $pro_sam = ['reg_no' => str_pad($loop['reg_no'],4,"0",STR_PAD_LEFT), 'type' => $loop['ps']];
                    if(strtoupper($loop['type']) == 'CITO') {
                        if(count($data) > 0) {
                            $data['ps'][$idx_cito_ps]['cito'] = $pro_sam;
                            if($idx_cito_ps >= $idx_non_ps) {
                                $data['ps'][$idx_cito_ps]['noncito'] = null;
                            }
                        } else {
                            $data['ps'][$idx_cito_ps]['cito'] = $pro_sam;
                            $data['ps'][$idx_cito_ps]['noncito'] = null;
                        }
                        $idx_cito_ps += 1;
                    } else {
                        if(count($data) > 0) {
                            if($idx_cito_ps <= $idx_non_ps) {
                                $data['ps'][$idx_non_ps]['cito'] = null;
                            }
                            $data['ps'][$idx_non_ps]['noncito'] = $pro_sam;
                        } else {
                            $data['ps'][$idx_non_ps]['cito'] = null;
                            $data['ps'][$idx_non_ps]['noncito'] = $pro_sam;
                        }
                        $idx_non_ps += 1;
                    }
                }

                // Result
                $result = null;
                if(in_array($loop['rs'], $parameters)){
                    $result = ['reg_no' => str_pad($loop['reg_no'],4,"0",STR_PAD_LEFT), 'type' => $loop['rs']];
                    if(strtoupper($loop['type']) == 'CITO') {
                        if(count($data) > 0) {
                            $data['rs'][$idx_cito_rs]['cito'] = $result;
                            if($idx_cito_rs >= $idx_non_rs) {
                                $data['rs'][$idx_cito_rs]['noncito'] = null;
                            }
                        } else {
                            $data['rs'][$idx_cito_rs]['cito'] = $result;
                            $data['rs'][$idx_cito_rs]['noncito'] = null;
                        }
                        $idx_cito_rs += 1;
                    } else {
                        if(count($data) > 0) {
                            if($idx_cito_rs <= $idx_non_rs) {
                                $data['rs'][$idx_non_rs]['cito'] = null;
                            }
                            $data['rs'][$idx_non_rs]['noncito'] = $result;
                        } else {
                            $data['rs'][$idx_non_rs]['cito'] = null;
                            $data['rs'][$idx_non_rs]['noncito'] = $result;
                        }
                        $idx_non_rs += 1;
                    }
                }

                // Verification
                $verif = null;
                if(in_array($loop['vr'], $parameters)){
                    $verif = ['reg_no' => str_pad($loop['reg_no'],4,"0",STR_PAD_LEFT), 'type' => $loop['vr']];
                    if(strtoupper($loop['type']) == 'CITO') {
                        if(count($data) > 0) {
                            $data['vr'][$idx_cito_vr]['cito'] = $verif;
                            if($idx_cito_vr >= $idx_non_vr) {
                                $data['vr'][$idx_cito_vr]['noncito'] = null;
                            }
                        } else {
                            $data['vr'][$idx_cito_vr]['cito'] = $verif;
                            $data['vr'][$idx_cito_vr]['noncito'] = null;
                        }
                        $idx_cito_vr += 1;
                    } else {
                        if(count($data) > 0) {
                            if($idx_cito_vr <= $idx_non_vr) {
                                $data['vr'][$idx_non_vr]['cito'] = null;
                            }
                            $data['vr'][$idx_non_vr]['noncito'] = $verif;
                        } else {
                            $data['vr'][$idx_non_vr]['cito'] = null;
                            $data['vr'][$idx_non_vr]['noncito'] = $verif;
                        }
                        $idx_non_vr += 1;
                    }
                }

                // Authorizazion
                $author = null;
                if(in_array($loop['au'], $parameters)){
                    $author = ['reg_no' => str_pad($loop['reg_no'],4,"0",STR_PAD_LEFT), 'type' => $loop['au']];
                    if(strtoupper($loop['type']) == 'CITO') {
                        if(count($data) > 0) {
                            $data['au'][$idx_cito_au]['cito'] = $author;
                            if($idx_cito_au >= $idx_non_au) {
                                $data['au'][$idx_cito_au]['noncito'] = null;
                            }
                        } else {
                            $data['au'][$idx_cito_au]['cito'] = $author;
                            $data['au'][$idx_cito_au]['noncito'] = null;
                        }
                        $idx_cito_au += 1;
                    } else {
                        if(count($data) > 0) {
                            if($idx_cito_au <= $idx_non_au) {
                                $data['au'][$idx_non_au]['cito'] = null;
                            }
                            $data['au'][$idx_non_au]['noncito'] = $author;
                        } else {
                            $data['au'][$idx_non_au]['cito'] = null;
                            $data['au'][$idx_non_au]['noncito'] = $author;
                        }
                        $idx_non_au += 1;
                    }
                }

                // Kritis
                $kritis = null;
                $kritis = ['reg_no' => str_pad($loop['reg_no'],4,"0",STR_PAD_LEFT), 'type' => $loop['kr']];
                if($loop['kr'] == '1') {
                    $data['kr'][$idx_kritis] = $kritis;
                    $idx_kritis += 1;
                }
            }
        }

        $data['tat'] = DashMonitoringTat::where('cust_name',$user->has_company->customer_id)->where('cust_branch',$user->has_branch->outlet_id)->get();

        response()->json([
            'status'    => true,
            'message'   => 'Monitoring Data',
            'data'      => $data
        ])->send();

        // Step 3: Close the connection
        // if (function_exists('fastcgi_finish_request')) {
        //     dd('fastcgi_finish_request exist');
        //     fastcgi_finish_request();
        // }
        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();

        // Step 4: Perform any background tasks (optional)
        // Example: Log something, send an email, etc.
        // \Log::info("Connection closed. Background task is running.");

        return;
    }

    public function get_permissions()
    {
        $array_permission = array();
        foreach (Auth::user()->getAllPermissions() as $key => $permission) {
            array_push($array_permission, $permission->name);
        }

        if(count($array_permission)) {
            $return['status']   = 200;
            $return['data']     = $array_permission;
        } else {
            $return['status']   = 500;
            $array_permission = [];
        }

        return response()->json(
            $array_permission
        );
    }
}
