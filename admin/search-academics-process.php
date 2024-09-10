<div>
    <div class="table-responsive table-desi">
        <table class="user-table table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Registered</th>
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

            $academic_rs = MySQL::search("SELECT * FROM academic_officer WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%'");
            $no_of_admins = $academic_rs->num_rows;

            $results_per_page = 10;
            $no_of_pages = ceil($no_of_admins / $results_per_page);
            $viewed_count = ((int)$page_no - 1) * $results_per_page;

            $academic_rs2 = MySQL::search("SELECT * FROM academic_officer WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%' LIMIT ${results_per_page} OFFSET ${viewed_count}");

            $x = 1;

            if ($academic_rs2->num_rows > 0) {

                while ($academic = $academic_rs2->fetch_assoc()) {
                    ?>
                    <tr>

                        <td class="switch-td mt-2">
                            <div class="form-check form-switch">
                                <input id="academic_status_switch<?= $x ?>"
                                       class="form-check-input" type="checkbox"
                                       role="switch"
                                       onchange="changeAcademicStatus('<?= $academic["email"] ?>', 'academic_status_switch<?= $x ?>')" <?= ($academic["status"] == 1) ? "checked" : "" ?>>
                            </div>
                        </td>

                        <td>
                                                    <span>
                                                    <img src="../<?= ($academic['profile_img'] != null) ? $academic['profile_img'] : 'assets/images/profile/user.png' ?>"
                                                         alt="users">
                                                    </span>
                        </td>

                        <td>
                            <a href="javascript:void(0)">
                                <span class="d-block "><?= $academic['first_name'] . ' ' . $academic['last_name'] ?></span>
                                <span class="text-muted">Academic</span>
                            </a>
                        </td>

                        <td><?= $academic['mobile'] ?></td>

                        <td><?= $academic['email'] ?></td>

                        <td class="<?= ($academic['is_verified'] == 1) ? "order-success" : "order-cancle" ?>"><?= ($academic['is_verified'] == 1) ? "<span>Verified</span>" : '<span>Not Verified</span>' ?></td>

                        <td><?= $academic['creation_time'] ?></td>

                        <td>
                            <ul>
                                <li>
                                    <!--data-bs-toggle="modal" data-bs-target="#update-academic"-->
                                    <button class="table-button text-primary"
                                            onclick='showAcademicUpdateModal(<?= json_encode($academic) ?>)'>
                                        <span class="lnr lnr-pencil"></span>
                                    </button>
                                </li>

                                <li>
                                    <button onclick="showAcademicDeleteConfirmModal('<?= $academic["email"] ?>')"
                                            class="table-button text-danger">
                                        <span class="lnr lnr-trash"></span>
                                    </button>
                                </li>
                            </ul>
                        </td>

                    </tr>
                    <?php
                    $x++;
                }
            } else {
                ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" class="fs-5 text-danger fw-bold">No Academic Officer Found</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
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
                   href="<?= ($page_no <= 1) ? 'javascript:void(0)' : 'javascript:searchAcademics(' . ($page_no - 1) . ')' ?>">Previous</a>
            </li>
            <?php
            for ($i = 1; $i <= $no_of_pages; $i++) {
                if ($page_no == $i) {
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:searchAcademics('<?= $i ?>')"><?= $i ?></a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="javascript:searchAcademics('<?= $i ?>')"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?= ($page_no >= $no_of_pages) ? "javascript:void(0)" : 'javascript:searchAcademics(' . ($page_no + 1) . ')' ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>