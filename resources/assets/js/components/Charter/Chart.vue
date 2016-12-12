<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
            			<div class="col-md-8">
            				<h3 class="panel-title"> {{ title }}</h3>
            			</div>
            			<div class="col-md-4">
    			      		<input type="text" name="range" class="form-control input-sm daterange" readonly>
            			</div>
            		</div>
                </div>
                <div class="panel-body">
                    <canvas id="canvas" width="width" height="height"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import Chart from 'chart.js'
    import axios from 'axios'

    export default {
        props: [
            'source', 'title', 'width', 'height'
        ],
        data () {
            return {
                legend: '',
                chart: ''
            }
        },
        mounted() {
            this.load()
            $('.daterange').daterangepicker()
        },
        methods: {
            load() {
                this.getData().then(
                    response => this.render(response.data)
                )
            },
            render(data) {
                this.chart = new Chart(
                    document.getElementById('canvas').getContext('2d'),
                {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data),
                        datasets: [
                            {
                                label: "Customers",
                                data: Object.values(data),
                                backgroundColor: this.generateRandomColors(data, "0.2"),
                                borderColor: this.generateRandomColors(data, "1"),
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                })
            },
            getData() {
                var vm = this
                return axios.get(`${this.source}`)
            },
            randomHex() {
                return Math.round(Math.random() * 255)
            },
            randomColor(alpha) {
                return "rgba(" + this.randomHex() + ", " + this.randomHex() + ", " + this.randomHex() + ", " + alpha + ")"
            },
            generateRandomColors(data, alpha) {
                var colors = []
                for (var variable in data) {
                    colors.push(this.randomColor(alpha))
                }
                return Object.values(colors)
            },
            reload() {
                this.chart.destroy();

                this.load();
            }
        },
    }
</script>

<style lang="css">
</style>
