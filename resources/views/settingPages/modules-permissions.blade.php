
@extends('backend.layout.backmaster')


{{-- All the content needs to put in head tag --}}
@section('head-tag')
    <title> Anadiya Travels| Module and Permissions</title>
    <style>
        body{
            font-size:14px;
        }
        .vl {
            border-left: 2px dashed #dedede;
            height: 391px;
            position: absolute;
            margin: 0% 50%;
        }
    </style>
@endsection
@section('section')

             <div class="content container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="page-title">Permission Setting</h6>
                            @if (session()->has('success'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        <button type="button" class="close text-success" data-dismiss="alert">x</button>
                                        {{ session()->get('success') }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if (session()->has('error'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <button type="button" class="close text-danger" data-dismiss="alert">x</button>
                                        {{ session()->get('error') }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-6">
                        <form action="@if(isset($update)) {{ route('admin.edit_module.edit' , $update->id) }} @else {{ route('admin.add-module.store') }} @endif" method='POST'>
                            {{-- @method('PATCH') --}}
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Module Name <span class="text-danger">*</span></label>
                                        <input class="form-control  @error('module') is-invalid @enderror" type="text" name="module" placeholder="Enter the module name" value="@if(isset($update)){{ $update->name }}@endif">
                                        @error('module')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                <button type="submit" class="btn btn-primary" style="margin-top: 7px;">@if(isset($update)) Update @else Module Save @endif</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table w-100 datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Sr. no</th>
                                        <th>Modules</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($module as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit_module.edit' , $item->id) }}"><button class="btn btn-sm btn-icon on-default m-r-5 button-edit btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></button></a>
                                            <a onclick="return confirm('Are you sure?')" href="{{ route('admin.delete_module', $item->id) }}"><button type="button" class="btn btn-sm btn-icon on-editing button-discard btn-primary delete-module" data-id="{{ $item->id }}" title="Delete"><i class="fa fa-times"></i></button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="vl"></div>
                    <div class="col-6">
                        <form action="@if(isset($updatePermission)) {{ route('admin.update_permission' , $updatePermission->id) }} @else {{ route('admin.add-permission') }} @endif" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Permission Name <span class="text-danger">*</span></label>
                                        <input class="form-control @error('permission') is-invalid @enderror" type="text" placeholder="Enter the permissions name" name="permission" value="@if(isset($updatePermission)){{ $updatePermission->name }}@endif">
                                        @error('permission')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                <button type="submit" class="btn btn-primary" style="margin-top: 7px;">@if(isset($updatePermission)) Update @else Permission Save @endif</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive ">
                            <table class="table w-100 datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Sr. no</th>
                                        <th>Modules</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permission as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('update_permission', $item->id) }}"><button class="btn btn-sm btn-icon on-default m-r-5 button-edit btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></button></a>
                                            <a onclick="return confirm('Are you sure?')" href="{{ route('delete_permission', $item->id) }}"><button type="button" class="btn btn-sm btn-icon on-editing button-discard btn-primary" title="Delete"><i class="fa fa-times"></i></button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="page-title">Assign Permissions to Modules</h6>
                        </div>
                    </div>
                </div>
                <form action="@if(isset($updateMP)) {{ route('admin.update_module_has_permission' , $updateMP->id) }} @else {{ route('admin.assign-module-permission') }} @endif" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Select Module <span class="text-danger">*</span></label>
                                    {{-- <input class="form-control @error('permission') is-invalid @enderror" type="text" placeholder="Enter the permissions name" name="permission"> --}}
                                    <select name="module_id" id="" class="form-control @error('module_id') is-invalid @enderror">
                                        <option value="">Select Module</option>
                                        @foreach ($module as $row)
                                            <option @if(isset($updateMP) && ($updateMP['module']->name == $row->name )) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('module_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Select Permissions<span class="text-danger">*</span></label>
                                    {{-- <input class="form-control @error('permission') is-invalid @enderror" type="text" placeholder="Enter the permissions name" name="permission"> --}}
                                    <select name="permission_id" id="" class="form-control @error('permission_id') is-invalid @enderror">
                                        <option value="">Select Permission</option>
                                        @foreach ($permission as $row)
                                            <option @if(isset($updateMP) && ($updateMP['permission']->name == $row->name)) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('permission_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 mt-4">
                                <button type="submit" class="btn btn-primary" style="margin-top: 7px;">@if(isset($updateMP)) Update @else Save @endif</button>
                            </div>
                        </div>
                </form>

                <div class="table-responsive">
                    <table class="table w-100 datatable">
                        <thead class="bg-primary">
                            <tr>
                                <th>Sr. no</th>
                                <th>Modules</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($modulehaspermission) }} --}}
                            @foreach ($modulehaspermission as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item['module']->name }}</td>
                                <td>{{ $item['permission']->name }}</td>
                                <td>
                                    <a href="{{ route('update_module_has_permission', $item->id) }}"><button class="btn btn-sm btn-icon on-default m-r-5 button-edit btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></button></a>
                                    <a onclick="return confirm('Are you sure?')" href="{{ route('delete_module_permission', $item->id) }}"><button type="button" class="btn btn-sm btn-icon on-editing button-discard btn-primary" title="Delete"><i class="fa fa-times"></i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="page-title">Permissions according to modules</h6>
                        </div>
                    </div>
                </div>
                <form action="@if(isset($updateMP)) {{ route('admin.update_module_has_permission' , $updateMP->id) }} @else {{ route('admin.assign-module-permission') }} @endif" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Select Module <span class="text-danger">*</span></label>
                                    {{-- <input class="form-control @error('permission') is-invalid @enderror" type="text" placeholder="Enter the permissions name" name="permission"> --}}
                                    <select name="module_id" id="select_module" class="form-control @error('module_id') is-invalid @enderror">
                                        <option value="">Select Module</option>
                                        @foreach ($module as $row)
                                            <option @if(isset($updateMP) && ($updateMP['module']->name == $row->name )) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('module_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Select Permissions<span class="text-danger">*</span></label>
                                    <select name="obtained_permission" id="obtained_permission" class="form-control @error('permission_id') is-invalid @enderror">
                                        <option value="">Select Permission</option>    
                                    </select>
                                    @error('permission_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <hr>


    </div>
@endsection

{{-- Main page content strarts here --}}
@section('section1')

{{-- Main page content ends here --}}


{{-- All the content need to be put in footer ( Scripts ) --}}
@section('custom-script')
<script>
$(document).on('change','#select_module',function(){
     $('#obtained_permission').empty();
var module_id = $('#select_module').val();

$.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    $.ajax({
      {{--url:"{{route('selectedModule')}}",--}}
      data: "module_id=" + module_id,
      type: "POST",
      success: function(response){
           $.each(response.data,function(index,data){
                                       $('#obtained_permission').append('<option>'+data+'</option>');
                                     })
      },
      error: function(passParams){
           alert('!OOPS Something went wrong');
      }
});

            });

</script>
@endsection
