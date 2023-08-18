<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MasterModule;
use App\Models\SecurityMenu;
use Yajra\DataTables\DataTables;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function menuIndex(Request $request)
    {
        $menu = SecurityMenu::all();
        if ($request->ajax()) {
            return Datatables::of($menu)
                ->editColumn('name', function ($menu) {
                    return $menu->name;
                })
                ->editColumn('type', function ($menu) {
                    return $menu->type;
                })
                ->editColumn('module_id', function ($menu) {
                    $module = null;

                    if($menu->module_id != null)
                    {
                        $module = MasterModule::find($menu->module_id)->name;
                    }

                    return $module;
                })
                ->editColumn('level', function ($menu) {
                    return $menu->level;
                })
                ->editColumn('sequence', function ($menu) {
                    return $menu->sequence;
                })
                ->editColumn('menu_link', function ($menu) {

                    $menuLink = null;

                    if($menu->menu_link != null)
                    {
                        $menuLink = SecurityMenu::find($menu->menu_link)->name;
                    }

                    return $menuLink;
                })
                ->editColumn('action', function ($menu) {
                    $button = "";

                    // $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    // $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="viewRoleForm('.$roles->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    // $button .= '<a href="#" class="btn btn-xs btn-default"> <i class="fas fa-trash text-danger"></i> </a>';
                    // $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.security.menu');
    }

    public function menuCreate(Request $request)
    {
        $masterModule = MasterModule::whereNot('code', 'home')->get();
        $menuLevel2 = count(SecurityMenu::where('level', 1)->get());
        $menuLevel3 = count(SecurityMenu::where('level', 2)->get());
        return view('admin.security.menu_create', compact(['masterModule', 'menuLevel2', 'menuLevel3']));
    }

    public function menuStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'type' => 'required|string|in:Web,Menu',
                'module' => 'required_if:type,Web|nullable|integer|exists:master_module,id',
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

            SecurityMenu::create([
                'name' => $request->name, 
                'type' => $request->type, 
                'module_id' => ($request->type == 'Web') ? $request->module : null, 
                'level' => $request->level,
                'sequence' => $lastSequence ? $lastSequence->sequence + 1 : 1,
                'menu_link' => ($request->level != 1) ? $request->menu_link : null,
            ]);

            DB::commit();
        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return redirect()->route('admin.security.menu');
    }

    public function menuLink(Request $request)
    {
        $level = $request->level;

        if($level == 2) {
            $linkLevel = 1;
        } else if($level == 3) {
            $linkLevel = 2;
        }

        $menuLink = SecurityMenu::where('level', $linkLevel)->get();

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

    public function accessIndex(Request $request)
    {
        return view('admin.security.menu');
    }

    public function sequenceIndex(Request $request)
    {
        return view('admin.security.menu');
    }

}
