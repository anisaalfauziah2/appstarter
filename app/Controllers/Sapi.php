<?php

namespace App\Controllers;

use App\Models\SapiModel;

use CodeIgniter\Database\Config;


class Sapi extends BaseController
{
    protected $sapiModel;

    public function __construct()
    {

        $this->sapiModel = new SapiModel();
    }

    public function index()
    {

        //    $keyword = $this->request->getVar('keyword');

        //    if($keyword){

        //        $sapi = $this->sapiModel->search($keyword);
        //    } else {
        //        $sapi = $this->sapiModel;
        //    }

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $sapi = $this->sapiModel->search($keyword);
        } else {
            $sapi = $this->sapiModel;
        }

        // $currentPage = $this->request->getVar('page_sapi')?$this->request->getVar('page_orang'):1
        $data = [

            'title' => 'Daftar sapi',
            'sapi' => $this->sapiModel->get_sapi()->getResult(),
            // 'sapi' => $this->sapiModel->paginate(10, 'sapi'),
            // 'pager' => $this->sapiModel->pager
            // 'currentPage' => $currentPage
            // 'title' => 'Daftar sapi',
            // 'sapi' => $this->sapiModel->get_sapi()->getResult()



        ];

        // dd($data['sapi']);

        return view('sapi/index', $data);
    }
    public function create()
    {

        $data = [
            'title' => 'Form Tambah Data Pemeriksaan',
            'validation' => \Config\Services::validation()
        ];

        return view('sapi/create', $data);
    }
    public function save()
    {

        // $idUrut = $this->sapiModel->countAll() + 1;
        // if (!$this->validate([

        //     'bobot' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} sapi harus di isi.'
        //         ]
        //     ],
        //     'sex' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} sapi harus di isi.'
        //         ]
        //     ],
        //     'grade' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} sapi harus di isi.'
        //         ]
        //     ],
        //     'umur' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} sapi harus di isi.'
        //         ]
        //     ],
        //     'jenis_sapi' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} sapi harus di isi.'
        //         ]
        //     ],
        //     'kedatangan' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} sapi harus di isi.'
        //         ]
        //     ]
        // ])) {
        if (true) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            $bobot = $this->request->getPost('bobot');
            $sex = $this->request->getPost('sex');
            $grade = $this->request->getPost('grade');
            $umur = $this->request->getPost('umur');
            $jenis_sapi = $this->request->getPost('jenis_sapi');
            $kedatangan = $this->request->getPost('kedatangan');

            $eartag = $jenis_sapi . $grade;
            $data_baru = [
                'bobot' => $bobot,
                'sex' => $sex,
                'grade' => $grade,
                'umur' => $umur,
                'jenis_sapi' => $jenis_sapi,
                'kedatangan' => $kedatangan,

                'eartag' => $eartag
            ];
            $this->sapiModel->transStart();
            $this->sapiModel->insert($data_baru);
            // $this->sapiModel->query("INSERT INTO sapi VALUES('$idUrut','$eartag', DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT)");
            // $this->sapiModel->query("INSERT INTO kandang_pen VALUES('$idUrut', DEFAULT)");
            // $this->sapiModel->query("INSERT INTO hospital_pen VALUES('$idUrut', DEFAULT)");
            // $this->sapiModel->query("INSERT INTO pemeriksaan VALUES('$idUrut','$eartag', DEFAULT, DEFAULT)");
            // $this->sapiModel->query("INSERT INTO penyakit VALUES('$idUrut', DEFAULT, DEFAULT, DEFAULT)");
            $this->sapiModel->transComplete();



            return redirect()->to('/sapi/create')->withInput();
        }
    }
    public function detail($eartag)
    {
        $data = [
            'title' => 'Daftar sapi',
            'sapi' => $this->sapiModel->getDetail($eartag)->getResult()
        ];

        // dd($data['sapi']);

        return view('sapi/detail', $data);
    }


    // public function pagination()
    // {
    //     $$data = [
    //         'title' => 'Daftar sapi',
    //         'sapi' => $this->sapiModel->paginate(1),
    //         'pager' => $this->sapiModel->pager
    //     ];

    //     // dd($data['sapi']);

    //     return view('sapi/index', $data);

    // }
}
