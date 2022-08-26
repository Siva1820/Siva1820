@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Freight Term</h4>
      <div class="page-header-actions">
         <a href="javascript:void(0)" class="btn btn-primary" onclick="poppupAction('freighttermsModal','show')">Add New</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <table class="table table-hover" width="100%" id="freightterms_table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Freight Term</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="modal fade" id="freighttermsModal" tabindex="-1" role="dialog" aria-labelledby="freighttermsModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content" style="width: 400px !important;">
            <div class="modal-header">
               <h5 class="modal-title" id="freighttermsModalTitle">Freight Term Details</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form name="freightterms_form" id="freightterms_form" novalidate="true" autocomplete="off">
                  <input type="hidden" name="id" id="id" value="">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Freight Term</label>
                           <textarea type="text" name="freightterms" id="freightterms" class="form-control" required></textarea>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button href="javascript:void(0)" class="btn btn-default" data-dismiss="modal">Close</button>
               <a href="javascript:void(0)" class="btn btn-primary" onclick="save_freightterms_details()">Save</a>
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
      $("#freightterms").val("");
   }
   $(document).ready(function () {
   
      freighttermsDatalist();
   
   });
   
   function freighttermsDatalist() {
      clearAllFields();
      $('#freightterms_table').DataTable({
         "columnDefs": [
   
            {
               "width": "10%",
               "targets": 0
            },
            {
               "width": "65%",
               "targets": 1
            },
            {
               "width": "25%",
               "targets": 2
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
            url: "{{ route('freighttermsDatalist') }}",
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
               data: 'freightterms',
               name: 'freightterms'
            },
            {
               data: 'action',
               name: 'action'
            },
         ]
      });
   }
   let request = 0;
   
   function save_freightterms_details() {
      if (is_form_valid('freightterms_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#freightterms_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
   
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-freightterms')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Freight Term Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        poppupAction('freighttermsModal', 'hide');
                        freighttermsDatalist();
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Freight Term Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        poppupAction('freighttermsModal', 'hide');
                        freighttermsDatalist();
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Freight Term Already Available",
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
         url: "{{route('edit-freightterms')}}",
         data: {
            "ref": ref,
            '_token': '{{csrf_token()}}'
         },
         dataType: 'json',
         success: function (msg) {
            if (msg.code == 200) {
               $("#freightterms").val(msg.data[0]['freightterms']);
               $("#description").val(msg.data[0]['description']);
               $("#status").val(msg.data[0]['status']);
               poppupAction('freighttermsModal', 'show');
            }
         }
      });
   }
   
   function deleteData(ref) {
      swal({
   
         title: "Do you want to delete",
         text: "this Freight Term",
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
               url: "{{route('delete-freightterms')}}",
               data: {
                  "ref": ref,
                  '_token': '{{csrf_token()}}'
               },
               dataType: 'json',
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Freight Term Deleted Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        freighttermsDatalist();
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