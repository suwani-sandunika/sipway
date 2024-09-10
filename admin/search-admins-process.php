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

            $admin_rs = MySQL::search("SELECT * FROM admin WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%'");
            $no_of_admins = $admin_rs->num_rows;

            $results_per_page = 10;
            $no_of_pages = ceil($no_of_admins / $results_per_page);
            $viewed_count = ((int)$page_no - 1) * $results_per_page;

            $admin_rs2 = MySQL::search("SELECT * FROM admin WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%' LIMIT ${results_per_page} OFFSET ${viewed_count}");

            $x = 1;

            if ($admin_rs2->num_rows > 0) {

                while ($admin = $admin_rs2->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <div class="form-check form-switch p-3 d-flex justify-content-center">
                                <input id="admin_status_switch<?= $x ?>"
                                       class="form-check-input" type="checkbox"
                                       role="switch"
                                       onchange="changeAdminStatus('<?= $admin["email"] ?>', 'admin_status_switch<?= $x ?>')" <?= ($admin["status"] == 1) ? "checked" : "" ?>>
                            </div>
                        </td>
                        <td>
                                                    <span>
                                                    <img src="../<?= ($admin['profile_img'] != null) ? $admin['profile_img'] : 'assets/images/profile/user.png' ?>"
                                                         alt="users">
                                                    </span>
                        </td>

                        <td>
                            <a href="javascript:void(0)">
                                <span class="d-block "><?= $admin['first_name'] . ' ' . $admin['last_name'] ?></span>
                                <span class="text-muted">Admin</span>
                            </a>
                        </td>

                        <td><?= $admin['mobile'] ?></td>

                        <td><?= $admin['email'] ?></td>

                        <td class="font-primary"><?= ($admin['is_verified'] == 1) ? "<span class='text-success'>Verified</span>" : '<span class="text-danger">Not Verified</span>' ?></td>

                        <td><?= $admin['creation_time'] ?></td>

                        <td>
                            <ul>
                                <li>
                                    <!--data-bs-toggle="modal" data-bs-target="#update-admin"-->
                                    <button class="table-button text-primary"
                                            onclick='showAdminUpdateModal(<?= json_encode($admin) ?>)'>
                                        <span class="lnr lnr-pencil"></span>
                                    </button>
                                </li>

                                <li>
                                    <button onclick="showAdminDeleteConfirmModal('<?= $admin["email"] ?>')"
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
                    <td colspan="2" class="fs-5 text-danger fw-bold">No Admin Found</td>
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
                   href="<?= ($page_no <= 1) ? 'javascript:void(0)' : 'javascript:searchAdmins(' . ($page_no - 1) . ')' ?>">Previous</a>
            </li>
            <?php
            for ($i = 1; $i <= $no_of_pages; $i++) {
                if ($page_no == $i) {
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:searchAdmins('<?= $i ?>')"><?= $i ?></a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="javascript:searchAdmins('<?= $i ?>')"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?= ($page_no >= $no_of_pages) ? "javascript:void(0)" : 'javascript:searchAdmins(' . ($page_no + 1) . ')' ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>