@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Tax</h4>
      <div class="page-header-actions">
         <a href="{{url('/form-tax/0')}}" class="btn btn-primary">Add New</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <table class="table table-hover" width="100%" id="tax_table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Tax Type</th>
                     <th>Code</th>
                     <th>Description</th>
                     <th>IGST</th>
                     <th>SGST</th>
                     <th>CGST</th>
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
   
      taxDatalist();
   
   });
   
   function taxDatalist() {
      $('#tax_table').DataTable({
         "columnDefs": [
   
            {
               "width": "5%",
               "targets": 0
            },
            {
               "width": "15%",
               "targets": 1
            },
            {
               "width": "15%",
               "targets": 2
            },
            {
               "width": "15%",
               "targets": 3
            },
            {
               "width": "10%",
               "targets": 4
            },
            {
               "width": "10%",
               "targets": 5
            },
            {
               "width": "10%",
               "targets": 6
            },
            {
               "width": "20%",
               "targets": 7
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
            url: "{{ route('taxDatalist') }}",
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
               data: 'taxtype',
               name: 'taxtype'
            },
            {
               data: 'code',
               name: 'code'
            },{
               data: 'description',
               name: 'description'
            },
            {
               data: 'igst',
               name: 'igst'
            },
            {
               data: 'sgst',
               name: 'sgst'
            },
            {
               data: 'cgst',
               name: 'cgst'
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
         text: "this Tax",
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
               url: "{{route('delete-tax')}}",
               data: {
                  "ref": ref,
                  '_token': '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Tax Deleted Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        taxDatalist();
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