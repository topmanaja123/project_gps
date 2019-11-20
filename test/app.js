new Vue({
    el: '#chart',
    components: {
      apexchart: VueApexCharts,
    },
     data: {
      selection: 'all',
      series: [{
          name: 'อัตราสิ้นเปลือง',
data : [[55555,55555],[99999,99999]]                   
}],
      chartOptions: {
      
        dataLabels: {
          enabled: false
        },

        xaxis: {
          type: 'datetime',
          tickAmount: 6,
        },
        tooltip: {
          x: {
            format: 'dd MMM yyyy , HH:mm:ss'
          }
        },
        
      }
    },
    
  })
  
  var resetCssClasses = function (activeEl) {
    var els = document.querySelectorAll("button");
    Array.prototype.forEach.call(els, function (el) {
      el.classList.remove('active');
    });

    activeEl.target.classList.add('active')
  };
