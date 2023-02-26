@extends('layouts.app')

{{-- All the content needs to put in head tag --}}
@section('head-tag')
    <title>ERP | Dashboard</title>
	<style>
		.card {
    border: 0;
    box-shadow: 0px;
    margin-bottom: 10px;
}
.card-title{
	font-size:18px;
}
	</style>
@endsection


{{-- Main page content strarts here --}}
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">

			<!-- Page Content -->
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Roles & Permissions</h3>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
						<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>
						<div class="roles-menu" id="roleMenu">
							<ul>
								@foreach ($role as $r)
									<li id="role{{ $r->id }}" data-role="{{ $r->name }}" class="@if($r->name == 'Admin') active @endif" data_id="{{ $r->id }}">
										<a href="javascript:void(0);"  onclick="Mrole({{ $r->id }});">{{ $r->name }}
											{{--<span class="role-action">
												<span class="action-circle large" data-toggle="modal" data-target="#edit_role">
													<i class="material-icons">edit</i>
												</span>
												<span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_role">
													<i class="material-icons">delete</i>
												</span>
											</span>--}}
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
						<h6 class="card-title m-b-20">Module Access</h6>
						<div class="m-b-30" id="modulePage">
{{--						@include('settingPages.getModule    ');--}}
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->

			<!-- Add Role Modal -->
			<div id="add_role" class="modal custom-modal fade @error('role') show @enderror" role="dialog" style="@error('role') display:block @enderror">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Role</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('add-role') }}" method="POST">
								@csrf
								<div class="form-group">
									<label>Role Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="role">
									@error("role")
									<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="submit-section">
									<button type="submit" class="btn btn-primary submit-btn">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Role Modal -->

			<!-- Edit Role Modal -->
			<div id="edit_role" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h5 class="modal-title">Edit Role</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label>Role Name <span class="text-danger">*</span></label>
									<input class="form-control" value="Team Leader" type="text">
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Edit Role Modal -->

			<!-- Delete Role Modal -->
			<div class="modal custom-modal fade" id="delete_role" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Role</h3>
								<p>Are you sure want to delete?</p>
							</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
									</div>
									<div class="col-6">
										<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Role Modal -->

 </div>
		<!-- /Page Wrapper -->

@endsection
{{-- Main page content ends here --}}


{{-- All the content need to be put in footer ( Scripts ) --}}
@section('custom-script')
<script>
	$(function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

		$('li').on('click', function(){
			var id = $(this).attr('id');
			var element = $('#'+id);
			// alert(id);
			$('li').removeClass('active');
    		element.addClass('active');
		});
    });
		// $("input[name='permission[]']").bind('click',
            function CheckPermission(val) {
                // alert();
                if ($('.roles-menu li').hasClass("active")) {
                    var id = $('.roles-menu .active').attr('id');
                    var element = $('#' + id);
                    // alert($('.roles-menu li').attr('class'));
                    var role = element.attr('data-role');
                    // alert(role);
                    // var thisEle = $(this);
                    // var val = '';
                    // if (thisEle.is(':checked')) {
                    //     val = thisEle.val();
                    // }
                    $.ajax({
                        url: "{{ route('assign-role-permission') }}",
                        type: 'POST',
                        data: {
                            role: role,
                            permission: val
                        },
                        success: function (res) {
                            toastr["success"]("Permission assigned Successfully");
                        }
                    });
                } else {
                    toastr["error"]("Please Choose The Role")
                    $(this).prop("checked", false);
                }
                // });
            }


	function Mrole(id) {
$.ajax({
            url:"get-Module",
            type:'GET',
            data : {
              id : id,
            },
            success: function(data) {
                $('#modulePage').html(data);
            }
        });
    }
</script>
@endsection
