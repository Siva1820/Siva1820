@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">Tax Details</h4>
      <div class="page-header-actions">
         <a href="{{url('/tax')}}" class="btn btn-primary">All Taxes</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <form name="tax_form" id="tax_form" novalidate="true" autocomplete="off">
               <input type="hidden" name="id" id="id" value="{{request()->id}}">
               <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Tax Type</label>
                        <select name="tax_type" id="tax_type" class="form-control select2" required>
                           <option value="">Select</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Code</label>
                        <input type="text" name="code" id="code" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>IGST</label>
                        <input type="text" name="igst" id="igst" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>SGST</label>
                        <input type="text" name="sgst" id="sgst" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>CGST</label>
                        <input type="text" name="cgst" id="cgst" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" required>
                           <option value="1">Active</option>
                           <option value="0">In-Active</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <a href="{{url('/tax')}}" class="btn btn-danger">Cancel</a>
                  </div>
                  <div class="col-6" align="right">
                     <a href="javascript:void(0)" class="btn btn-primary" onclick="save_tax_data()">Save</a>
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
      gettaxOptions();
   });
   
   let request       = 0;

   function save_tax_data() {
      if (is_form_valid('tax_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#tax_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-tax')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Tax Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/tax')}}";
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Tax Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/tax')}}";
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Tax Already Available",
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

   function gettaxOptions()
   {
      var id = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-tax-options')}}",
         data: {'_token' : '{{ csrf_token() }}','id' : id},
         dataType: 'json',
         success: function (msg) 
         {
            var tax_type   = '<option value="">Select</option>';

            for (var i = 0; i < msg.data.length; i++) 
            {
               var value = msg.data[i];
               tax_type   += '<option value="'+value.id+'">'+value.taxtype+'</option>';
            }
            $("#tax_type").html(tax_type);
            gettaxDetails();
         }
      });
   }

   function gettaxDetails()
   {
      var ref = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-tax-details')}}",
         data: {'_token' : '{{ csrf_token() }}','ref' : ref},
         dataType: 'json',
         success: function (msg) 
         {
            if(msg.code==200)
            {
               if(msg.data.length>0)
               {
                  var value = msg.data[0];
                  $("#tax_type").select2('val',[value.tax_type]);
                  $("#code").val(value.code);
                  $("#description").val(value.description);
                  $("#igst").val(value.igst);
                  $("#sgst").val(value.sgst);
                  $("#cgst").val(value.cgst);
                  $("#status").val(value.status);
               }
            }
         }
      });
   }
</script>
@endpush