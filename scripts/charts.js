$(function() {
  var percentage = parseFloat($("#result_percentage").text());
  var data = [
    { label: "Your Result", data: percentage, color: "#F1684E" },
    { label: "Rest of Budget", data: 100 - percentage, color: "#FBFFCA" }];
  
  var pie = { 
    show: true,
    radius: 1,
    label: {
      show: true,
      radius: 3/4,
      formatter: function(label, series) {
        return '<div style="font-size:8pt;text-align:center;padding:2px;color:#000;">' + label + '<br/>' + series.percent.toFixed(3) + '%</div>';
      },
      background: { opacity: 0.5 }
    },
    stroke: {
      color: "#E4E9EB"
    }
  };

  $.plot($("#chart"), data, {
    series: {
	  pie: pie
	},
	legend: {
        show: false
    }
  });
});