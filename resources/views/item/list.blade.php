@extends('template.header') 
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Item</h4>
      <div class="page-header-actions">
         <a href="{{url('/form-item/0')}}" class="btn btn-primary">Add New</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <table class="table table-hover" width="100%" id="item_table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Item Code</th>
                     <th>Description</th>
                     <th>UOM</th>
                     <th>Unit Price</th>
                     <th>Selling Price</th>
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
   
      itemDatalist();
   
   });
   
   function itemDatalist() {
      $('#item_table').DataTable({
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
               "width": "10%",
               "targets": 3
            },
            {
               "width": "15%",
               "targets": 4
            },
            {
               "width": "15%",
               "targets": 5
            },
            {
               "width": "25%",
               "targets": 6
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
            url: "{{ route('itemDatalist') }}",
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
               data: 'itemcode',
               name: 'itemcode'
            },
            {
               data: 'description',
               name: 'description'
            },
            {
               data: 'uom',
               name: 'uom'
            },
            {
               data: 'unit_price',
               name: 'unit_price'
            },
            {
               data: 'selling_price',
               name: 'selling_price'
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
         text: "this item",
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
               url: "{{route('delete-item')}}",
               data: {
                  "ref": ref,
                  '_token': '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Item Deleted Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        itemDatalist();
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