<script type="text/javascript"> //skript kohe htmli sees
        $(document).ready(function() {

          function startTime() {
              var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              document.getElementById('txt').innerHTML =
                  h + ":" + m + ":" + s;
              var t = setTimeout(startTime, 500);
          }
          function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
          }
          
          var minutesLabel = document.getElementById("minutes");
          var secondsLabel = document.getElementById("seconds");
          var totalSeconds = 0;
          setInterval(setTime, 1000);

          function setTime()
          {
              ++totalSeconds;
              secondsLabel.innerHTML = pad(totalSeconds%60);
              minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
          }

          function pad(val)
          {
              var valString = val + "";
              if(valString.length < 2)
              {
                  return "0" + valString;
              }
              else
              {
                  return valString;
              }
          }
        }
    </script>