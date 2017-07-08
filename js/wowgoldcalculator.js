var wgc = {
    data:{},
    init:function(){
        $.ajax({
            url:window.wp_data.ajax_url,
            data:{
                action:"wow_gold_get_data"
            },
            dataType:"json",
            success:function(d){
                console.debug(d);
                wgc.data=d;
                wgc.attach();
            }
        });
    },
    attach:function(){
        $("#wow_gold_calculator_servers").on("change",function(e){
            var gold_rate = $(this).find('option:selected').attr("data-rate"),currency =  $(this).find('option:selected').attr("data-currency");
                $("#wow_gold_calculator_servers_text").html( (currency=="gold")
                    ?'За '+gold_rate+'&nbsp;р. - <b>1000</b> золота'
                    :'За '+gold_rate+'&nbsp;р. - <b>1</b> Древнейший саронит'
                );
            $("[name=calc2]").change();
        });
        $("[name=calc1]").on("change keyup",function(e){
            var val = $(this).val(),
                rate=$('#wow_gold_calculator_servers option:selected').attr('data-rate'),
                currency =  $('#wow_gold_calculator_servers option:selected').attr("data-currency"),
                res=val*rate*((currency=="gold")?.001:1);
            if(isNaN(res) || res ==0)return;
            $("[name=calc2]").val(res.toFixed(2));
            $("#total").html(res+"р.");
        });
        $("[name=calc2]").on("change keyup",function(e){
            var val = $(this).val(),
                rate=$('#wow_gold_calculator_servers option:selected').attr('data-rate'),
                currency =  $('#wow_gold_calculator_servers option:selected').attr("data-currency"),
                res = val*((currency=="gold")?1000:1)/rate;
            if(isNaN(res) || res ==0)return;
            $("[name=calc1]").val(res.toFixed(2));
            $("#total").html(val+"р.");
        });
        $("[name=calc2]").change();
        $('#wow_gold_calculator_container').submit(function(){
            if($("[name=calc2]").val() <window.wp_data.min_order){
                $("[name=calc2]").focus();
                return false;
            }
            return true;
        });
        $('#min_order').text(window.wp_data.min_order);
        // $('#button-submit').on("click",function(e){
        //     var p=$('#wow_gold_calculator_container').serializeArray();
        //     e.preventDefault();
        //     console.debug(p);
        //     return false;
        // })

    }
};
$(document).ready(function(){
    wgc.init();
    console.debug("wowgoldcalculator loaded");
});
