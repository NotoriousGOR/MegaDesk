/*
 * File: /Users/gabrielrosales/Documents/GitHub/project-falcon/Project-Falcon/resources/js/components/ChartComponent.vue
 * Project: /Users/gabrielrosales/Documents/GitHub/project-falcon/Project-Falcon
 * Created Date: Friday, December 28th 2018, 11:48:46 am
 * Author: Gabriel Rosales
 * -----
 * Date Modified: 02/20/2019, 1:15:25
 * Modified By: Gabriel Rosales
 * -----
 * Copyright (c) 2018 Avuncular Digital
 * MIT License
 *
 * Copyright (c) 2018 Avuncular Digital
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
 * Date 	By	Comments
 * ----------	---	----------------------------------------------------------
 */

<template>
    <div id="chart-container" class="container mb-4">
        <canvas id="chart"></canvas>
  </div>
</template>

<script>
export default {
    props:['dataset', 'mylabels', 'chart'],
    mounted() {
        require('chart.js');

        var selectedColors= [];

        var chartType = this.chart.toString();

        Chart.defaults.global.defaultFontColor = "#fff";
        Chart.defaults.global.defaultFontFamily = "'Comfortaa', cursive";
        Chart.defaults.global.responsive = true;


        this.mylabels.forEach(element => {
            let color = "#"+((1<<24)*Math.random()|0).toString(16)
            selectedColors.push(color);
        });

        if (chartType == 'horizontalBar') {
            var mychart = new Chart(document.getElementById("chart"), {
                type: chartType,
                maintainAspectRatio:true,
                data: {
                labels: this.mylabels,
                datasets: [
                    {
                    backgroundColor: selectedColors,
                    data: this.dataset
                    }
                ]
                },
                options: {
                    animation: {
                        easing: "easeInOutBack"
                    },
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Average age of open tickets (In Days)'
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                steps:1,
                                stepValue: 1,

                                display: false,
                            },
                            gridLines: {
                                zeroLineColor: "transparent",
                                color: "rgba(0, 0, 0, 0)",
                            }
                        }],
                         yAxes: [{
                            gridLines: {
                                color: "rgba(0, 0, 0, 0)",
                            }
                        }]
                    }
                }
            });
        }
        else {
            var mychart = new Chart(document.getElementById("chart"), {
                type: chartType,
                maintainAspectRatio:true,
                data: {
                labels: this.mylabels,
                datasets: [
                    {
                    backgroundColor: selectedColors,
                    data: this.dataset
                    }
                ]
                },
                options: {
                    legend: {
                        display: true,
                        labels: {
                            fontColor: 'white'
                        },
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Average age of open tickets (In Days)'
                    }
                }
            });
        }
    }
}
</script>
