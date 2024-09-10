<div>
    <div class="table-responsive table-desi">
        <table class="user-table table table-striped all-package">
            <thead>
            <tr>
                <th>#</th>
                <th>Batch</th>
                <th>Year</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            <?php
            session_start();
            require "../MySQL.php";

            $txt = $_GET['txt'];
            if (isset($_GET["page"]) && $_GET["page"] != 0) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $batchRs = MySQL::search("SELECT * FROM batch WHERE batch_name LIKE '%${txt}%'");
            $noOfBatches = $batchRs->num_rows;

            $results_per_page = 10;
            $no_of_pages = ceil($noOfBatches / $results_per_page);
            $viewed_count = ((int)$page_no - 1) * $results_per_page;

            $batchRs2 = MySQL::search("SELECT *, batch.id as batch_id FROM batch JOIN year y on batch.year_id = y.id WHERE batch_name LIKE '%${txt}%' ORDER BY batch_id ASC LIMIT ${results_per_page} OFFSET ${viewed_count}");

            $x = 1;

            while ($batch = $batchRs2->fetch_assoc()) {
                ?>
                <tr>

                    <td><?= $batch['batch_id'] ?></td>

                    <td><?= $batch['batch_name'] ?></td>

                    <td><?= $batch['year_name'] ?></td>

                    <td>
                        <ul>
                            <li>
                                <!--data-bs-toggle="modal" data-bs-target="#update-student"-->
                                <button class="table-button text-primary"
                                        onclick='showUpdateBatchModal(<?= json_encode($batch) ?>)'>
                                    <span class="lnr lnr-pencil"></span>
                                </button>
                            </li>
                        </ul>
                    </td>

                </tr>
                <?php
                $x++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<div class="pagination-box d-flex justify-content-center mt-3">
    <nav class="ms-auto me-auto " aria-label="...">
        <ul class="pagination pagination-primary">
            <li class="page-item">
                <a class="page-link"
                   href="<?= ($page_no <= 1) ? 'javascript:void(0)' : 'javascript:searchBatches(' . ($page_no - 1) . ')' ?>">Previous</a>
            </li>
            <?php
            for ($i = 1; $i <= $no_of_pages; $i++) {
                if ($page_no == $i) {
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:searchBatches('<?= $i ?>')"><?= $i ?></a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="javascript:searchBatches('<?= $i ?>')"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?= ($page_no >= $no_of_pages) ? "javascript:void(0)" : 'javascript:searchBatches(' . ($page_no + 1) . ')' ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>