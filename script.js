




function loadXMLDoc() {
    var xmlhttp = new XMLHttpRequest();
 var sel = document.getElementById("vote");
var end = sel.options[sel.selectedIndex].getAttribute("data-countryCode");
        $.ajax({
        url:"trend.php ",
        method:"POST", //First change type to method here

        data:{
          count: end, // Second add quotes on the value.
        },
        success:function(response) {
         document.getElementById("show-data").innerHTML =response;
       },
       error:function(){
        alert("error");
       }

      });
                

}

