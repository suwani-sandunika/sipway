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

            $teacher_rs = MySQL::search("SELECT * FROM teacher WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%'");
            $no_of_teachers = $teacher_rs->num_rows;

            $results_per_page = 10;
            $no_of_pages = ceil($no_of_teachers / $results_per_page);
            $viewed_count = ((int)$page_no - 1) * $results_per_page;

            $teacher_rs2 = MySQL::search("SELECT * FROM teacher WHERE email LIKE '${txt}%' OR mobile LIKE '%${txt}%' LIMIT ${results_per_page} OFFSET ${viewed_count}");

            $x = 1;

            if ($teacher_rs2->num_rows > 0) {

                while ($teacher = $teacher_rs2->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <div class="form-check form-switch p-3 d-flex justify-content-center">
                                <input id="teacher_status_switch<?= $x ?>"
                                       class="form-check-input" type="checkbox"
                                       role="switch"
                                       onchange="changeTeacherStatus('<?= $teacher["email"] ?>', 'teacher_status_switch<?= $x ?>')" <?= ($teacher["status"] == 1) ? "checked" : "" ?>>
                            </div>
                        </td>
                        <td>
                                                    <span>
                                                    <img src="../<?= ($teacher['profile_img'] != null) ? $teacher['profile_img'] : 'assets/images/profile/user.png' ?>"
                                                         alt="users">
                                                    </span>
                        </td>

                        <td>
                            <a href="javascript:void(0)">
                                <span class="d-block "><?= $teacher['first_name'] . ' ' . $teacher['last_name'] ?></span>
                                <span class="text-muted">Teacher</span>
                            </a>
                        </td>

                        <td><?= $teacher['mobile'] ?></td>

                        <td><?= $teacher['email'] ?></td>

                        <td class="font-primary"><?= ($teacher['is_verified'] == 1) ? "<span class='text-success'>Verified</span>" : '<span class="text-danger">Not Verified</span>' ?></td>

                        <td><?= $teacher['creation_time'] ?></td>

                        <td>
                            <ul>
                                <li>
                                    <!--data-bs-toggle="modal" data-bs-target="#update-teacher"-->
                                    <button class="table-button text-primary"
                                            onclick='showTeacherUpdateModal(<?= json_encode($teacher) ?>)'>
                                        <span class="lnr lnr-pencil"></span>
                                    </button>
                                </li>

                                <li>
                                    <button onclick="showTeacherDeleteConfirmModal('<?= $teacher["email"] ?>')"
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
                    <td colspan="2" class="fs-5 text-danger fw-bold">No Teacher Found</td>
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
                   href="<?= ($page_no <= 1) ? 'javascript:void(0)' : 'javascript:searchTeachers(' . ($page_no - 1) . ')' ?>">Previous</a>
            </li>
            <?php
            for ($i = 1; $i <= $no_of_pages; $i++) {
                if ($page_no == $i) {
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:searchTeachers('<?= $i ?>')"><?= $i ?></a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="javascript:searchTeachers('<?= $i ?>')"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?= ($page_no >= $no_of_pages) ? "javascript:void(0)" : 'javascript:searchTeachers(' . ($page_no + 1) . ')' ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
