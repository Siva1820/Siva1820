@extends('template.header')
@section('content')
<div class="page">
   <div class="page-header">
      <h4 class="">User Details</h4>
      <div class="page-header-actions">
         <a href="{{url('/item')}}" class="btn btn-primary">All Users</a>
      </div>
   </div>
   <div class="page-content">
      <div class="panel">
         <div class="panel-body container-fluid">
            <form name="item_form" id="item_form" novalidate="true" autocomplete="off">
               <input type="hidden" name="id" id="id" value="{{request()->id}}">
               <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" required value="">
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Company</label>
                        <select name="company" id="company" class="form-control select2" required>
                           <option value="">Select</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">
                     <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control select2" required>
                           <option value="">Active</option>
                           <option value="">Select</option>
                        </select>
                     </div>
                  </div>
                  
               </div>
               <div class="row">
                  <div class="col-6">
                     <a href="{{url('/item')}}" class="btn btn-danger">Cancel</a>
                  </div>
                  <div class="col-6" align="right">
                     <a href="javascript:void(0)" class="btn btn-primary" onclick="save_item_data()">Save</a>
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
      getitemOptions();
   });
   
   let request       = 0;

   function save_item_data() {
      if (is_form_valid('item_form') == 0) {
         var all_value = new FormData();
         var form_data = $('#item_form').serializeArray();
         $.each(form_data, function (key, input) {
            all_value.append(input.name, input.value);
         });
   
         if (request == 0) {
            all_value.append('_token', '{{ csrf_token() }}');
            request++;
            $.ajax({
               type: "POST",
               url: "{{route('save-item')}}",
               data: all_value,
               dataType: 'json',
               processData: false,
               contentType: false,
               success: function (msg) {
                  if (msg.code == 200) {
                     swal({
                        title: "Item Added Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/item')}}";
                     });
                  } else if (msg.code == 201) {
                     swal({
                        title: "Item Updated Successfully",
                        text: "",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "OK",
                        closeOnConfirm: true
                     }, function () {
                        window.location.href="{{url('/item')}}";
                     });
                  } else if (msg.code == 202) {
                     swal({
                        title: "Dublicate Entry",
                        text: "Item Already Available",
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

   function getitemOptions()
   {
      var id = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-item-options')}}",
         data: {'_token' : '{{ csrf_token() }}','id' : id},
         dataType: 'json',
         success: function (msg) 
         {
            var tax_code_option  = '<option value="">Select</option>';
            var uom_option       = '<option value="">Select</option>';

            for (var i = 0; i < msg.tax.length; i++) 
            {
               var value1 = msg.tax[i];
               tax_code_option   += '<option value="'+value1.id+'">'+value1.code+'</option>';
            }

            for (var j = 0; j < msg.uom.length; j++) 
            {
               var value2 = msg.uom[j];
               uom_option   += '<option value="'+value2.id+'">'+value2.uom+'</option>';
            }
            $("#uom").html(uom_option);
            $("#tax_code").html(tax_code_option);
            getitemDetails();
         }
      });
   }

   function getitemDetails()
   {
      var ref = $("#id").val();
      $.ajax({
         type: "POST",
         url: "{{route('get-item-details')}}",
         data: {'_token' : '{{ csrf_token() }}','ref' : ref},
         dataType: 'json',
         success: function (msg) 
         {
            if(msg.code==200)
            {
               if(msg.data.length>0)
               {
                  var value = msg.data[0];

                  $("#itemcode").val(value.itemcode);
                  $("#description").val(value.description);
                  $("#uom").val(value.uom);
                  $("#is_tax").val(value.is_tax);
                  $("#tax_code").val(value.tax_code);
                  $("#unit_price").val(value.unit_price);
                  $("#selling_price").val(value.selling_price);
               }
            }
         }
      });
   }
</script>
@endpush