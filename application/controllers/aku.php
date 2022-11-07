<?php

class aku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Us_model', 'Us');
        // $this->load->model('Instansi_model', 'Instansi');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'ak2u';

        $this->load->view('templates/header', $this->data);
        // $this->load->view('templates/sidebar');

        $data = $this->Us->getUs();
        $data2 = $this->Us->getTgl();
?>
        <div class="card-body">
            <h5 class="card-title">Reports <span>/Today</span></h5>

            <!-- Line Chart -->
            <div id="reportsChart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                            name: 'Sales',
                            data: [<?php foreach ($data as $key) { 
                                echo $key['HASIL'];  ?>,<?php 
                               } ?>
                            ],
                        }],
                        chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2
                        },
                        xaxis: {
                            type: 'date',
                            categories: [<?php foreach ($data2 as $key) { ?> "<?= $key['TANGGAL']; ?>",
                                <?php   } ?>
                            ]
                        },
                        // tooltip: {
                        //     x: {
                        //         format: 'dd/MM/yy HH:mm'
                        //     },
                        // }
                    }).render();
                });
            </script>
            <!-- End Line Chart -->

        </div>
<?php
        $this->load->view('templates/footer');
    }
}
?>