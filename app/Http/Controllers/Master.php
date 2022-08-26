<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session; 
use DataTables; 
 
class Master extends Controller
{
    public function itemcategoryDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
        $data = DB::select("SELECT * FROM itemcategory ORDER BY itemcategory ASC");
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('itemcategory', function($d) {
            return $d->itemcategory;
        })
        ->editColumn('status', function($d) {
            $status = "Inactive";
            $statusClr = 0;
            if($d->status==1) 
            {
                $status = "Active";
                $statusClr = 1;
            }
            return '<p class="status-'.$statusClr.'">'.$status.'</p>';
        })
        ->editColumn('action', function($d) {
            $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
            return $btn;
        })
        ->rawColumns(['name', 'status', 'action'])
        ->make(true);    
        return [];
    }

    public function saveItemCategory(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'itemcategory'  => 'required',
            'status'        => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $itemcategory   = $request->itemcategory;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'itemcategory'    => $itemcategory,
            'status'          => $status,
            'created'         => $userid,
            'ipaddress'       => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM itemcategory WHERE itemcategory = '".$itemcategory."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('itemcategory')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('itemcategory')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editItemCategory(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM itemcategory WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deleteItemCategory(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM itemcategory WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function uomDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
        $data = DB::select("SELECT * FROM uom ORDER BY uom ASC");
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('uom', function($d) {
            return $d->uom;
        })
        ->editColumn('description', function($d) {
            return $d->description;
        })
        ->editColumn('status', function($d) {
            $status = "Inactive";
            $statusClr = 0;
            if($d->status==1) 
            {
                $status = "Active";
                $statusClr = 1;
            }
            return '<p class="status-'.$statusClr.'">'.$status.'</p>';
        })
        ->editColumn('action', function($d) {
            $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
            return $btn;
        })
        ->rawColumns(['name','description', 'status', 'action'])
        ->make(true);     
        return [];
    }

    public function saveuom(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'uom'           => 'required',
            'description'   => 'required',
            'status'        => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $uom            = $request->uom;
        $description    = $request->description;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'uom'          => $uom,
            'description'  => $description,
            'status'       => $status,
            'created'      => $userid,
            'ipaddress'    => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM uom WHERE uom = '".$uom."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('uom')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('uom')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function edituom(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM uom WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deleteuom(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM uom WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }


    public function departmentDatalist(Request $request)
    {
            if(in_array('api',$request->route()->getAction('middleware')))
            {
                Session::put('isapi','yes');
            }
            $data = DB::select("SELECT * FROM department ORDER BY code ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('code', function($d) {
                return $d->code;
            })
            ->editColumn('name', function($d) {
                return $d->name;
            })
            ->editColumn('status', function($d) {
                $status = "Inactive";
                $statusClr = 0;
                if($d->status==1) 
                {
                    $status = "Active";
                    $statusClr = 1;
                }
                return '<p class="status-'.$statusClr.'">'.$status.'</p>';
            })
            ->editColumn('action', function($d) {
                $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
                return $btn;
            })
            ->rawColumns(['code','name', 'status', 'action'])
            ->make(true);   
        return [];
    }

    public function savedepartment(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'code'      => 'required',
            'name'      => 'required',
            'status'    => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code       = 500;
        $msg        = "Failed to save data";
        $id         = $this->ThorDecrypt($request->id);
        $codefrm    = $request->code;
        $name       = $request->name;
        $status     = $request->status;
        $userid     = Session::get('login_id');
        $ipaddress  = $request->ip();

        $formData = array(

            'code'       => $codefrm,
            'name'       => $name,
            'status'     => $status,
            'created'    => $userid,
            'ipaddress'  => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM department WHERE (code = '".$codefrm."' OR name = '".$name."') ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('department')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('department')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editdepartment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM department WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deletedepartment(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM department WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function employeeroleDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
        $data = DB::select("SELECT * FROM employeerole ORDER BY code ASC");
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('code', function($d) {
            return $d->code;
        })
        ->editColumn('name', function($d) {
            return $d->name;
        })
        ->editColumn('status', function($d) {
            $status = "Inactive";
            $statusClr = 0;
            if($d->status==1) 
            {
                $status = "Active";
                $statusClr = 1;
            }
            return '<p class="status-'.$statusClr.'">'.$status.'</p>';
        })
        ->editColumn('action', function($d) {
            $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
            return $btn;
        })
        ->rawColumns(['code','name', 'status', 'action'])
        ->make(true);
        return [];
    }

    public function saveemployeerole(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'code'      => 'required',
            'name'      => 'required',
            'status'    => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code       = 500;
        $msg        = "Failed to save data";
        $id         = $this->ThorDecrypt($request->id);
        $codefrm    = $request->code;
        $name       = $request->name;
        $status     = $request->status;
        $userid     = Session::get('login_id');
        $ipaddress  = $request->ip();

        $formData = array(

            'code'       => $codefrm,
            'name'       => $name,
            'status'     => $status,
            'created'    => $userid,
            'ipaddress'  => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM employeerole WHERE (code = '".$codefrm."' OR name = '".$name."') ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('employeerole')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('employeerole')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editemployeerole(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM employeerole WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deleteemployeerole(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM employeerole WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function expensetypeDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM expensetype ORDER BY expensetype ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('expensetype', function($d) {
                return $d->expensetype;
            })
            ->editColumn('status', function($d) {
                $status = "Inactive";
                $statusClr = 0;
                if($d->status==1) 
                {
                    $status = "Active";
                    $statusClr = 1;
                }
                return '<p class="status-'.$statusClr.'">'.$status.'</p>';
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['expensetype', 'status', 'action'])
            ->make(true);  
        return [];
    }

    public function saveexpensetype(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'expensetype'   => 'required',
            'status'        => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $expensetype    = $request->expensetype;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'expensetype'   => $expensetype,
            'status'        => $status,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM expensetype WHERE expensetype = '".$expensetype."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('expensetype')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('expensetype')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editexpensetype(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM expensetype WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deleteexpensetype(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM expensetype WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function customercategoryDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM customercategory ORDER BY customercategory ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('customercategory', function($d) {
                return $d->customercategory;
            })
            ->editColumn('status', function($d) {
                $status = "Inactive";
                $statusClr = 0;
                if($d->status==1) 
                {
                    $status = "Active";
                    $statusClr = 1;
                }
                return '<p class="status-'.$statusClr.'">'.$status.'</p>';
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['customercategory', 'status', 'action'])
            ->make(true);   
        return [];
    }

    public function savecustomercategory(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'customercategory'   => 'required',
            'status'        => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $customercategory    = $request->customercategory;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'customercategory'   => $customercategory,
            'status'        => $status,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM customercategory WHERE customercategory = '".$customercategory."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('customercategory')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('customercategory')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editcustomercategory(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM customercategory WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deletecustomercategory(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM customercategory WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function termsDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM terms ORDER BY terms ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('terms', function($d) {
                return $d->terms;
            })
            ->editColumn('status', function($d) {
                $status = "Inactive";
                $statusClr = 0;
                if($d->status==1) 
                {
                    $status = "Active";
                    $statusClr = 1;
                }
                return '<p class="status-'.$statusClr.'">'.$status.'</p>';
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['terms', 'status', 'action'])
            ->make(true);   
        return [];
    }

    public function saveterms(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'terms'     => 'required',
            'status'    => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $terms          = $request->terms;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'terms'         => $terms,
            'status'        => $status,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM terms WHERE terms = '".$terms."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('terms')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('terms')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editterms(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM terms WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deleteterms(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM terms WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function idproofDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM idproof ORDER BY idproof ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('idproof', function($d) {
                return $d->idproof;
            })
            ->editColumn('status', function($d) {
                $status = "Inactive";
                $statusClr = 0;
                if($d->status==1) 
                {
                    $status = "Active";
                    $statusClr = 1;
                }
                return '<p class="status-'.$statusClr.'">'.$status.'</p>';
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['idproof', 'status', 'action'])
            ->make(true);     
        return [];
    }

    public function saveidproof(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'idproof'     => 'required',
            'status'    => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $idproof          = $request->idproof;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'idproof'         => $idproof,
            'status'        => $status,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM idproof WHERE idproof = '".$idproof."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('idproof')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('idproof')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editidproof(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM idproof WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deleteidproof(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM idproof WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function taxtypeDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM taxtype ORDER BY taxtype ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('taxtype', function($d) {
                return $d->taxtype;
            })
            ->editColumn('status', function($d) {
                $status = "Inactive";
                $statusClr = 0;
                if($d->status==1) 
                {
                    $status = "Active";
                    $statusClr = 1;
                }
                return '<p class="status-'.$statusClr.'">'.$status.'</p>';
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['taxtype', 'status', 'action'])
            ->make(true);   
        return [];
    }

    public function savetaxtype(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'taxtype'     => 'required',
            'status'    => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $taxtype          = $request->taxtype;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'taxtype'         => $taxtype,
            'status'        => $status,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM taxtype WHERE taxtype = '".$taxtype."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('taxtype')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('taxtype')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function edittaxtype(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM taxtype WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deletetaxtype(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM taxtype WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function warehouseDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM warehouse ORDER BY warehouse ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('warehouse', function($d) {
                return $d->warehouse;
            })
            ->editColumn('status', function($d) {
                $status = "Inactive";
                $statusClr = 0;
                if($d->status==1) 
                {
                    $status = "Active";
                    $statusClr = 1;
                }
                return '<p class="status-'.$statusClr.'">'.$status.'</p>';
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['warehouse', 'status', 'action'])
            ->make(true);
        return [];
    }

    public function savewarehouse(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'warehouse'     => 'required',
            'status'    => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $warehouse          = $request->warehouse;
        $status         = $request->status;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'warehouse'         => $warehouse,
            'status'        => $status,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM warehouse WHERE warehouse = '".$warehouse."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('warehouse')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('warehouse')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editwarehouse(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM warehouse WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deletewarehouse(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM warehouse WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function employeeDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT a.id,a.employee_name,a.employee_code,b.name as des_name,b.code as des_code,c.name as dept_name,c.code as dept_code,a.mobile FROM employee a LEFT JOIN employeerole b ON b.id=a.employee_designation LEFT JOIN department c ON c.id=a.department_name LEFT JOIN idproof d ON d.id=a.proof_type ORDER BY a.employee_name ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function($d) {
                return $d->employee_name.'<br><small> '.$d->employee_code.'</small>';
            })
            ->editColumn('department', function($d) {
                return $d->dept_name.'<br><small> '.$d->dept_code.'</small>';
            })
            ->editColumn('designation', function($d) {
                return $d->des_name.'<br><small> '.$d->des_code.'</small>';
            })
            ->editColumn('mobile', function($d) {
                return $d->mobile;
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="'.url('/form-employee/'.$this->ThorEncrypt($d->id).'').'" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['name', 'department','designation', 'mobile', 'action'])
            ->make(true);
        return [];
    }

    public function saveEmployee(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'id'                    => 'required',
            'employee_name'         => 'required',
            'employee_code'         => 'required',
            'employee_designation'  => 'required',
            'department_name'       => 'required',
            'address1'              => 'required',
            'city'                  => 'required',
            'pincode'               => 'required',
            'mobile'                => 'required',
            'proof_type'            => 'required',
            'proof_number'          => 'required',
            'status'                => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code                   = 500;
        $msg                    = "Failed to save data";
        $id                     = $this->ThorDecrypt($request->id);
        $employee_name          = $request->employee_name;
        $employee_code          = $request->employee_code;
        $employee_designation   = $request->employee_designation;
        $department_name        = $request->department_name;
        $address1               = $request->address1;
        $address2               = $request->address2;
        $address3               = $request->address3;
        $city                   = $request->city;
        $pincode                = $request->pincode;
        $mobile                 = $request->mobile;
        $proof_type             = $request->proof_type;
        $proof_number           = $request->proof_number;
        $status                 = $request->status;
        $userid                 = Session::get('login_id');
        $ipaddress              = $request->ip();

        $formData = array(

            'employee_name'         => $employee_name,
            'employee_code'         => $employee_code,
            'employee_designation'  => $employee_designation,
            'department_name'       => $department_name,
            'address1'              => $address1,
            'address2'              => $address2,
            'address3'              => $address3,
            'city'                  => $city,
            'pincode'               => $pincode,
            'mobile'                => $mobile,
            'proof_type'            => $proof_type,
            'proof_number'          => $proof_number,
            'status'                => $status,
            'created'               => $userid,
            'ipaddress'             => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM employee WHERE employee_code = '".$employee_code."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('employee')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('employee')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function getEmployeeOptions(Request $request)
    {
        $department    = DB::select("SELECT id,name,code FROM `department` WHERE status = 1 ORDER BY name ASC");
        $designation   = DB::select("SELECT id,code,name FROM employeerole WHERE status = 1 ORDER BY name ASC");
        $idproof       = DB::select("SELECT id,idproof FROM `idproof` WHERE status = 1 ORDER BY idproof ASC");
        return response()->json(['code' => 200,'department' => $department,'designation' => $designation,'idproof' => $idproof]);
    }

    public function getEmployeeDetails(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data       = DB::select("SELECT * FROM `employee` WHERE id = '".$id."'");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function deleteemployee(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM employee WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function supplierDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM `supplier` ORDER BY supplier_name ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('supplier_name', function($d) {
                return $d->supplier_name;
            })
            ->editColumn('mobile', function($d) {
                return $d->mobile;
            })
            ->editColumn('email', function($d) {
                return $d->email;
            })
            ->editColumn('address', function($d) {
                return $d->address1;
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="'.url('/form-supplier/'.$this->ThorEncrypt($d->id).'').'" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['supplier_name', 'mobile','email', 'address', 'action'])
            ->make(true);
        return [];
    }

    public function savesupplier(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'id'                    => 'required',
            'supplier_name'         => 'required',
            'address1'              => 'required',
            'city'                  => 'required',
            'pincode'               => 'required',
            'mobile'                => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code                   = 500;
        $msg                    = "Failed to save data";
        $id                     = $this->ThorDecrypt($request->id);
        $supplier_name          = $request->supplier_name;
        $address1               = $request->address1;
        $city                   = $request->city;
        $pincode                = $request->pincode;
        $mobile                 = $request->mobile;
        $email                  = $request->email;
        $latitude               = $request->latitude;
        $langtidute             = $request->langtidute;
        $userid                 = Session::get('login_id');
        $ipaddress              = $request->ip();

        $formData = array(

            'supplier_name'         => $supplier_name,
            'address1'              => $address1,
            'city'                  => $city,
            'pincode'               => $pincode,
            'mobile'                => $mobile,
            'email'                 => $email,
            'latitude'              => $latitude,
            'langtidute'            => $langtidute,
            'created'               => $userid,
            'ipaddress'             => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM supplier WHERE supplier_name = '".$supplier_name."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('supplier')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('supplier')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function getsupplierDetails(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data       = DB::select("SELECT * FROM `supplier` WHERE id = '".$id."'");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function deletesupplier(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM supplier WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function customerDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT a.id,a.customer_name,b.customercategory,a.address1,a.mobile,a.email FROM customer a LEFT JOIN customercategory b ON b.id=a.category ORDER BY a.customer_name ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('customer_name', function($d) {
                return $d->customer_name.'<br><small>'.$d->customercategory.'</small>';
            })
            ->editColumn('mobile', function($d) {
                return $d->mobile;
            })
            ->editColumn('email', function($d) {
                return $d->email;
            })
            ->editColumn('address', function($d) {
                return $d->address1;
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="'.url('/form-customer/'.$this->ThorEncrypt($d->id).'').'" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['customer_name', 'mobile','email', 'address', 'action'])
            ->make(true);
        return [];
    }

    public function savecustomer(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'id'                    => 'required',
            'category'              => 'required',
            'customer_name'         => 'required',
            'address1'              => 'required',
            'city'                  => 'required',
            'pincode'               => 'required',
            'mobile'                => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code                   = 500;
        $msg                    = "Failed to save data";
        $id                     = $this->ThorDecrypt($request->id);
        $category               = $request->category;
        $customer_name          = $request->customer_name;
        $address1               = $request->address1;
        $city                   = $request->city;
        $pincode                = $request->pincode;
        $mobile                 = $request->mobile;
        $email                  = $request->email;
        $latitude               = $request->latitude;
        $langtidute             = $request->langtidute;
        $userid                 = Session::get('login_id');
        $ipaddress              = $request->ip();

        $formData = array(

            'category'              => $category,
            'customer_name'         => $customer_name,
            'address1'              => $address1,
            'city'                  => $city,
            'pincode'               => $pincode,
            'mobile'                => $mobile,
            'email'                 => $email,
            'latitude'              => $latitude,
            'langtidute'            => $langtidute,
            'created'               => $userid,
            'ipaddress'             => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM customer WHERE customer_name = '".$customer_name."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('customer')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('customer')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function getCustomerOptions(Request $request)
    {
        $data    = DB::select("SELECT * FROM customercategory ORDER BY customercategory ASC");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function getcustomerDetails(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data       = DB::select("SELECT * FROM `customer` WHERE id = '".$id."'");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function deletecustomer(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM customer WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function taxDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT a.id,a.code,a.description,a.igst,a.sgst,a.cgst,b.taxtype FROM tax a LEFT JOIN taxtype b ON b.id=a.tax_type ORDER BY a.code ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('taxtype', function($d) {
                return $d->taxtype;
            })
            ->editColumn('code', function($d) {
                return $d->code;
            })
            ->editColumn('description', function($d) {
                return $d->description;
            })
            ->editColumn('igst', function($d) {
                return $d->igst;
            })
            ->editColumn('sgst', function($d) {
                return $d->sgst;
            })
            ->editColumn('cgst', function($d) {
                return $d->cgst;
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="'.url('/form-tax/'.$this->ThorEncrypt($d->id).'').'" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['taxtype', 'code','description', 'igst', 'sgst', 'cgst', 'action'])
            ->make(true);
        return [];
    }

    public function savetax(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'id'            => 'required',
            'tax_type'      => 'required',
            'code'          => 'required',
            'description'   => 'required',
            'igst'          => 'required',
            'cgst'          => 'required',
            'sgst'          => 'required',
            'status'        => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code             = 500;
        $msg              = "Failed to save data";
        $id               = $this->ThorDecrypt($request->id);
        $tax_type         = $request->tax_type;
        $code             = $request->code;
        $description      = $request->description;
        $igst             = $request->igst;
        $cgst             = $request->cgst;
        $sgst             = $request->sgst;
        $status           = $request->status;
        $userid           = Session::get('login_id');
        $ipaddress        = $request->ip();

        $formData = array(

            'tax_type'      => $tax_type,
            'code'          => $code,
            'description'   => $description,
            'igst'          => $igst,
            'cgst'          => $cgst,
            'sgst'          => $sgst,
            'status'        => $status,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM tax WHERE code = '".$code."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('tax')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('tax')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function getTaxOptions(Request $request)
    {
        $data    = DB::select("SELECT * FROM taxtype ORDER BY taxtype  ASC");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function getTaxDetails(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data       = DB::select("SELECT * FROM `tax` WHERE id = '".$id."'");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function deletetax(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM tax WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function companyDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT * FROM `company` ORDER BY company_name ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('company_name', function($d) {
                return $d->company_name.'<br><small>'.$d->short_name.'</small>';
            })
            ->editColumn('mobile', function($d) {
                return $d->mobile;
            })
            ->editColumn('email', function($d) {
                return $d->email;
            })
            ->editColumn('address', function($d) {
                return $d->address1;
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="'.url('/form-company/'.$this->ThorEncrypt($d->id).'').'" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['company_name', 'mobile','email', 'address', 'action'])
            ->make(true);
        return [];
    }

    public function savecompany(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'id'                    => 'required',
            'company_name'          => 'required',
            'short_name'            => 'required',
            'address1'              => 'required',
            'city'                  => 'required',
            'pincode'               => 'required',
            'mobile'                => 'required',
            'contact_person'        => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code                   = 500;
        $msg                    = "Failed to save data";
        $id                     = $this->ThorDecrypt($request->id);
        $company_name           = $request->company_name;
        $short_name             = $request->short_name;
        $address1               = $request->address1;
        $city                   = $request->city;
        $pincode                = $request->pincode;
        $mobile                 = $request->mobile;
        $contact_person         = $request->contact_person;
        $email                  = $request->email;
        $latitude               = $request->latitude;
        $langtidute             = $request->langtidute;
        $userid                 = Session::get('login_id');
        $ipaddress              = $request->ip();

        $formData = array(

            'company_name'          => $company_name,
            'short_name'            => $short_name,
            'address1'              => $address1,
            'city'                  => $city,
            'pincode'               => $pincode,
            'mobile'                => $mobile,
            'email'                 => $email,
            'contact_person'        => $contact_person,
            'latitude'              => $latitude,
            'langtidute'            => $langtidute,
            'created'               => $userid,
            'ipaddress'             => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM company WHERE company_name = '".$company_name."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('company')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('company')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function getCompanyDetails(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data       = DB::select("SELECT * FROM `company` WHERE id = '".$id."'");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function deletecompany(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM company WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function branchDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT a.id,a.branch_name,a.short_name,a.address1,a.mobile,a.email,b.company_name,b.short_name as c_short FROM branch a LEFT JOIN company b ON b.id=a.company ORDER BY a.branch_name ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('company_name', function($d) {
                return $d->company_name.'<br><small>'.$d->c_short.'</small>';
            })
            ->editColumn('branch_name', function($d) {
                return $d->branch_name.'<br><small>'.$d->short_name.'</small>';
            })
            ->editColumn('mobile', function($d) {
                return $d->mobile;
            })
            ->editColumn('email', function($d) {
                return $d->email;
            })
            ->editColumn('address', function($d) {
                return $d->address1;
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="'.url('/form-branch/'.$this->ThorEncrypt($d->id).'').'" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['company_name','branch_name', 'mobile','email', 'address', 'action'])
            ->make(true);
        return [];
    }

    public function savebranch(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'id'                    => 'required',
            'company'               => 'required',
            'branch_name'           => 'required',
            'short_name'            => 'required',
            'address1'              => 'required',
            'city'                  => 'required',
            'pincode'               => 'required',
            'mobile'                => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code                   = 500;
        $msg                    = "Failed to save data";
        $id                     = $this->ThorDecrypt($request->id);
        $company                = $request->company;
        $branch_name            = $request->branch_name;
        $short_name             = $request->short_name;
        $address1               = $request->address1;
        $city                   = $request->city;
        $pincode                = $request->pincode;
        $mobile                 = $request->mobile;
        $email                  = $request->email;
        $latitude               = $request->latitude;
        $langtidute             = $request->langtidute;
        $userid                 = Session::get('login_id');
        $ipaddress              = $request->ip();

        $formData = array(

            'company'               => $company,
            'branch_name'           => $branch_name,
            'short_name'            => $short_name,
            'address1'              => $address1,
            'city'                  => $city,
            'pincode'               => $pincode,
            'mobile'                => $mobile,
            'email'                 => $email,
            'latitude'              => $latitude,
            'langtidute'            => $langtidute,
            'created'               => $userid,
            'ipaddress'             => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM branch WHERE branch_name = '".$branch_name."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('branch')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('branch')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function getBranchOptions(Request $request)
    {
        $data    = DB::select("SELECT * FROM company ORDER BY company_name ASC");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function getBranchDetails(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data       = DB::select("SELECT * FROM `branch` WHERE id = '".$id."'");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function deletebranch(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM branch WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function paymenttermsDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
        $data = DB::select("SELECT * FROM paymentterms ORDER BY paymentterms ASC");
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('paymentterms', function($d) {
            return $d->paymentterms;
        })
        ->editColumn('action', function($d) {
            $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
            return $btn;
        })
        ->rawColumns(['paymentterms', 'action'])
        ->make(true);     
        return [];
    }

    public function savepaymentterms(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'paymentterms'  => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $paymentterms   = $request->paymentterms;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'paymentterms'  => $paymentterms,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM paymentterms WHERE paymentterms = '".$paymentterms."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('paymentterms')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('paymentterms')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editpaymentterms(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM paymentterms WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deletepaymentterms(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM paymentterms WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function shippingDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
        $data = DB::select("SELECT * FROM shipping ORDER BY shipping ASC");
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('shipping', function($d) {
            return $d->shipping;
        })
        ->editColumn('action', function($d) {
            $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
            return $btn;
        })
        ->rawColumns(['shipping', 'action'])
        ->make(true);     
        return [];
    }

    public function saveshipping(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'shipping'  => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $shipping   = $request->shipping;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'shipping'  => $shipping,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM shipping WHERE shipping = '".$shipping."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('shipping')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('shipping')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editshipping(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM shipping WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deleteshipping(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM shipping WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function fobDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
        $data = DB::select("SELECT * FROM fob ORDER BY fob ASC");
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('fob', function($d) {
            return $d->fob;
        })
        ->editColumn('action', function($d) {
            $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
            return $btn;
        })
        ->rawColumns(['fob', 'action'])
        ->make(true);     
        return [];
    }

    public function savefob(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'fob'  => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $fob   = $request->fob;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'fob'  => $fob,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM fob WHERE fob = '".$fob."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('fob')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('fob')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editfob(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM fob WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deletefob(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM fob WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function freighttermsDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
        $data = DB::select("SELECT * FROM freightterms ORDER BY freightterms ASC");
        return Datatables::of($data)
        ->addIndexColumn()
        ->editColumn('freightterms', function($d) {
            return $d->freightterms;
        })
        ->editColumn('action', function($d) {
            $btn = '';
            if(Session::get('isapi')=='yes')
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            }
            else
            {
                $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn btn-primary">Edit</a>';

                $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
            }
            return $btn;
        })
        ->rawColumns(['freightterms', 'action'])
        ->make(true);     
        return [];
    }

    public function savefreightterms(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'freightterms'  => 'required',

        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code           = 500;
        $msg            = "Failed to save data";
        $id             = $this->ThorDecrypt($request->id);
        $freightterms   = $request->freightterms;
        $userid         = Session::get('login_id');
        $ipaddress      = $request->ip();

        $formData = array(

            'freightterms'  => $freightterms,
            'created'       => $userid,
            'ipaddress'     => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM freightterms WHERE freightterms = '".$freightterms."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('freightterms')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('freightterms')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function editfreightterms(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::select("SELECT * FROM freightterms WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Success','data' => $data]);
    }

    public function deletefreightterms(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM freightterms WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }

    public function itemDatalist(Request $request)
    {
        if(in_array('api',$request->route()->getAction('middleware')))
        {
            Session::put('isapi','yes');
        }
            $data = DB::select("SELECT a.id,a.itemcode,a.description,a.unit_price,a.selling_price,b.uom as uomName FROM item a LEFT JOIN uom b ON b.id=a.uom ORDER BY a.itemcode ASC");
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('itemcode', function($d) {
                return $d->itemcode;
            })
            ->editColumn('description', function($d) {
                return $d->description;
            })
            ->editColumn('uom', function($d) {
                return $d->uomName;
            })
            ->editColumn('unit_price', function($d) {
                return $d->unit_price;
            })
            ->editColumn('selling_price', function($d) {
                return $d->selling_price;
            })
            ->editColumn('action', function($d) {
                $btn = '';
                if(Session::get('isapi')=='yes')
                {
                    $btn .= '<a href="javascript:void(0)" onclick="editData(\''.$this->ThorEncrypt($d->id).'\')" class="btn4" style="font-size: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')" class="btn3" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                }
                else
                {
                    $btn .= '<a href="'.url('/form-item/'.$this->ThorEncrypt($d->id).'').'" class="btn btn-primary">Edit</a>';

                    $btn .= '&emsp;<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteData(\''.$this->ThorEncrypt($d->id).'\')">Delete</a>';
                }
                return $btn;
            })
            ->rawColumns(['itemcode', 'description','uom', 'unit_price','selling_price', 'action'])
            ->make(true);
        return [];
    }

    public function saveitem(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'id'                => 'required',
            'itemcode'          => 'required',
            'description'       => 'required',
            'uom'               => 'required',
            'is_tax'            => 'required',
            'tax_code'          => 'required',
            'unit_price'        => 'required',
            'selling_price'     => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }

        $code                   = 500;
        $msg                    = "Failed to save data";
        $id                     = $this->ThorDecrypt($request->id);
        $itemcode               = $request->itemcode;
        $description            = $request->description;
        $uom                    = $request->uom;
        $is_tax                 = $request->is_tax;
        $tax_code               = $request->tax_code;
        $unit_price             = $request->unit_price;
        $selling_price          = $request->selling_price;
        $userid                 = Session::get('login_id');
        $ipaddress              = $request->ip();

        $formData = array(

            'itemcode'        => $itemcode,
            'description'     => $description,
            'uom'             => $uom,
            'is_tax'          => $is_tax,
            'tax_code'        => $tax_code,
            'unit_price'      => $unit_price,
            'selling_price'   => $selling_price,
            'created'         => $userid,
            'ipaddress'       => $ipaddress,
        );

        $condition = "";
        if($id>0) $condition = " AND id !=".$id."";

        $data = DB::select("SELECT COUNT(id) as total FROM item WHERE itemcode = '".$itemcode."' ".$condition."");
        if($data[0]->total==0)
        {
            if($id>0)
            {
                unset($formData['created']);
                $formData['modified'] = $userid;

                $result     = DB::table('item')->where('id','=',$id)->update($formData);
                $code       = 201;
                $msg        = "Data Updated";
            }
            else
            {
                $result     = DB::table('item')->insertGetId($formData);
                $code       = 200;
                $msg        = "Data Saved";
            }
        }
        else
        {
            $code = 202;
            $msg  = "Data Already Exist";
        }
        return response()->json(['code' => $code,'message' => $msg]);
    }

    public function getitemOptions(Request $request)
    {
        $uom    = DB::select("SELECT id,uom FROM `uom` WHERE status = 1 ORDER BY uom ASC");
        $tax   = DB::select("SELECT id,code FROM tax WHERE status = 1 ORDER BY code ASC");
        return response()->json(['code' => 200,'uom' => $uom,'tax' => $tax]);
    }

    public function getitemDetails(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data       = DB::select("SELECT * FROM `item` WHERE id = '".$id."'");
        return response()->json(['code' => 200,'data' => $data]);
    }

    public function deleteitem(Request $request)
    {
        $code           = 500;
        $msg            = "Failed to save data";
        $validator = Validator::make($request->all(),[
            'ref'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['code' => 400,'message' => 'Invalid input']);
        }
        $id = $this->ThorDecrypt($request->ref);
        $data = DB::delete("DELETE FROM item WHERE id = '".$id."'");
        return response()->json(['code' => 200,'message' => 'Data Deleted']);
    }
}
