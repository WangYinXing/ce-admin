
$(function() {
  $(document).ready(function(evt) {
     $("#save_form").submit(function(event) {
        if (!validate("input[name='name']", "text", "Please input ingredient name correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='coverage']", "currency", "Please input coverage correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='purchaseprice']", "currency", "Please input purchase price correctly.")) { event.preventDefault(); return;}

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