@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Tax Type</h4>
      <div class="page-header-actions">
         <a href="javascript:void(0)" class="btn btn-primary" onclick="poppupAction('taxtypeModal','show')">Add New</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <table class="table table-hover" width="100%" id="taxtype_table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Tax Type</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="modal fade" id="taxtypeModal" tabindex="-1" role="dialog" aria-labelledby="taxtypeModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content" style="width: 400px !important;">
            <div class="modal-header">
               <h5 class="modal-title" id="taxtypeModalTitle">Tax Type Details</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form name="taxtype_form" id="taxtype_form" novalidate="true" autocomplete="off">
                  <input type="hidden" name="id" id="id" value="">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Tax Type</label>
                           <input type="text" name="taxtype" id="taxtype" class="form-control" value="" required>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Status</label>
                           <select class="form-control" name="status" id="status" required>
                              <option value="1">Active</option>
                              <option value="0">In-Active</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Close</button>
               <a href="javascript:void(0)" class="btn btn-primary" onclick="save_taxtype_details()">Save</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   function poppupAction(modal, action) {
      $("#" + modal).modal(action);
   }
   
   function clearAllFields() {
      $("#id").val("");
      $("#taxtype").val("");
      $("#status").val(1);
   }
   $(document).ready(function () {
   
      taxtypeDatalist();
   
   });
   
   function taxtypeDatalist() {
      clearAllFields();
      $('#taxtype_table').DataTable({
         "columnDefs": [
   
            {
               "width": "5%",
               "targets": 0
            },
            {
               "width": "40%",
               "targets": 1
            },
            {
               "width": "35%",
               "targets": 2
            },
            {
               "width": "20%",
               "targets": 3
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
            url: "{{ route('taxtypeDatalist') }}",
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
               data: 'status',
               name: 'status'
            },
            {
               data: 'action',
               name: 'action'
            },
         ]
      });
   }
   let request = 0;
   
   function save_taxtype_details() {
      if (is_form_valid('taxtype_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#taxtype_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
   
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-taxtype')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Tax Type Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        poppupAction('taxtypeModal', 'hide');
                        taxtypeDatalist();
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Tax Type Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        poppupAction('taxtypeModal', 'hide');
                        taxtypeDatalist();
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Tax Type Already Available",
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
   
   function editData(ref) {
      $("#id").val(ref);
      $.ajax({
         type: "POST",
         url: "{{route('edit-taxtype')}}",
         data: {
            "ref": ref,
            '_token': '{{csrf_token()}}'
         },
         dataType: 'json',
         success: function (msg) {
            if (msg.code == 200) {
               $("#taxtype").val(msg.data[0]['taxtype']);
               $("#status").val(msg.data[0]['status']);
               poppupAction('taxtypeModal', 'show');
            }
         }
      });
   }
   
   function deleteData(ref) {
      swal({
   
         title: "Do you want to delete",
         text: "this Tax Type",
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
               url: "{{route('delete-taxtype')}}",
               data: {
                  "ref": ref,
                  '_token': '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Tax Type Deleted Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        taxtypeDatalist();
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