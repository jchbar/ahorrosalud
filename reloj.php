<?php
?>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery3.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap-session-timeout.js"></script>
</head>
<body>
<script type="text/javascript">
$.sessionTimeout({
  keepAliveUrl: 'keep-alive.html',
        logoutUrl: 'index.php',
        redirUrl: 'locked.php',
  warnAfter: 3000,
  redirAfter: 10000,
  countdownBar: true,
        countdownBar: true,
        countdownMessage: 'Redireccionando en {timer} segundos...'
});
</script>
mensaje
</body>