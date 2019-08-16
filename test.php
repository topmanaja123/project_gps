<html>
   <body>
      <script>
         var dateFirst = new Date("11/28/2017 10:10:10");
         var dateSecond = new Date("11/28/2017 10:25:10");

         // time difference
         var timeDiff = dateSecond.getTime() - dateFirst.getTime();

         // days difference
         var diffDays = Math.ceil(timeDiff / (1000 * 60));

         // difference
         alert(diffDays);
      </script>
   </body>
</html>