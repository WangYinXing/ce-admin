

$(function() {
  $(document).ready(function(evt) {
     $("#register").submit(function(event) {
        if (!validate("input[name='firstname']", "text", "Please input first name correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='lastname']", "text", "Please input last name correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='email']", "email", "Please input email correctly.")) { event.preventDefault(); return;}

        if ($("input[name='password']").val().length < 5) {
        	alert("Password should be longer than 5.");
        	$("input[name='password']").addClass("input-error");
        	event.preventDefault(); return;
        }

        if ($("input[name='password']").val() != $("input[name='confirmpassword']").val()) {
        	alert("Password does not match.");
        	
        	$("input[name='password']").addClass("input-error");
        	$("input[name='confirmpassword']").addClass("input-error");

        	event.preventDefault(); return;	
        }
     });
  });
});