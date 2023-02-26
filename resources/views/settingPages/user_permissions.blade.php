@extends('layouts.app')

{{-- All the content needs to put in head tag --}}
@section('head-tag')
    <title>ERP |User Permission</title>
    <style>
        .card {
            border: 0;
            box-shadow: 0px;
            margin-bottom: 10px;
        }
        .card-title{
            font-size:18px;
        }
        .makeList{height:290px;}
        .makeList{overflow:hidden; overflow-y:scroll;}
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: green;
            border-color: darken(green, 10%);
        }
    </style>
@endsection


{{-- Main page content strarts here --}}
@section('content')

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">User & Permissions</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="myInput">
                            <label class="focus-label">Search User</label>
                        </div>
                        <div class="roles-menu" id="myList">
                            {{--<ul style="margin-top:-10px" id="myList" class="makeList">
                                @isset($admins)
                                    @foreach($admins as $roles)
                                        <li id="role{{ $roles->id }}">
                                            <a href="javascript:void(0);" onclick="showUserPermission({{ $roles->id }})">{{ $roles->name }} {{ '['.$roles->emp_id.']' }}
                                                <span class="role-action"></span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endisset
                            </ul>--}}
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9" id="userPage">
                        {{--                        @include('settingPages.getUserPermissions');--}}
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
{{-- Main page content ends here --}}


{{-- All the content need to be put in footer ( Scripts ) --}}

<!-- Custom JS -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>--}}
@section('custom-script')
    <script>
        function CheckPermission(val,thisone) {
            $d = $(thisone).attr('dataiid');
            $('.perm_'+$d).html('Updating <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $('.perm_'+$d).prop('disabled', true);
            $.ajax({
                url : "{{ route('update-user-permission') }}",
                type : 'POST',
                data : $(".updatePermissionsForm").serialize(),
                success : function(respo){
                    if(respo.type == 'success'){
                        $('.perm_'+$d).html('Update Permissions');
                        $('.perm_'+$d).prop('disabled', false);
                        toastr["success"]("User Permission Updated Successfully");
                    }else{
                        alert(respo.msg);
                        $('.perm_'+$d).html('Update Permissions');
                        $('.perm_'+$d).prop('disabled', false);
                    }
                },
                error : function(){
                    alert('Oops! Something went wrong. Try again.');
                    $('.perm_'+$d).html('Update Permissions');
                    $('.perm_'+$d).prop('disabled', false);

                },
            });
            return false;
        };
        $('li').on('click', function(){
            var id = $(this).attr('id');
            var element = $('#'+id);
            $('li').removeClass('active');
            element.addClass('active');
        });

        function showUserPermission(id) {
            $.ajax({
                url: "get-user-permission",
                type:'GET',
                data : {
                    id : id,
                },
                success: function(data) {
                    $('#userPage').html(data);
                }
            });
        }

        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val();
                if(value.length>0 && $.isNumeric(value))
                {
                    $.get('search-user/'+value, function (employee) {
                    if(employee.type= 'success')
                    {
                        html = "";
                        html += '<ul  style="margin-top:-10px" id="myList" class="makeList">';
                        $.each(employee.data, function( index, value ) {
                            html += `<li class="my-2 text-capitalize" style="cursor:pointer">

                            <a href="javascript:void(0);" onclick="showUserPermission(${value.id})">${value.name} ${value.emp_last_name}[${value.emp_id}]
                                                <span class="role-action"></span>
                                            </a>
                            </li>`;
                        });
                        html += '</ul>';
                         $('#myList').empty('').append(html);
                         $('#userPage').slideDown(500);
                        }
                        else
                        {
                          $('#myList').empty('');
                        }
              
                      }); 
                        }else
                            {
                             $('#myList').empty('');
                             $('#userPage').slideUp(500);
                            }
                  });
             });



      function checkAll(id,val,thisone) {
          $d = $('#staff_module_'+id).attr('dataid');
          $('.d_'+id).prop('checked', $(thisone).prop('checked'));
        };
    </script>
@endsection

