<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MasterModule;
use App\Models\SecurityMenu;
use Yajra\DataTables\DataTables;
use App\Models\LogSystem;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.security.menu')->first();
        $this->menu = $this->module->menu;
    }

    public function index(Request $request)
    {
        $roles = auth()->user()->roles;
        $roles = $roles->pluck('id')->toArray();

        $accessRole = $this->menu->role()->whereIn('id', $roles)->get();

        $accessAdd = $accessUpdate = $accessDelete = false;

        foreach($accessRole as $access) {
            if($access->pivot->add){
                $accessAdd = true;
            }

            if($access->pivot->update){
                $accessUpdate = true;
            }

            if($access->pivot->delete){
                $accessDelete = true;
            }
        }

        $menu = SecurityMenu::all();
        $menuLevel1 = SecurityMenu::where('level', 1)->get();
        $menuLevel2 = SecurityMenu::where('level', 2)->get();
        $menuLevel3 = SecurityMenu::where('level', 3)->get();

        if($request->level){
            if ($request->ajax()) {
                if($request->level == 1) {
                    $menuLevel = $menuLevel1;
                    $details = 'Level 1';
                } else if($request->level == 2) {
                    $menuLevel = $menuLevel2;
                    $details = 'Level 2';
                } else if($request->level == 3) {
                    $menuLevel = $menuLevel3;
                    $details = 'Level 3';
                }

                $log = new LogSystem;
                $log->module_id = MasterModule::where('code', 'admin.security.menu')->firstOrFail()->id;
                $log->activity_type_id = 1;
                $log->description = "Lihat Senarai Menu ".$details;
                $log->data_old = json_encode($request->input());
                $log->url = $request->fullUrl();
                $log->method = strtoupper($request->method());
                $log->ip_address = $request->ip();
                $log->created_by_user_id = auth()->id();
                $log->save();

                return Datatables::of($menuLevel)
                    ->editColumn('sequence', function ($menuLevel) {
                        return $menuLevel->sequence;
                    })
                    ->editColumn('name', function ($menuLevel) {
                        return $menuLevel->name;
                    })
                    ->editColumn('type', function ($menuLevel) {
                        return $menuLevel->type;
                    })
                    ->editColumn('module_id', function ($menuLevel) {
                        return ($menuLevel->module_id != null) ? $menuLevel->module->name : null;
                    })
                    ->editColumn('action', function ($menuLevel) use ($accessDelete) {
                        $button = "";

                        $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                        // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="editMenuForm('.$menuLevel->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        if($accessDelete){
                        // $button .= '<a href="#" class="btn btn-xs btn-default"> <i class="fas fa-trash text-danger"></i> </a>';
                        }
                        $button .= '</div>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }

        // return view('admin.security.menu');
        return view('admin.security.menu', compact('menuLevel1', 'accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function create(Request $request)
    {
        $roles = auth()->user()->roles;
        $roles = $roles->pluck('id')->toArray();

        $accessRole = $this->menu->role()->whereIn('id', $roles)->get();

        $accessAdd = false;

        foreach($accessRole as $access) {
            if($access->pivot->add){
                $accessAdd = true;
            }
        }

        $masterModule = MasterModule::whereNot('code', 'home')->get();
        $menuLevel2 = count(SecurityMenu::where('level', 1)->get());
        $menuLevel3 = count(SecurityMenu::where('level', 2)->get());
        return view('admin.security.menu_create', compact(['masterModule', 'menuLevel2', 'menuLevel3', 'accessAdd']));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'type' => 'required|string|in:Web,Menu',
                'module' => 'required_if:type,Web|nullable|integer|exists:master_module,id|unique:security_menu,module_id',
                'level' => 'required|integer|between:1,3',
                'menu_link' => 'required_if:level,2,3|integer|exists:security_menu,id',
            ]);

            $lastSequence = SecurityMenu::where('level', $request->level);

            if($request->level != 1)
            {
                $lastSequence = $lastSequence->where('menu_link', $request->menu_link)->orderBy('sequence', 'desc')->first();
            } else {
                $lastSequence = $lastSequence->orderBy('sequence', 'desc')->first();
            }

            $menu = SecurityMenu::create([
                'name' => $request->name,
                'type' => $request->type,
                'module_id' => ($request->type == 'Web') ? $request->module : null,
                'level' => $request->level,
                'sequence' => $lastSequence ? $lastSequence->sequence + 1 : 1,
                'menu_link' => ($request->level != 1) ? $request->menu_link : null,
            ]);


            //For Audit Trail
            $menuNewData = SecurityMenu::with('module')->find($menu->id);
            $menuNewData->menu_link_details = SecurityMenu::find($menuNewData->menu_link);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.security.menu')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Menu [" . $menuNewData->name . "]";
            $log->data_new = json_encode($menuNewData);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return redirect()->route('admin.security.menu');
    }

    public function edit(Request $request)
    {
        $roles = auth()->user()->roles;
        $roles = $roles->pluck('id')->toArray();

        $accessRole = $this->menu->role()->whereIn('id', $roles)->get();

        $accessUpdate = false;

        foreach($accessRole as $access) {
            if($access->pivot->update){
                $accessUpdate = true;
            }
        }

        $menuId = $request->menuId;
        $menu = SecurityMenu::with('module')->find($menuId);
        $masterModule = MasterModule::whereNot('code', 'home')->get();
        $menuLevel2 = SecurityMenu::where('level', 1)->get();
        $menuLevel3 = SecurityMenu::where('level', 2)->get();
        // $menuLevel4 = SecurityMenu::where('level', 3)->get();

        $log = new LogSystem;
        $log->module_id = MasterModule::where('code', 'admin.security.menu')->firstOrFail()->id;
        $log->activity_type_id = 2;
        $log->description = "Lihat Maklumat Menu [".$menu->name."]";
        $log->data_old = $menu;
        $log->url = $request->fullUrl();
        $log->method = strtoupper($request->method());
        $log->ip_address = $request->ip();
        $log->created_by_user_id = auth()->id();
        $log->save();

        return view('admin.security.menu_edit', compact(['menu', 'masterModule', 'menuLevel2', 'menuLevel3', 'menuId', 'accessUpdate']));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $menuId = $request->menuId;
            $menu = SecurityMenu::with('module')->find($menuId);
            $menu->menu_link_details = SecurityMenu::find($menu->menu_link);

            $validatedData = $request->validate([
                'name' => 'required|string',
                'type' => 'required|string|in:Web,Menu',
                'module' => 'required_if:type,Web|nullable|integer|exists:master_module,id|unique:security_menu,module_id,'.$menuId,
                'level' => 'required|integer|between:1,3',
                'menu_link' => 'required_if:level,2,3|integer|exists:security_menu,id',
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.security.menu')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Menu [".$menu->name."]";
            $log->data_old = json_encode($menu);
            unset($menu->menu_link_details);

            $menu->update([
                'name' => $request->name,
                'type' => $request->type,
                'module_id' => ($request->type == 'Web') ? $request->module : null,
                'level' => $request->level,
                'menu_link' => ($request->level != 1) ? $request->menu_link : null,
                'sequence' => $request->turutan,
            ]);

            //For Audit Trail
            $menuNewData = SecurityMenu::with('module')->find($menu->id);
            $menuNewData->menu_link_details = SecurityMenu::find($menuNewData->menu_link);

            $log->data_new = json_encode($menuNewData);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return redirect()->route('admin.security.menu');
    }

    public function menuLink(Request $request)
    {
        $level = $request->level;

        if($level == 2) {
            $linkLevel = 1;
        } else if($level == 3) {
            $linkLevel = 2;
        }

        $menuId = '';
        if(isset($request->id)){
            $menuId = $request->id;
        }

        $menuLink = SecurityMenu::where('level', $linkLevel)->where('type', 'Menu')->when(isset($request->id), function($query) use($menuId){
            $query->whereNot('id', $menuId);
        })->get();

        $data = '';

        if($level == 2 || $level == 3){
            $data .= '<div class="form-group">';
            $data .= '<label class="form-label" for="menu_link">Pautan Menu <span class="text text-danger">*</span> </label>';
            $data .= '<select class="form-control" name="menu_link" id="menu_link" required>';
            $data .= '<option value="">Sila Pilih:-</option>';
            foreach($menuLink as $menu) {
                $data .= '<option value="'.$menu->id.'">'.$menu->name.'</option>';
            }
            $data .= '</select>';
            $data .= '</div>';
        }

        return $data;
    }
}
