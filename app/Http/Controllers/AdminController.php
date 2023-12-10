<?php

namespace App\Http\Controllers;

use App\Domains\Announcement\Models\Announcement;
use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Images;
use App\Models\News;
use App\Models\Warga;
use App\Models\Inbox;
use App\Models\Surat;
use Auth;
use Redirect;
use Str;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index_news()
    {
        $data['news'] = News::orderBy('id', 'DESC')->get();
        return view('backend.auth.admin.news.index_news', $data);
    }
    public function store_news(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = 'news';
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($destinationPath, $filename, 'public');

            $news = new News;
            $news->uuid = Str::uuid()->toString();
            $news->judul = $request->title;
            $news->gambar = "storage/{$destinationPath}/{$filename}";
            $news->detail = $request->detail;
            $news->upload_by = Auth::user()->name;
            $news->save();
            return Redirect::back()->withFlashSuccess(__('Berita atau Pengumuman berhasil diterbitkan!.'));
        }
        return redirect()->back()->with('error', 'Tidak ada data yang diterbitkan.');
    }
    public function destroy_news($id)
    {
        $news = News::where('uuid', $id)->first();
        $news->delete();

        return response()->json(null, 204);
    }
    public function edit_news($id)
    {
        $data['news'] = News::where('uuid', $id)->first();
        return view('backend.auth.admin.news.edit_news', $data);
    }
    public function update_news(Request $request, $id)
    {
        $news = News::where('uuid', $id)->first();
        $news->judul = $request->title;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = 'news';
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($destinationPath, $filename, 'public');
            $news->gambar = "storage/{$destinationPath}/{$filename}";
        }
        $news->detail = $request->detail;
        $news->upload_by = Auth::user()->name;
        $news->save();
        return redirect()->route('admin.index_news')->withFlashSuccess(__('Berita atau Pengumuman berhasil diupdate!.'));
    }

    public function index_announce()
    {
        $data['announce'] = Announcement::orderBy('id', 'DESC')->get();
        return view('backend.auth.admin.index_announce', $data);
    }
    public function store_announce(Request $request)
    {
        $tanggalMulai = $request->input('tanggalMulai');
        $jamMulai = $request->input('jamMulai');
        $tanggalAkhir = $request->input('tanggalAkhir');
        $jamAkhir = $request->input('jamAkhir');
        if ($request->type == 'info') {
            $type = 'info';
        } else {
            $type = 'danger';
        }

        $waktuMulai = Carbon::createFromFormat('Y-m-d H:i', $tanggalMulai . ' ' . $jamMulai);
        $waktuAkhir = Carbon::createFromFormat('Y-m-d H:i', $tanggalAkhir . ' ' . $jamAkhir);

        $announce = new Announcement;
        $announce->uuid = Str::uuid()->toString();
        $announce->type = $type;
        $announce->message = $request->detail;
        $announce->enabled = 1;
        $announce->starts_at = $waktuMulai;
        $announce->ends_at = $waktuAkhir;
        $announce->save();
        return Redirect::back()->withFlashSuccess(__('Pengumuman berhasil diterbitkan!.'));
    }
    public function destroy_announce($id)
    {
        $news = Announcement::where('uuid', $id)->first();
        $news->delete();

        return response()->json(null, 204);
    }
    public function edit_announce($id)
    {
        $data['news'] = News::where('uuid', $id)->first();
        return view('backend.auth.admin.news.edit_news', $data);
    }
    public function update_announce(Request $request, $id)
    {
        $announce =  Announcement::findOrFail($id);
        $announce->uuid = Str::uuid()->toString();
        $announce->type = $request->type;
        $announce->message = $request->message;
        $announce->enabled = 1;
        $announce->starts_at = $request->starts_at;
        $announce->ends_at = $request->ends_at;
        $announce->update();
        return Redirect::back()->withFlashSuccess(__('Pengumuman berhasil diupdate!.'));
    }

    public function index_warga()
    {
        $response = Http::withOptions(['verify' => false])->get('https://api.binderbyte.com/wilayah/provinsi', [
            'api_key' => '7f48ea088bdff205419549c88f93d211651e74f643a77fff2d9f56f33d5b2909'
        ]);

        if ($response->successful()) {
            $data['provinsi'] = $response->json();
            $data['wargas'] = Warga::orderBy('id', 'DESC')->where('statusDiKeluarga', 'Kepala Keluarga')->get();
            return view('backend.auth.admin.warga.index_warga', $data);
        } else {
            return response()->json(['error' => 'Tidak dapat mengambil data dari API'], 500);
        }
    }
    public function store_warga(Request $request)
    {
        $uuid = Str::uuid()->toString();
        $wargas = new Warga;
        $wargas->uuid = $uuid;
        $wargas->nama = $request->nama;
        $wargas->nomorKK = $request->nomorKK;
        $wargas->nomorKTP = $request->nomorKTP;
        $wargas->email = $request->email;
        $wargas->statusDiKeluarga = 'Kepala Keluarga';
        $wargas->save();

        $user   = new User;
        $user->type = 'user';
        $user->uuid = $uuid;
        $user->name = $request->nama;
        $user->email = $request->nomorKK . '@kemas.id';
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->password = Hash::make($request->nomorKK);
        $user->save();
        return Redirect::back()->withFlashSuccess(__('Data Warga berhasil ditambahkan!.'));
    }
    public function destroy_warga($id)
    {
        $wargas = Warga::where('id', $id)->first();
        $wargas->delete();
        return response()->json(null, 204);
    }
    public function edit_warga($id)
    {
        $data['wargas'] = Warga::where('uuid', $id)->first();
        return view('backend.auth.admin.warga.edit_warga', $data);
    }
    public function update_warga(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomorKK' => 'required|string|max:20',
            'nomorKTP' => 'required|string|max:20',
            'tempatLahir' => 'required|string',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|string',
            'statusPerkawinan' => 'required|string',
            'pekerjaan' => 'nullable|string',
            'nomorTelepon' => 'nullable|string',
            'email' => 'nullable|email',
            'statusDiKeluarga' => 'required|string',
            'kepalaKeluarga' => 'nullable|string',
            'golonganDarah' => 'nullable|string',
            'kewarganegaraan' => 'required|string',
            'agama' => 'required|string'
        ]);
        $validatedData = $validator->validated();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $warga = Warga::findOrFail($id);
        $warga->update($validatedData);

        return Redirect::back()->withFlashSuccess(__('Data Warga berhasil diupdate!'));
    }
    public function view_warga($kk)
    {
        $response = Http::withOptions(['verify' => false])->get('https://api.binderbyte.com/wilayah/provinsi', [
            'api_key' => '7f48ea088bdff205419549c88f93d211651e74f643a77fff2d9f56f33d5b2909'
        ]);

        if ($response->successful()) {
            $data['kk']       = Warga::where('nomorKK', $kk)->where('statusDiKeluarga', 'Kepala Keluarga')->first();
            $data['istri']    = Warga::where('nomorKK', $kk)->where('statusDiKeluarga', 'Istri')->get();
            $data['anak']     = Warga::where('nomorKK', $kk)->where('statusDiKeluarga', 'Anak')->get();
            $data['provinsi'] = $response->json();
            $data['wargas'] = Warga::where('nomorKK', $kk)->orderBy('id', 'DESC')->get();
            return view('backend.auth.admin.warga.view_warga', $data);
        } else {
            return response()->json(['error' => 'Tidak dapat mengambil data dari API'], 500);
        }
    }
    public function add_warga(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomorKK' => 'required|string|max:20',
            'nomorKTP' => 'required|string|max:20',
            'tempatLahir' => 'required|string',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|string',
            'statusPerkawinan' => 'required|string',
            'pekerjaan' => 'nullable|string',
            'nomorTelepon' => 'nullable|string',
            'email' => 'nullable|email',
            'statusDiKeluarga' => 'required|string',
            'kepalaKeluarga' => 'nullable|string',
            'golonganDarah' => 'nullable|string',
            'kewarganegaraan' => 'required|string',
            'agama' => 'required|string'
        ]);
        $validatedData['uuid'] = Str::uuid()->toString();
        Warga::create($validatedData);
        return Redirect::back()->withFlashSuccess(__('Data Warga berhasil ditambahkan!'));
    }
    public function find_warga(Request $request)
    {
        $type = $request->type;
        $key = $request->keyword;
        $query = Warga::query();
        switch ($type) {
            case 'kk':
                $query->where('nomorKK', 'like', '%' . $key . '%');
                break;
            case 'ktp':
                $query->where('nomorKTP', 'like', '%' . $key . '%');
                break;
            case 'nama':
                $query->where('nama', 'like', '%' . $key . '%');
                break;
            case 'telepon':
                $query->where('nomorTelepon', 'like', '%' . $key . '%');
                break;
        }
        $data['wargas'] = $query->get();
        return view('backend.auth.admin.warga.index_warga', $data);
    }

    public function index_approval()
    {
        $data['surats'] = Surat::where('ttd', 0)->orderBy('tanggal_buat', 'DESC')->get();
        return view('backend.auth.admin.index_approval', $data);
    }
    public function list_approval()
    {
        $data['surats'] = Surat::where('ttd', 1)->orderBy('tanggal_buat', 'DESC')->get();
        return view('backend.auth.admin.index_approval', $data);
    }
    public function approve_approval(Request $request, $id)
    {
        $surat = Surat::where('uuid', $id)->first();
        if (!$surat) {
            return response()->json(['message' => 'Surat tidak ditemukan'], 404);
        }
        $surat->nomor = $request->nomor;
        $surat->ttd = 1;
        $surat->update();
        return response()->json(['message' => 'Surat berhasil disetujui']);
    }
    public function reject_approval(Request $request, $id)
    {
        $surat = Surat::where('uuid', $id)->first();
        if (!$surat) {
            return response()->json(['message' => 'Surat tidak ditemukan'], 404);
        }
        $surat->ttd = 2;
        $surat->update();
        return Redirect::back()->withFlashSuccess(__('Pengajuan surat ditolak!'));
    }
    public function index_inbox()
    {
        $data['inboxs'] = Inbox::orderBy('tanggal', 'DESC')->get();
        return view('backend.auth.admin.index_inbox', $data);
    }
}
