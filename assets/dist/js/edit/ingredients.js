
$(function() {
  $(document).ready(function(evt) {
     $("#save_form").submit(function(event) {
        if (!validate("input[name='name']", "text", "Please input system name correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='saleprice']", "currency", "Please System price correctly.")) { event.preventDefault(); return;}

        var selColors = {};
        var selPatterns = {};

        $("#colors input[type='checkbox']").each(function(ele) {
        	selColors[$(this).attr('id')] = $(this).prop("checked");
        });

        $("#patterns input[type='checkbox']").each(function(ele) {
        	selPatterns[$(this).attr('id')] = $(this).prop("checked");
        });

        $("input[name='selCols']").val(JSON.stringify(selColors));
        $("input[name='selPats']").val(JSON.stringify(selPatterns));
     });
  });
});