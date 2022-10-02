<?php

  function modal($title, $msj, $tbot, $dir) {
    echo "
      <a class='nodisp modal-trigger' id='btnAct' href='#modal1'></a>
      <script>
        window.addEventListener('load', function(){
          document.getElementById('btnAct').click();
        });
      </script>

      <div id='modal1' class='modal'>
        <div class='modal-content'>
          <h5>".$title."</h5>
          <p>".$msj."</p>
        </div>
        <div class='modal-footer'>
          <a href='".$dir."' class='modal-close waves-effect waves-green btn-flat blue-text'>".$tbot."</a>
        </div>
      </div>
    ";
  }

  function toast($msj) {
    echo "
     <div class='al' id='al'>
      ".$msj."
      </div>

      <script>
        setTimeout(function(){
            document.getElementById('al').remove();
          }, 5000);
      </script>

      ";
  }


?>