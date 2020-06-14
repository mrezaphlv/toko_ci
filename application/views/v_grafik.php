<?php $this->load->view('_head'); ?>
<h4>Grafik Stok Barang</h4>
<script>

          var lineChartData = {
              labels : <?php echo json_encode($nama_barang);?>,
              datasets : [

                  {
                      fillColor: "rgba(60,141,188,0.9)",
                      strokeColor: "rgba(60,141,188,0.8)",
                      pointColor: "#3b8bba",
                      pointStrokeColor: "#fff",
                      pointHighlightFill: "#fff",
                      pointHighlightStroke: "rgba(152,235,239,1)",
                      data : <?php echo json_encode($stok);?>
                  }

              ]

          }

      var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

  </script>
<?php
      foreach($data as $d){
          $nama_barang[] = $d->nama_barang;
          $stok[] = (int)$d->jumlah_barang;
      }
      var_dump($nama_barang);
      var_dump($stok);
  ?>

<canvas id="canvas" width="1000" height="280">

</canvas>


<?php $this->load->view('_foot'); ?>
