<ul class="list-group notification-list">
   
    @foreach ($modulehaspermission as $m)
        {{-- dd($modulehaspermission) --}}
        <div class="card">

            
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#accor{{ $loop->index+1 }}" aria-expanded="false">{{ $m['module']->name }}</a>
                        <div class="status-toggle">
                            <input type="checkbox" id="staff_module" class="check">
                            <label for="staff_module" class="checktoggle">checkbox</label>
                        </div>
                    </h6>
                </div>
            <div id="accor{{ $loop->index+1 }}" class="card-collapse collapse" style="">
                <form class ='permissionForm'>
                    @php
                        $per = App\ModulesHasPermissions::with(['module','permission'])->where('module_id', $m->module_id)->get('permission_id');
                         //dd($per);
                    @endphp

                    <div class="card-body" style="vertical-align:middle;">


                        @foreach ($per as $p)
                            <input type="checkbox" name="permission[]" class="perCheckbox" value="{{ $p['permission']->name }} " onclick="CheckPermission(this.value)"
                                   @foreach($rolehaspermission as $r)
                                                                      @if ($r->permission_id == $p['permission']->id)
                                                                      checked
                                                                      @endif
                                   @endforeach
                                   style="margin-right:2px;"><label for="{{ $p['permission']->name }}" class="mr-2">{{ $p['permission']->name }}</label>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
        
    @endforeach
</ul>
