/*
 * File: c:\Users\grosales\Documents\project-falcon\Project-Falcon\resources\js\components\LineChart.vue
 * Project: c:\Users\grosales\Documents\project-falcon\Project-Falcon
 * Created Date: Monday, February 4th 2019, 10:09:21 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/21/2019, 12:02:41
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2019 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2019 Avuncular Digital
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do
 * so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * -----
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	----------------------------------------------------------
 */


<template>
    <div id="chart-container" class="container mb-4 shadow-lg">
        <canvas id="line"></canvas>
    </div>
</template>

<script>
export default {
    props:['created', 'closed','labels'],
    mounted() {
        require('chart.js');

        var mychart = document.getElementById("line").getContext("2d");

        Chart.defaults.global.defaultFontFamily = "'Comfortaa', cursive";

        var greenGradient = mychart.createLinearGradient(0, 0, 0, 600);
        greenGradient.addColorStop(0, '#fe0944');
        greenGradient.addColorStop(1, '#feae96');

        var redGradient = mychart.createLinearGradient(0, 0, 0, 600);
        redGradient.addColorStop(0, '#80ff72');
        redGradient.addColorStop(1, '#7ee8fa');
        var formatedDate = new Array();

        this.labels.forEach(function(element) {

            let date = new Date(element);
            formatedDate.push(date);
        });

         new Chart(mychart, {
            type: 'line',
            data: {
                labels: formatedDate,
                datasets: [{
                        lineTension: 0.1,
                        pointHoverBackgroundColor: "#ff0000",
                        pointHoverRadius: 3,
                        pointRadius:2,
                        pointBackgroundColor: "#ff0000",
                        label: 'Tickets Created',
                        borderColor: greenGradient,
                        backgroundColor: greenGradient,
                        data: this.created
                    },
                    {
                        lineTension: 0.1,
                        pointHoverBackgroundColor: "#7ee8fa",
                        pointHoverRadius: 3,
                        pointRadius:2,
                        pointBackgroundColor: "#7ee8fa",
                        label: 'Tickets Closed',
                        backgroundColor: redGradient,
                        borderColor: redGradient,
                        data: this.closed
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio:true,
                animation: {
                    duration : 1800,
                    easing: "easeInOutBack"
                },
				title: {
					display: true,
					text: 'Ticket Trend'
				},
				hover: {
					mode: 'nearest',
					intersect: true
                },
                tooltips: {
                    displayColors: false
                },
				scales: {
                    xAxes: [{
                        type: 'time',
                        ticks: {
                            source: 'data',
                            autoSkip: true,
                            autoSkipPadding: 200
                        },
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        time: {
                            unit: 'month',
                            unitStepSize: 1,
                            displayFormats: {
                                'month': 'MMM DD'
                            }
                        }
                    }],
                    yAxes: [{
                        type: 'linear',
                        ticks: {

							stepSize: 2
                        },
                        gridLines: {
                            zeroLineColor: "transparent",
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }]
                }
			}
        });


    }
}


</script>
