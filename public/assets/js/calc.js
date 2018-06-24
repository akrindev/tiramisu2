function calc()
{

  var nc = $("#nc").val();
  var bnut = $("#bnut").val();
  var nwood = $("#nwood").val();

  var lvnow = $("#lvnow").val();
  var lvperc = $("#lvperc").val();
  var target_level = $("#lvtarget").val();

  var xp = ((Number(lvnow)**4)/40)*(1-Number(lvperc)/100)+(((Number(target_level)-1)*(2*(Number(target_level)-1)+1)*Number(target_level)*(3*(Number(target_level)-1)**2+3*(Number(target_level)-1)-1))-Number(lvnow)*(2*Number(lvnow)+1)*(Number(lvnow)+1)*(3*Number(lvnow)**2+3*Number(lvnow)-1))/1200+((2*Number(lvnow))*(1-Number(lvperc)/100))+((Number(target_level)-1)*Number(target_level)-Number(lvnow)*(Number(lvnow)+1));

  var last_nc = (((Number(lvnow)**4)/40)*(1-Number(lvperc)/100)+(((Number(target_level)-1)*(2*(Number(target_level)-1)+1)*Number(target_level)*(3*(Number(target_level)-1)**2+3*(Number(target_level)-1)-1))-Number(lvnow)*(2*Number(lvnow)+1)*(Number(lvnow)+1)*(3*Number(lvnow)**2+3*Number(lvnow)-1))/1200+((2*Number(lvnow))*(1-Number(lvperc)/100))+((Number(target_level)-1)*Number(target_level)-Number(lvnow)*(Number(lvnow)+1)))/300000;

  var last_bnut = (((Number(lvnow)**4)/40)*(1-Number(lvperc)/100)+(((Number(target_level)-1)*(2*(Number(target_level)-1)+1)*Number(target_level)*(3*(Number(target_level)-1)**2+3*(Number(target_level)-1)-1))-Number(lvnow)*(2*Number(lvnow)+1)*(Number(lvnow)+1)*(3*Number(lvnow)**2+3*Number(lvnow)-1))/1200+((2*Number(lvnow))*(1-Number(lvperc)/100))+((Number(target_level)-1)*Number(target_level)-Number(lvnow)*(Number(lvnow)+1)))/18270;

  var last_nwood = (((Number(lvnow)**4)/40)*(1-Number(lvperc)/100)+(((Number(target_level)-1)*(2*(Number(target_level)-1)+1)*Number(target_level)*(3*(Number(target_level)-1)**2+3*(Number(target_level)-1)-1))-Number(lvnow)*(2*Number(lvnow)+1)*(Number(lvnow)+1)*(3*Number(lvnow)**2+3*Number(lvnow)-1))/1200+((2*Number(lvnow))*(1-Number(lvperc)/100))+((Number(target_level)-1)*Number(target_level)-Number(lvnow)*(Number(lvnow)+1)))/10080;

  var xp_needed = cm(Math.round(xp));

  $(".last_xp").text(xp_needed).css({color:'green'});
  $(".last_nc").text(last_nc.toFixed(1)).css({color:'red'});
  $(".last_bnut").text(last_bnut.toFixed(1)).css({color:'red'});
  $(".last_nwood").text(last_nwood.toFixed(1)).css({color:'red'});

  var spina_nc = last_nc * nc;
  $(".spina_last_nc").text(cm(Math.round(spina_nc))+'s').css({color:'blue'});

  var spina_bnut = last_bnut * bnut;
  $(".spina_last_bnut").text(cm(Math.round(spina_bnut))+'s').css({color:'blue'});

  var spina_nwood = last_nwood * nwood;
  $(".spina_last_nwood").text(cm(Math.round(spina_nwood))+"s").css({color:'blue'});
}

function cm(input) {
    var output = input
    if (parseFloat(input)) {
        input = new String(input); // so you can perform string operations
        var parts = input.split("."); // remove the decimal part
        parts[0] = parts[0].split("").reverse().join("").replace(/(\d{3})(?!$)/g, "$1,").split("").reverse().join("");
        output = parts.join(".");
    }

    return output;
}