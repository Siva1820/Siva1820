@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Item Category</h4>
      <div class="page-header-actions">
         <a href="javascript:void(0)" class="btn btn-primary" onclick="poppupAction('itemcategoryModal','show')">Add New</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <table class="table table-hover" width="100%" id="itemcategory_table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Item Category</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="modal fade" id="itemcategoryModal" tabindex="-1" role="dialog" aria-labelledby="itemcategoryModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content" style="width: 400px !important;">
            <div class="modal-header">
               <h5 class="modal-title" id="itemcategoryModalTitle">Item Category Details</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form name="itemcategory_form" id="itemcategory_form" novalidate="true" autocomplete="off">
                  <input type="hidden" name="id" id="id" value="">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Item Category</label>
                           <input type="text" name="itemcategory" id="itemcategory" class="form-control" value="" required>
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
               <a href="javascript:void(0)" class="btn btn-primary" onclick="save_itemcategory_details()">Save</a>
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
      $("#itemcategory").val("");
      $("#status").val(1);
   }
   $(document).ready(function () {
   
      itemcategoryDatalist();
   
   });
   
   function itemcategoryDatalist() {
      clearAllFields();
      $('#itemcategory_table').DataTable({
         "columnDefs": [
   
            {
               "width": "5%",
               "targets": 0
            },
            {
               "width": "60%",
               "targets": 1
            },
            {
               "width": "15%",
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
            url: "{{ route('itemcategoryDatalist') }}",
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
               data: 'itemcategory',
               name: 'itemcategory'
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
   
   function save_itemcategory_details() {
      if (is_form_valid('itemcategory_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#itemcategory_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
   
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-itemcategory')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Item Category Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        poppupAction('itemcategoryModal', 'hide');
                        itemcategoryDatalist();
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Item Category Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        poppupAction('itemcategoryModal', 'hide');
                        itemcategoryDatalist();
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Item Category Already Available",
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
         url: "{{route('edit-itemcategory')}}",
         data: {
            "ref": ref,
            '_token': '{{csrf_token()}}'
         },
         dataType: 'json',
         success: function (msg) {
            if (msg.code == 200) {
               $("#itemcategory").val(msg.data[0]['itemcategory']);
               $("#status").val(msg.data[0]['status']);
               poppupAction('itemcategoryModal', 'show');
            }
         }
      });
   }
   
   function deleteData(ref) {
      swal({
   
         title: "Do you want to delete",
         text: "this Item Category",
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
               url: "{{route('delete-itemcategory')}}",
               data: {
                  "ref": ref,
                  '_token': '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Item Category Deleted Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        itemcategoryDatalist();
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