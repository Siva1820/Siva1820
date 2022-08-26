@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Employee Details</h4>
      <div class="page-header-actions">
         <a href="{{url('/employee')}}" class="btn btn-primary">All Employees</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <form name="employee_form" id="employee_form" novalidate="true" autocomplete="off">
               <input type="hidden" name="id" id="id" value="{{request()->id}}">
               <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text" name="employee_name" id="employee_name" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Employee Code</label>
                        <input type="text" name="employee_code" id="employee_code" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Employee Designation</label>
                        <select name="employee_designation" id="employee_designation" class="form-control" required>
                           <option value="">Select</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Department Name</label>
                        <select name="department_name" id="department_name" class="form-control" required>
                           <option value="">Select</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Address 1</label>
                        <textarea name="address1" id="address1" class="form-control" required></textarea>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Address 2</label>
                        <textarea name="address2" id="address2" class="form-control"></textarea>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Address 3</label>
                        <textarea name="address3" id="address3" class="form-control"></textarea>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Pincode</label>
                        <input type="number" name="pincode" id="pincode" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="number" name="mobile" id="mobile" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Proof Type</label>
                        <select name="proof_type" id="proof_type" class="form-control" required>
                           <option value="">Select</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Proof Number</label>
                        <input type="text" name="proof_number" id="proof_number" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" required>
                           <option value="1">Active</option>
                           <option value="0">InActive</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <a href="{{url('/employee')}}" class="btn btn-danger">Cancel</a>
                  </div>
                  <div class="col-6" align="right">
                     <a href="javascript:void(0)" class="btn btn-primary" onclick="save_employee_data()">Save</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">

   $(document).ready(function () {
      getEmployeeOptions();
   });
   
   let request       = 0;

   function save_employee_data() {
      if (is_form_valid('employee_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#employee_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
   
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-employee')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Employee Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/employee')}}";
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Employee Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/employee')}}";
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Employee Already Available",
                        type: "warning",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {});
                  } else {
                     swal({
                        title: "Process failed",
                        text: "",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {});
                  }
                  request = 0;
               }
            });
         }
      } else {
         swal({
            title: "Please Enter",
            text: "Valid Details",
            type: "warning",
            showCancelButton: false,
            confirmButtonClass: "btn-success",
            confirmButtonText: "OK",
            closeOnConfirm: true
         }, function () {
   
         });
      }
   }

   function getEmployeeOptions()
   {
      var id = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-employee-options')}}",
         data: {'_token' : '{{ csrf_token() }}','id' : id},
         dataType: 'json',
         success: function (msg) 
         {
            var department_option   = '<option value="">Select</option>';
            var designation_option  = '<option value="">Select</option>';
            var idproof_option      = '<option value="">Select</option>';

            for (var i = 0; i < msg.department.length; i++) 
            {
               var value1 = msg.department[i];
               department_option   += '<option value="'+value1.id+'">'+value1.code+' - '+value1.name+'</option>';
            }

            for (var j = 0; j < msg.designation.length; j++) 
            {
               var value2 = msg.designation[j];
               designation_option   += '<option value="'+value2.id+'">'+value2.code+' - '+value2.name+'</option>';
            }

            for (var k = 0; k < msg.idproof.length; k++) 
            {
               var value3 = msg.idproof[k];
               idproof_option   += '<option value="'+value3.id+'">'+value3.idproof+'</option>';
            }

            $("#employee_designation").html(designation_option);
            $("#department_name").html(department_option);
            $("#proof_type").html(idproof_option);
            getEmployeeDetails();
         }
      });
   }

   function getEmployeeDetails()
   {
      var ref = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-employee-details')}}",
         data: {'_token' : '{{ csrf_token() }}','ref' : ref},
         dataType: 'json',
         success: function (msg) 
         {
            if(msg.code==200)
            {
               if(msg.data.length>0)
               {
                  var value = msg.data[0];

                  $("#employee_name").val(value.employee_name);
                  $("#employee_code").val(value.employee_code);
                  $("#address1").val(value.address1);
                  $("#address2").val(value.address2);
                  $("#address3").val(value.address3);
                  $("#city").val(value.city);
                  $("#pincode").val(value.pincode);
                  $("#mobile").val(value.mobile);
                  $("#proof_number").val(value.proof_number);
                  $("#status").val(value.status);
                  $("#department_name").val(value.department_name);
                  $("#employee_designation").val(value.employee_designation);
                  $("#proof_type").val(value.proof_type);
               }
            }
         }
      });
   }
</script>
@endpush