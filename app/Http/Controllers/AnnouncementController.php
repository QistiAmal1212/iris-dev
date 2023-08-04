<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterAnnouncementType;
use App\Models\Other\Announcement;
use App\Models\Other\AnnouncementTarget;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $announcements = Announcement::paginate(20);

        return view('admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        $MasterAnnouncementType = MasterAnnouncementType::all();
        $Role = Role::all();
        return view('admin.announcement.create', compact('MasterAnnouncementType', 'Role'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $announcement = Announcement::create([
                'title' => $request->announcement_title,
                'description' => $request->announcement_description,
                'announcement_type_id' => $request->announcement_type_id,
                'created_by_user_id' => auth()->user()->id,
                // 'date_start' => Carbon::createFromFormat('d/m/Y', $request->date_start)->toDateTimeString(),
                // 'date_end' => Carbon::createFromFormat('d/m/Y', $request->date_end)->toDateTimeString(),
                'date_start' => Carbon::createFromFormat('Y-m-d', $request->date_start)->toDateTimeString(),
                'date_end' => Carbon::createFromFormat('Y-m-d', $request->date_end)->toDateTimeString(),
            ]);

            $request_announcement_target = $request->announcement_target ? $request->announcement_target : [];
            foreach ($request_announcement_target as $role) {
                $announcement_target = new AnnouncementTarget;
                $announcement_target->role_id = $role;
                $announcement_target->announcement_id = $announcement->id;
                $announcement_target->save();
            }

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        redirect()->route('announcement.index');
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    public function show(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $MasterAnnouncementType = MasterAnnouncementType::all();
        $Role = Role::all();
        $AnnouncementTarget = AnnouncementTarget::where('announcement_id', $id)->get()->pluck('role_id');
        return view('admin.announcement.show', compact('announcement', 'MasterAnnouncementType', 'Role', 'AnnouncementTarget'));
    }

    public function edit(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        $MasterAnnouncementType = MasterAnnouncementType::all();
        $Role = Role::all();
        $AnnouncementTarget = AnnouncementTarget::where('announcement_id', $id)->get()->pluck('role_id');
        return view('admin.announcement.edit', compact('announcement', 'MasterAnnouncementType', 'Role', 'AnnouncementTarget'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $announcement = Announcement::findOrFail($id);
            $announcement = $announcement->update([
                'title' => $request->announcement_title,
                'description' => $request->announcement_description,
                'announcement_type_id' => $request->announcement_type_id,
                'date_start' => Carbon::createFromFormat('Y-m-d', $request->date_start)->toDateTimeString(),
                'date_end' => Carbon::createFromFormat('Y-m-d', $request->date_end)->toDateTimeString(),
            ]);

            $announcement_target = AnnouncementTarget::where('announcement_id', $id)->delete();
            $request_announcement_target = $request->announcement_target ? $request->announcement_target : [];
            foreach ($request_announcement_target as $role) {
                $announcement_target = new AnnouncementTarget;
                $announcement_target->role_id = $role;
                $announcement_target->announcement_id = $id;
                $announcement_target->save();
            }

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return to_route('announcement.index');

    }

    public function destroy(Request $request, $id)
    {
        $announcement_target = AnnouncementTarget::where('announcement_id', $id)->delete();
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        session()->put('success', 'Successfully deleted Announcement');

        return redirect()->route('announcement.index');
    }

    public function refreshAnnouncementTable()
    {
        $announcements = Announcement::paginate(20);
        return view('admin.announcement.tableAnnouncement', compact('announcements'));
    }

}
