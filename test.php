<html>
   <body>
      <script>
         var dateFirst = new Date("11/28/2017 10:10:10");
         var dateSecond = new Date("11/28/2017 10:25:10");

         // time difference
         var timeDiff = dateSecond.getTime() - dateFirst.getTime();

         // days difference
         var diffDays = Math.ceil(timeDiff / (1000 * 60));

<<<<<<< HEAD
         // difference
         alert(diffDays);
      </script>
   </body>
</html>i 
=======
<script>

  var d = ";6007645660800026867=210919741003=?+             23            1            0061961  10400                     ?";
  var d1 = ";6007643302000058517=220619800602=?+             2400            2            55000868  50202                     ?";
  var d2 = ";6007643210300582385=210619730325=?+             23            1     WW   0013061  20401                     ?";
  var d3 = "23            1            0005460  30100                     ?";
  var d4 = "22            1            0008052  60602";
  var d5 = "			22            1            0069961  20100                     ";
  var d6 = "     3100            1            49000049  50200                     ";
  var d7 = "%  ^THAMSANIT$JATUPORN$MR.^^?+             13            1            0007161  20401                     ?";

  var resule = devL(d7);


  console.log(resule);

function devL(params) {
  var result = '';

if (params.length == 112) {
  params = params.substr(49, 41);
  result = params.replace(/\s+/g, ' ');
  return result
}else if(params.length == 115){
  params = params.substr(49, 44);
  result = params.replace(/\s+/g, ' ');
  return result
}else if(params.length == 110){
  params = params.substr(49, 39);
  result = params.replace(/\s+/g, ' ');
  return result
}else if(params.length == 63){
  params = params.substr(0, 41);
  result = params.replace(/\s+/g, ' ');
  return result
}else if(params.length == 41){
  result = params.replace(/\s+/g, ' ');
  return result
}else if(params.length == 65){
  params = params.substr(3, 41);
  result = params.replace(/\s+/g, ' ');
  return result
}else if(params.length == 70){
  params = params.substr(5, 44);
  result = params.replace(/\s+/g, ' ');
  return result
}else{
  params = params.split(' ');
  arr = params.slice(3,59);
  result = arr.toString().replace(/,+/g, ' ');
  return result
}

}
</script>
>>>>>>> develop1
