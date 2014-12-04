<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Car Wash</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
</head>
<body>
 <form action="next.php" method="post">
<p>Date: <input type="text" name="pick" id="datepicker"></p>
 <input type="submit" value="Done">
 </form>
 
</body>
</html>