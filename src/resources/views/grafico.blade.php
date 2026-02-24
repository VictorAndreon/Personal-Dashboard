<x-app-layout>
    <div class="flex justify-center text-center">
        <div id="chart" class="w-96 h-72 bg-white rounded-lg shadow"></div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var options = {
chart: {
    type: 'line',
    height: '100%',
    toolbar: { show: false }
},
stroke: {
    curve: 'stepline',
    width: 3
},
colors: ['#3b82f6'],
grid: {
    borderColor: '#e5e7eb'
},
        series: [{
            name: 'sales',
            data: [30,40,35,50,49,60,70,91,125]
        }],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997,1998,1999]
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

});
</script>
