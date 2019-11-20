function createGraph(graph) {
  var jsonGraph = graph;

new Vue({
  el: '#chart',
  components: {
    apexchart: VueApexCharts,
  },
   data: {
    selection: 'all',
    series: [{
  name: 'คงเหลือ',
data : jsonGraph                   
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

}

var resetCssClasses = function (activeEl) {
  var els = document.querySelectorAll("button");
  Array.prototype.forEach.call(els, function (el) {
    el.classList.remove('active');
  });

  activeEl.target.classList.add('active')
};

