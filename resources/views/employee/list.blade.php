@extends('template.header') 
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Employee</h4>
      <div class="page-header-actions">
         <a href="{{url('/form-employee/0')}}" class="btn btn-primary">Add New</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <table class="table table-hover" width="100%" id="employee_table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Employee Name</th>
                     <th>Department</th>
                     <th>Designation</th>
                     <th>Mobile</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">

   $(document).ready(function () {
   
      employeeDatalist();
   
   });
   
   function employeeDatalist() {
      $('#employee_table').DataTable({
         "columnDefs": [
   
            {
               "width": "5%",
               "targets": 0
            },
            {
               "width": "25%",
               "targets": 1
            },
            {
               "width": "20%",
               "targets": 2
            },
            {
               "width": "20%",
               "targets": 3
            },
            {
               "width": "10%",
               "targets": 4
            },
            {
               "width": "20%",
               "targets": 5
            }
         ],
         "language": {
            "processing": 'Please wait',
         },
         "ordering": false,
         "processing": true,
         "serverSide": true,
         "destroy": true,
         ajax: {
            url: "{{ route('employeeDatalist') }}",
            method: 'POST',
            data: {
               '_token': '{{ csrf_token() }}'
            },
         },
         columns: [{
               data: 'DT_RowIndex',
               name: 'DT_RowIndex'
            },
            {
               data: 'name',
               name: 'name'
            },
            {
               data: 'department',
               name: 'department'
            },{
               data: 'designation',
               name: 'designation'
            },
            {
               data: 'mobile',
               name: 'mobile'
            },
            {
               data: 'action',
               name: 'action'
            },
         ]
      });
   }
   function deleteData(ref) {
      swal({
   
         title: "Do you want to delete",
         text: "this Employee",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "danger",
         confirmButtonText: "Yes",
         cancelButtonText: "No",
         closeOnConfirm: false,
         closeOnCancel: true
      }, function (isConfirm) {
   
         if (isConfirm) {
   
            $.ajax({
               type: "POST",
               url: "{{route('delete-employee')}}",
               data: {
                  "ref": ref,
                  '_token': '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Employee Deleted Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        employeeDatalist();
                     });
                  } else {
                     swal({
                        title: "",
                        text: "Failed process",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {});
                  }
               }
            });
         }
      });
   }
</script>
@endpush