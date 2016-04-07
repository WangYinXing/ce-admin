
$(function() {
  $(document).ready(function(evt) {
     $("#save_form").submit(function(event) {
        if (!validate("input[name='name']", "text", "Please input system name correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='saleprice']", "currency", "Please input system price correctly.")) { event.preventDefault(); return;}

        $("input[name='status'").val($("input[name='_status']").prop("checked") ? 1 : 0);
        $("input[name='share'").val($("input[name='_share']").prop("checked") ? 1 : 0);

        var selIngs = {};

        $(".ing").each(function(ele) {
        	var id = $(this).find("input[type='checkbox']").attr("id");
          var chekced  = $(this).find("input[type='checkbox']").prop("checked");

          if (chekced) {
            var extra = parseInt($(this).find("input._extra").val());
            var factor = parseInt($(this).find("input._factor").val());

            selIngs[id] = {
              checked: $(this).find("input[type='checkbox']").prop("checked"),
              extra: isNaN(extra) ? 0 : extra,
              factor: isNaN(factor) ? 0 : factor,
            };
          }

        });

        $("input[name='selIngs']").val(JSON.stringify(selIngs));
     });
  });
});