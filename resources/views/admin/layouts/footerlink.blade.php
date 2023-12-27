<script src="{{url('public/admin/js/main/jquery-3.1.1.min.js')}}"></script>
<script src="{{url('public/admin/js/main/popper.min.js')}}"></script>
<script src="{{url('public/admin/js/main/bootstrap.js')}}"></script>
<!-- <script src="{{url('public/admin/js/main/inspinia.js')}}"></script> -->
<script src="{{url('public/admin/js/pace/pace.min.js')}}"></script>
<script src="{{url('public/admin/js/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{url('public/admin/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{url('public/admin/js/cropImage/croppie.js')}}"></script>
<script src="{{url('public/admin/js/datatables/datatables.min.js')}}"></script>
<script src="{{url('public/admin/js/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{url('public/admin/js/cropImage/profile-croppie.js')}}"></script>
<script src="{{url('public/admin_dir/js/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{url('public/admin_dir/js/switchery/switchery.js')}}"></script>
<!-- Form- Validation  -->
<script src="{{ url('public/admin/js/form-validation/jquery.validate.js') }}"></script>
<script src="{{ url('public/admin/js/form-validation/additional-methods.min.js') }}"></script>
<!-- <script src="{{ url('public/admin/js/form-validation/custom-form-validation.js') }}"></script> -->

 <script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
jQuery.validator.addMethod("noSpace", function(value, element) { 
    return value == '' || value.trim().length != 0;
}, "{{__('messages.no_space')}}");
jQuery.validator.addMethod("noSpacePassword", function(value, element) { 
    return value == '' || value.trim().length != 0;
}, "{{__('messages.no_space_password')}}");
jQuery.validator.addMethod("ValidPassword", function(value, element) {
    return this.optional(element) || /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@=*$#%]).*$/i.test(value);
}, "{{__('messages.valid_password')}}");
</script>
<script type="text/javascript">

$(document).ready(function(e){

$(".loader").fadeOut("slow");

var _flag=false;

$(".dropdown-a").click(function(e){
	
  $(this).parents("ul").find(".cust-dropdown-container").slideUp();

  $(this).parents("ul").find(".title").next("i").addClass("fa-angle-right");
  $(this).parents("ul").find(".title").next("i").removeClass("fa-angle-down");

  if($(this).parent("li").next(".cust-dropdown-container").css('display') !='none'){
	  $(this).parent("li").next(".cust-dropdown-container").slideUp();
	  $(this).find(".title").next("i").addClass("fa-angle-right");
	  $(this).find(".title").next("i").removeClass("fa-angle-down");
  }else{
	$(this).parent("li").next(".cust-dropdown-container").slideDown();
	$(this).find(".title").next("i").removeClass("fa-angle-right");
	$(this).find(".title").next("i").addClass("fa-angle-down");
  }
});

$('.select2').on('select2:open', function() {
	$('.select2-search input').prop('focus', 0);
});

});


if($(".dropdown-li").hasClass("active")){

	var _test='<?php echo Request::segment(2); ?>';
	// alert(_test);
	console.log(_test);
	if(_test == 'datapending'){
	 	$(".gym").next(".cust-dropdown-container").show();
	 }
	if(_test == 'agentreport'){
		$(".gymreport").next(".cust-dropdown-container").show();
	}
	// if(_test == 'agentreport'){
	// 	$(".gymreport").next(".cust-dropdown-container").show();
	// }

	$("."+_test).next(".cust-dropdown-container").show();
	$("."+_test).find(".title").next("i").removeClass("fa-angle-right");
	$("."+_test).find(".title").next("i").addClass("fa-angle-down");

}
</script>