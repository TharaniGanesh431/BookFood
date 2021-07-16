<script type="text/javascript">

        function check(value1){
            alert("sonethinhg");
        }

        function filter(){
            event.preventDefault();
          var filtemp=1;
          var cantemp=<?php echo json_encode($_POST['canteen2']); ?>;
          var sestemp=<?php echo json_encode($_POST['session2']); ?>;
          $.post("filter.php", {filter3: filtemp,canteen1: cantemp,session1: sestemp},function(option){
            $("#option1").html(option);//
          });
        }

        function foodselect(value1){
          // document.getElementById("option1").innerHTML = value1;
          var cantemp=<?php echo json_encode($_POST['canteen2']); ?>;
          var sestemp=<?php echo json_encode($_POST['session2']); ?>;
          $.post("filter.php", {canteen1: cantemp,session1: sestemp,foodselect2: value1},function(option){
        $("#currentsts").html(option);//
          });


        }
</script>