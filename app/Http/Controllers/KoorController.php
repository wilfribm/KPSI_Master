<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Response;
use File;
use App\Koor;
use App\Dosen;
use App\Mahasiswa;
use App\User;

use App\Sk_kp;
use App\Pra_kp;
use App\Kp;
use App\Ajaran;
use App\Batas_kp;


use Auth;

class KoorController extends Controller
{

    public function setajaran()
    {
        $dajaran = DB::SELECT("SELECT * FROM ajaran");
        return view('koor/setajaran', compact('dajaran'));
    }

    public function setajaranAct(Request $request)
    {
        $update = DB::table('ajaran')
        ->update(['semester' => $request->semester,
                        'tahun' => $request->tahun,
                        ]);
        return redirect('/koor/set/ajaran')->with('sukses-ubah','Wahh Ajaran berhasil diubah nih');

        
    }

    

    

    public function index_koor()
    {
        $id = Auth::guard('koor')->user()->id;
            $data = DB::select("SELECT * FROM koor WHERE id = '$id'");
            // var_dump($data);
    	return view('koor/index_koor');
    }

    public function verifikasi_sk()
    {
        
        $data = DB::select("SELECT * FROM sk_kp");
        $downloads = DB::table('sk_kp')->get();
        return view ('koor/verifikasi_sk', compact('data','downloads'));
    }

     

    public function status_sk($id)
    {
        $data = \DB::table('sk_kp')->where('id', $id)->first();

        $status_sekarang = $data->status;

        if($status_sekarang == 1){
            \DB::table('sk_kp')->where('id',$id)->update([
                'status'=>0
            ]);
        }else{
            \DB::table('sk_kp')->where('id',$id)->update([
                'status'=>1
            ]);
        }

        \Session::flash('sukses','status berhasil diubah');
        return redirect('koor/verifikasi_sk');

    }

    //PRA KP
    public function verifikasi_prakp()
    {
        
        $data = DB::select("SELECT * FROM pra_kp");
        $downloads = DB::table('pra_kp')->get();
        return view ('koor/verifikasi_prakp', compact('data','downloads'));
    }

    public function status_prakp($id)
    {
        $data = \DB::table('pra_kp')->where('id', $id)->first();

        $status_sekarang = $data->status;

        if($status_sekarang == 1){
            \DB::table('pra_kp')->where('id',$id)->update([
                'status'=>0
            ]);
        }else{
            \DB::table('pra_kp')->where('id',$id)->update([
                'status'=>1
            ]);
        }

        \Session::flash('sukses','status berhasil diubah');
        return redirect('koor/verifikasi_prakp');

    }

    //KP
    public function verifikasi_kp()
    {
        
        $data = DB::select("SELECT * FROM kp");
        $datapra = DB::select("SELECT * FROM kp");
        $downloads = DB::table('kp')->get();

        return view ('koor/verifikasi_kp', compact('data','downloads','datapra'));
    }

    public function status_kp($id)
    {
        $data = \DB::table('kp')->where('id', $id)->first();

        $status_sekarang = $data->status;

        if($status_sekarang == 1){
            \DB::table('kp')->where('id',$id)->update([
                'status'=>0
            ]);
        }else{
            \DB::table('kp')->where('id',$id)->update([
                'status'=>1
            ]);
        }

        \Session::flash('sukses','status berhasil diubah');
        return redirect('koor/verifikasi_kp');

    }

    public function downsk($id)
    {
        $down = Sk_kp::findOrfail($id);
        $path = public_path('dok_sk/' . $down->dokumen);
        header("Content-type: application/pdf");
        header("Content-Length: " . filesize($path));
        readfile($path);  
    }

    public function downpra($id)
    {
        $down = Pra_kp::findOrfail($id);
        $path = public_path('dok_pra/' . $down->dokumen);
        header("Content-type: application/pdf");
        header("Content-Length: " . filesize($path));
        readfile($path);  
    }

    public function downkp($id)
    {
        $down = Kp::findOrfail($id);
        $path = public_path('dok_kp/' . $down->dokumen);
        header("Content-type: application/pdf");
        header("Content-Length: " . filesize($path));
        readfile($path);  
    }

   

    public function penjadwalan_ujian()
    {
        $data = DB::select("SELECT * FROM kp WHERE status='1'");
        return view('/koor/penjadwalan_ujian', compact('data'));
    }

    public function form_penjadwalan_ujian(Request $request, $id)
    {
        $id = $request->route('id');
        $data = DB::select("SELECT * FROM kp WHERE id='$id'");
        $ddosen = DB::SELECT("SELECT * FROM dosen"); 
        return view('/koor/form_penjadwalan_ujian', compact('data','ddosen'));
    }

    public function form_penjadwalan_ujian_act(Request $request, $id)
    {
        $id = $request->route('id');
        $update = DB::table('jadwal_ujian')
              ->where('id', $id)
              ->insert([
                'nim' => $request->nim,
                'dosbing' => $request->dosbing,
                'dosuji' => $request->dosuji,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'ruangan' => $request->ruangan
                        ]);

        return redirect('/koor/penjadwalan_ujian')->with('sukses-tambah','Wahh Ajaran berhasil atur jadwal nih');
    }

    public function lihat_jadwal_ujian(Request $request, $nim)
    {
        $nim = $request->route('nim');
        $data = DB::select("SELECT * FROM jadwal_ujian WHERE nim='$nim'");
        return view('/koor/lihat_jadwal_ujian', compact('data'));
    }


    public function melihat_daftar_registrasi()
    {
        $pra = DB::select("SELECT * FROM pra_kp WHERE status='1'");
        $kp = DB::select("SELECT * FROM kp WHERE status='1'");
        return view('koor/melihat_daftar_registrasi', compact('pra','kp'));
    }

    public function batas_pelaksanaan()
    {
         $data = Batas_kp::all();
        return view('koor/batas_pelaksanaan', compact('data'));
    }

    public function form_batas_pelaksanaan()
    {
        $data = Batas_kp::all();
        return view('/koor/form_batas_pelaksanaan', compact('data'));
    }

    public function form_batas_pelaksanaan_act(Request $request)
    {
        Batas_kp::create($request->all());
         return redirect('/koor/batas/pelaksaan/kp')->with('sukses-tambah','Duhh berhasil nihh...');
    }

    public function form_ubah_batas_pelaksanaan($id)
    {
        $data = Batas_kp::find($id);
        $datanya = Batas_kp::all();
        return view('/koor/form_ubah_batas_pelaksanaan', compact('data','datanya'));
    }

    public function form_ubah_batas_pelaksanaan_act(Request $request, $id)
    {
        $data = Batas_kp::find($id);
        $data->update($request->all());
        return redirect('/koor/batas/pelaksaan/kp')->with('sukses-ubah','Duhh berhasil nihh...');
    }
    
    
}
