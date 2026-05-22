<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\DashMonitoringTat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->get_permissions();
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
        for ($i = 0; $i < (int)request()['length']; $i++) {
            $array[$i] = [
                "dttm"          => Carbon::now()->format("Y-m-d H:i:s"),
                "cust_name"     => request()['cust_name'],
                "cust_branch"   => request()['cust_branch'],
                "reg_no"        => Carbon::now()->format("ym") . str_pad($i + 1, 4, "0", STR_PAD_LEFT),
                "type"          => $arr_type[rand(0, 1)],
                "sc" => rand(1, 4),
                "ps" => rand(1, 4),
                "rs" => rand(1, 4),
                "vr" => rand(1, 4),
                "au" => rand(1, 4),
                "kr" => rand(0, 1)
            ];
        };

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
        $user = User::with('has_company', 'has_branch')->where('email', $email)->first();
        $array_permission = array();
        foreach ($user->getAllPermissions() as $key => $permission) {
            array_push($array_permission, $permission->name);
        }

        $last_update = null;
        $data = [];
        if (in_array("dash_monitoring.regno", $array_permission)) {
            $data = $this->monitoring_regno($user);
        } else if (in_array("dash_monitoring.charts", $array_permission)) {
            $last_ = DB::table('dash_patient_monitoring')
                ->where('cust_name', $user->has_company->customer_id)
                ->where('cust_branch', $user->has_branch->outlet_id)
                ->first();
            $last_update = $last_->dttm;
            $data[0] = $this->statistikPemeriksaanPerLayanan($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[1] = $this->monitoringTAT($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[2] = $this->statistikAsalPasien($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[3] = $this->statistikPasienBelumOtorisasi($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[4] = $this->pasienJanjiHasil($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[5] = $this->rekapPasienMingguSebelumnya($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[6] = $this->jumlahRegistrasidanPemeriksaan($user->has_company->customer_id, $user->has_branch->outlet_id);
        } else if (in_array("dash_monitoring.process_sample", $array_permission)) {
            $data = $this->monitoring_process_sample($user);
            ($data ? $last_update = $data['last_update'] : $last_update = null);
        } else if (in_array("dash_monitoring.bloodbank", $array_permission)) {
            $last_ = DB::table('dash_visitation')
                ->where('cust_name', $user->has_company->customer_id)
                ->where('cust_branch', $user->has_branch->outlet_id)
                ->first();
            $last_update = $last_->dttm ?? Carbon::now()->format("Y-m-d H:i:s");
            $data[0] = $this->dash_visitation($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[1] = $this->dash_patient_result($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[2] = $this->dash_blood_stock($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[3] = $this->dash_visit_classification($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[4] = $this->dash_patient_visit($user->has_company->customer_id, $user->has_branch->outlet_id);
            $data[5] = $this->dash_blood_stock_expiring($user->has_company->customer_id, $user->has_branch->outlet_id);
        }

        response()->json([
            'status'        => true,
            'message'       => 'Monitoring Data',
            'last_update'   => $last_update,
            'data'          => $data
        ])->send();

        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();

        return;
    }

    function statistikPemeriksaanPerLayanan($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_test_inv_group')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->get();
        $data['title'] = strtoupper('Statistik Pemeriksaan Per Layanan');
        $data['labels'] = $qry_data->pluck('test_inv_group')
            ->toArray();

        $data['data'][] = [
            'name' => 'BELUM SELESAI',
            'data' => $qry_data->pluck('total_not_finish')->toArray()
        ];
        $data['data'][] = [
            'name' => 'SELESAI',
            'data' => $qry_data->pluck('total')->toArray()
        ];

        return $data;
    }

    function monitoringTAT($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_tat_v1')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->get();

        $data['title'] = strtoupper('Monitoring TAT');
        $data['labels'] = $qry_data->pluck('tat_type')
            ->toArray();

        $data['data'][] = [
            'name' => 'BELUM SELESAI',
            'data' => $qry_data->pluck('total_not_finish')->toArray()
        ];
        $data['data'][] = [
            'name' => 'SELESAI',
            'data' => $qry_data->pluck('total')->toArray()
        ];

        return $data;
    }

    function statistikAsalPasien($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_patient_company')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->get();

        $data['title'] = strtoupper('Statistik Asal Pasien');
        $data['labels'] = $qry_data->pluck('patient_type')
            ->toArray();

        $data['data'] = $qry_data->pluck('total')->toArray();

        return $data;
    }

    function statistikPasienBelumOtorisasi($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_patient_auth')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->get();

        $data['title'] = strtoupper('Pasien Belum Otorisasi');
        $data['labels'] = $qry_data->pluck('test_inv_group')
            ->toArray();

        $data['data'][] = [
            'name' => 'BELUM SELESAI',
            'data' => $qry_data->pluck('total_not_finish')->toArray()
        ];
        $data['data'][] = [
            'name' => 'SELESAI',
            'data' => $qry_data->pluck('total')->toArray()
        ];

        return $data;
    }

    function rekapPasienMingguSebelumnya($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_patient_summary')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->first();

        $data['title'] = strtoupper('rekap pasien');
        $data['period'] = $qry_data->period;
        $data['data']['sample_not_running'] = new \stdClass();
        $data['data']['sample_not_running']->label = 'SAMPLE BELUM RUNNING';
        $data['data']['sample_not_running']->total = $qry_data->sample_not_running;
        $data['data']['sample_not_verify'] = new \stdClass();
        $data['data']['sample_not_verify']->label = 'SAMPLE BELUM VERIFIKASI';
        $data['data']['sample_not_verify']->total = $qry_data->sample_not_verify;
        $data['data']['sample_not_auth'] = new \stdClass();
        $data['data']['sample_not_auth']->label = 'SAMPLE BELUM OTORISASI';
        $data['data']['sample_not_auth']->total = $qry_data->sample_not_auth;

        return $data;
    }

    function pasienJanjiHasil($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_patient_appointment')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->get();

        $return_array = array();
        $return_array['title'] = strtoupper('pasien janji hasil');
        foreach ($qry_data as $data) {
            $return_array['data'][] = [
                'lab_no'        => $data->lab_no,
                'patient_name'  => $data->patient_name,
                'result_time'   => $data->result_time
            ];
        }

        return $return_array;
    }
    function jumlahRegistrasidanPemeriksaan($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_patient_monitoring')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->first();

        $fields = [
            'registration'       => 'REGISTRASI',
            'sample_not_draw'    => 'SAMPEL BELUM DATANG',
            'sample_received'    => 'SAMPEL TERIMA',
            'sample_not_prepare' => 'SAMPEL BELUM SEPARASI',
            'sample_not_process' => 'SAMPEL BELUM RUNNING',
            'sample_not_verify'  => 'SAMPEL BELUM VERIFIKASI',
            'test_finish'        => 'PEMERIKSAAN SELESAI',
            'total_test'         => 'TOTAL PEMERIKSAAN',
            'total_test_month'   => 'TOTAL PEMERIKSAAN PER BULAN',
        ];

        $chunked = array_chunk($fields, 3, true);

        $data = [];

        foreach ($chunked as $chunk) {
            $group = [];
            foreach ($chunk as $field => $label) {
                $group[$field] = [
                    'label' => $label,
                    'total' => $qry_data->$field ?? 0,
                ];
            }
            $data[] = $group;
        }

        return $data;
    }

    function monitoring_process_sample($user)
    {
        // dd($user);
        $data['cust_name'] = $user->has_company->customer_name;
        $current['cust_branch'] = $user->has_branch->outlet_id;
        $data['cust_branch'] = $user->has_branch->branch_name;
        $data['table'] = DB::table('dash_patient_process_sample')
            ->where('cust_name', $data['cust_name'])
            ->where('cust_branch', $current['cust_branch'])
            ->get()->toArray();
        $data['info'] = DB::table('dash_patient_sample_summary')
            ->where('cust_name', $data['cust_name'])
            ->where('cust_branch', $current['cust_branch'])
            ->first();
        $data['last_update'] = $data['info']->dttm;
        // dd($data['info']->dttm);
        return $data;
    }

    function monitoring_regno($user)
    {
        $parameters = [1, 2, 3, 5];
        $array = Dashboard::where('cust_name', $user->has_company->customer_id)->where('cust_branch', $user->has_branch->outlet_id)->orderBy('reg_no')->get();
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
        if (count($array)) {
            $data['last_update'] = $array[0]->dttm;
        } else {
            $data['last_update'] = null;
        }

        foreach ($array as $index => $loop) {
            if ($loop->cust_name) {
                // Speciment Collection
                $spe_col = null;
                if (in_array($loop['sc'], $parameters)) {
                    $spe_col = ['reg_no' => str_pad($loop['reg_no'], 4, "0", STR_PAD_LEFT), 'type' => $loop['sc']];
                    if (strtoupper($loop['type']) == 'CITO') {
                        if (count($data) > 0) {
                            $data['sc'][$idx_cito_sc]['cito'] = $spe_col;
                            if ($idx_cito_sc >= $idx_non_sc) {
                                $data['sc'][$idx_cito_sc]['noncito'] = null;
                            }
                        } else {
                            $data['sc'][$idx_cito_sc]['cito'] = $spe_col;
                            $data['sc'][$idx_cito_sc]['noncito'] = null;
                        }
                        $idx_cito_sc += 1;
                    } else {
                        if (count($data) > 0) {
                            if ($idx_cito_sc <= $idx_non_sc) {
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
                if (in_array($loop['ps'], $parameters)) {
                    $pro_sam = ['reg_no' => str_pad($loop['reg_no'], 4, "0", STR_PAD_LEFT), 'type' => $loop['ps']];
                    if (strtoupper($loop['type']) == 'CITO') {
                        if (count($data) > 0) {
                            $data['ps'][$idx_cito_ps]['cito'] = $pro_sam;
                            if ($idx_cito_ps >= $idx_non_ps) {
                                $data['ps'][$idx_cito_ps]['noncito'] = null;
                            }
                        } else {
                            $data['ps'][$idx_cito_ps]['cito'] = $pro_sam;
                            $data['ps'][$idx_cito_ps]['noncito'] = null;
                        }
                        $idx_cito_ps += 1;
                    } else {
                        if (count($data) > 0) {
                            if ($idx_cito_ps <= $idx_non_ps) {
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
                if (in_array($loop['rs'], $parameters)) {
                    $result = ['reg_no' => str_pad($loop['reg_no'], 4, "0", STR_PAD_LEFT), 'type' => $loop['rs']];
                    if (strtoupper($loop['type']) == 'CITO') {
                        if (count($data) > 0) {
                            $data['rs'][$idx_cito_rs]['cito'] = $result;
                            if ($idx_cito_rs >= $idx_non_rs) {
                                $data['rs'][$idx_cito_rs]['noncito'] = null;
                            }
                        } else {
                            $data['rs'][$idx_cito_rs]['cito'] = $result;
                            $data['rs'][$idx_cito_rs]['noncito'] = null;
                        }
                        $idx_cito_rs += 1;
                    } else {
                        if (count($data) > 0) {
                            if ($idx_cito_rs <= $idx_non_rs) {
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
                if (in_array($loop['vr'], $parameters)) {
                    $verif = ['reg_no' => str_pad($loop['reg_no'], 4, "0", STR_PAD_LEFT), 'type' => $loop['vr']];
                    if (strtoupper($loop['type']) == 'CITO') {
                        if (count($data) > 0) {
                            $data['vr'][$idx_cito_vr]['cito'] = $verif;
                            if ($idx_cito_vr >= $idx_non_vr) {
                                $data['vr'][$idx_cito_vr]['noncito'] = null;
                            }
                        } else {
                            $data['vr'][$idx_cito_vr]['cito'] = $verif;
                            $data['vr'][$idx_cito_vr]['noncito'] = null;
                        }
                        $idx_cito_vr += 1;
                    } else {
                        if (count($data) > 0) {
                            if ($idx_cito_vr <= $idx_non_vr) {
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
                if (in_array($loop['au'], $parameters)) {
                    $author = ['reg_no' => str_pad($loop['reg_no'], 4, "0", STR_PAD_LEFT), 'type' => $loop['au']];
                    if (strtoupper($loop['type']) == 'CITO') {
                        if (count($data) > 0) {
                            $data['au'][$idx_cito_au]['cito'] = $author;
                            if ($idx_cito_au >= $idx_non_au) {
                                $data['au'][$idx_cito_au]['noncito'] = null;
                            }
                        } else {
                            $data['au'][$idx_cito_au]['cito'] = $author;
                            $data['au'][$idx_cito_au]['noncito'] = null;
                        }
                        $idx_cito_au += 1;
                    } else {
                        if (count($data) > 0) {
                            if ($idx_cito_au <= $idx_non_au) {
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
                $kritis = ['reg_no' => str_pad($loop['reg_no'], 4, "0", STR_PAD_LEFT), 'type' => $loop['kr']];
                if ($loop['kr'] == '1') {
                    $data['kr'][$idx_kritis] = $kritis;
                    $idx_kritis += 1;
                }
            }
        }

        $data['tat'] = DashMonitoringTat::where('cust_name', $user->has_company->customer_id)->where('cust_branch', $user->has_branch->outlet_id)->get();

        return $data;
    }

    // =========================================================== BLOOD BANK ===========================================================
    function dash_visitation($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_visitation')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->first();

        $fields = [
            'visitation' => [
                'label' => 'JUMLAH KUNJUNGAN',
                'color' => '#3B82F6' // Biru
            ],
            'test_not_finish' => [
                'label' => 'BELUM SELESAI',
                'color' => '#F59E0B' // Oranye
            ],
            'test_finish' => [
                'label' => 'SUDAH SELESAI',
                'color' => '#10B981' // Hijau
            ],
            'total' => [
                'label' => 'TOTAL PASIEN',
                'color' => '#EC4798' // Pink
            ],
        ];

        $chunked = array_chunk($fields, 1, true);

        $data = [];

        foreach ($chunked as $chunk) {
            $group = [];

            foreach ($chunk as $field => $label) {

                // khusus field total
                if ($field === 'total') {
                    $total = ($qry_data->test_not_finish ?? 0) + ($qry_data->test_finish ?? 0);
                } else {
                    $total = $qry_data->$field ?? 0;
                }

                $group[$field] = [
                    'label' => $label['label'],
                    'color' => $label['color'],
                    'total' => $total,
                ];
            }

            $data[] = $group;
        }

        return $data;
    }

    // $data[1] = $this->dash_patient_result($user->has_company->customer_id, $user->has_branch->outlet_id);
    function dash_patient_result($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_patient_result')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->get();

        $data['title'] = strtoupper("LISTING MONITORING HASIL PASIEN");

        $data['data'] = $qry_data->map(function ($item) {
            return [
                'reg_no'       => $item->reg_no,
                'patient_name' => $item->patient_name,
                'rm_no'        => $item->rm_no,
                'total_test'   => $item->total_test,
                'test_proses'  => $item->test_proses,
                'test_result'  => $item->test_result,
                'test_finish'  => $item->test_finish,
            ];
        })->toArray();

        return $data;
    }

    // $data[2] = $this->dash_blood_stock($user->has_company->customer_id, $user->has_branch->outlet_id);
    function dash_blood_stock($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_blood_stock')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->get();

        $data['title'] = strtoupper('STOCK REAL TIME KOMPONEN DARAH');

        $data['data'] = $qry_data->map(function ($item) {
            return collect($item)->only([
                'component',
                'blood_apos',
                'blood_aneg',
                'blood_bpos',
                'blood_bneg',
                'blood_opos',
                'blood_oneg',
                'blood_abpos',
                'blood_abneg',
            ]);
        })->toArray();

        return $data;
    }

    // $data[3] = $this->dash_visit_classification($user->has_company->customer_id, $user->has_branch->outlet_id);
    function dash_visit_classification($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_visit_classification')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->orderBy('patient_type')
            ->get();
        $data['title'] = strtoupper('prioritas pasien');
        $data['labels'] = $qry_data->pluck('patient_type')
            ->toArray();

        $data['data'][] = [
            'data' => $qry_data->pluck('total')->toArray()
        ];

        return $data;
    }

    // $data[4] = $this->dash_patient_visit($user->has_company->customer_id, $user->has_branch->outlet_id);
    function dash_patient_visit($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_patient_visit')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->orderBy('date_visit')
            ->get();
        $data['title'] = strtoupper('TREND KUNJUNGAN');
        $data['labels'] = $qry_data->pluck('day_name')
            ->toArray();

        $data['data'][] = [
            'data' => $qry_data->pluck('total')->toArray()
        ];

        return $data;
    }

    // $data[5] = $this->dash_blood_stock_expiring($user->has_company->customer_id, $user->has_branch->outlet_id);
    function dash_blood_stock_expiring($cust_id, $branch_id)
    {
        $qry_data = DB::table('dash_blood_stock_expiring')
            ->where('cust_name', $cust_id)
            ->where('cust_branch', $branch_id)
            ->orderByRaw("
                CASE
                    WHEN exp_status ILIKE '%BESOK%' THEN 0
                    ELSE COALESCE(
                        NULLIF(
                            regexp_replace(exp_status, '[^0-9]', '', 'g'),
                            ''
                        )::INTEGER,
                        0
                    )
                END
            ")
            ->get();

        $return_array = array();
        $return_array['title'] = strtoupper('Blood Stock Expiring');

        foreach ($qry_data as $data) {
            $return_array['data'][] = [
                'title'     => $data->component . ' ' . $data->blood_type . $data->blood_rhesus . ' / ' . $data->blood_bag,
                'status'    => $data->exp_status,
            ];
        }

        return $return_array;
    }

    //========================================================== END BLOOD BANK ===========================================================

    public function get_permissions()
    {
        $array_permission = array();
        foreach (Auth::user()->getAllPermissions() as $key => $permission) {
            array_push($array_permission, $permission->name);
        }

        if (count($array_permission)) {
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
