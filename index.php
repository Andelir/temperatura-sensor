<?php
$connection = new mysqli('localhost', 'root', '', 'temperatura');
$numPages = 15;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$startFrom = ($page - 1) * 15;
require_once("./src/layouts/Navbar.php");
?>
<div class="container">
    <div class="table-responsive">
        <p>Prueba de temperatura</p>
        <div class="card bg-dark text-light">
            <div class="card-header">
                Datos de Temperatura
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped table-dark table-bordered table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiempo</td>
                            <td scope="col">Temperatura</td>
                            <td scope="col">Humedad</td>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM valores LIMIT $startFrom, $numPages";
                        $result = $connection->query($sql);
                        $no = $startFrom + 1;
                        while($row = $result->fetch_assoc()){
                    ?>
                    <tbody>
                        <tr>
                            <td> <?php echo $no++?></td>
                            <td> <?php echo $row['tiempo'] ?></td>
                            <td> <?php echo $row['Temperatura'] ?></td>
                            <td> <?php echo $row['Humedad'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <nav aria-label="pagination sensor" class="bg-dark">
                    <ul class="pagination ">
                        <li class="page-item ">
                            <a class="page-link bg-dark text-light" href="index.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                            $sql = "SELECT * FROM valores";
                            $res = $connection->query($sql);
                            $totalRecords = $res->num_rows;
                            $totalPages = ceil($totalRecords / $numPages);
                            for($i = 1; $i <= $totalPages; $i++){
                                echo '<li class="page-item"><a class="page-link bg-dark text-light" href="index.php?page='.$i.'">'.$i.'</a></li>';
                            }
                        ?>
                        <li class="page-item">

                            <a class="page-link bg-dark text-light" <?php echo 'href="index.php?page='.$totalPages.'"'; ?> aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php
require_once("./src/layouts/Footer.php");
?>