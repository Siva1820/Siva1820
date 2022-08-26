@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Supplier</h4>
      <div class="page-header-actions">
         <a href="{{url('/form-supplier/0')}}" class="btn btn-primary">Add New</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <table class="table table-hover" width="100%" id="supplier_table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Supplier Name</th>
                     <th>Mobile</th>
                     <th>Email</th>
                     <th>Address</th>
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
   
      supplierDatalist();
   
   });
   
   function supplierDatalist() {
      $('#supplier_table').DataTable({
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
            url: "{{ route('supplierDatalist') }}",
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
               data: 'supplier_name',
               name: 'supplier_name'
            },
            {
               data: 'mobile',
               name: 'mobile'
            },{
               data: 'email',
               name: 'email'
            },
            {
               data: 'address',
               name: 'address'
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
         text: "this Supplier",
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
               url: "{{route('delete-supplier')}}",
               data: {
                  "ref": ref,
                  '_token': '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Supplier Deleted Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        supplierDatalist();
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