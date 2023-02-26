<ul class="list-group notification-list">

    @foreach ($modulehaspermission as $m)
        {{-- dd($modulehaspermission) --}}
        <div class="card">

           
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#accor{{ $loop->index+1 }}" aria-expanded="false">{{ $m['module']->name }}</a>
                        <div class="status-toggle">
                            <input type="checkbox" id="staff_module_{{  $m['module']->id }}" class="check" onclick="checkAll({{  $m['module']->id }}, this.val,this)">
                            <label for="staff_module_{{  $m['module']->id }}" class="checktoggle">checkbox</label>
                        </div>
                    </h6>
                </div>
           
            <div id="accor{{ $loop->index+1 }}" class="card-collapse collapse" style="">
                <form class ='updatePermissionsForm'>
                    @csrf
                    @php
                        $per = App\ModulesHasPermissions::with(['module','permission'])->where('module_id', $m->module_id)->get('permission_id');
                         //dd($per);
                    @endphp

                    <div class="card-body" style="vertical-align:middle;">


                        @foreach ($per as $p)
                            @foreach ($admins as $roles)
                                <input type="hidden" name="id" value="{{$roles->id}}">
                            @endforeach
                           <div class="col-md-4 float-left">
                               <input data-ckd="rubber" class="d_{{  $m['module']->id }}" type="checkbox" name="permissions[]" value="{{ $p['permission']->name }} "
                                      @foreach($rolehaspermission as $r)
                                      @if ($r->permission_id == $p['permission']->id)
                                      checked
                                      @endif
                                      @endforeach
                                      style="margin-right:2px;"><label for="{{ $p['permission']->name }}" class="bigcheck mr-2">{{ $p['permission']->name }}</label>
                           </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-primary updatePermissions float-right perm_{{  $m['module']->id }}" onclick="CheckPermission(this.value, this)" dataiid="{{  $m['module']->id }}" style="margin:10px">Update Permissions</button>
                </form>
            </div>
        </div>
       
    @endforeach
</ul>
