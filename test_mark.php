<!DOCTYPE html>

<html lang="en">
<head>
<link href="css/select2/select2.min.css" rel="stylesheet" />
<script src="js/select2/select2.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<select class="js-example-basic-single" name="state">
  <option value="AL">Alabama</option>
    ...
  <option value="WY">Wyoming</option>
</select>
</body>
</html>
<script >
// In your Javascript (external .js resource or <script> tag)
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
    });
</script>