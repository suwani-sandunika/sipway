/*----------------------------------------
 Admin
 ----------------------------------------*/

function adminLogin(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const result = JSON.parse(req.responseText);

            if (result['status'] === 'success') {
                setInterval(() => {
                    window.location = 'index.php';
                }, 500)
            } else {
                document.getElementById("name-err").innerHTML = result['name-err'];
                document.getElementById("pass-err").innerHTML = result['pass-err'];
            }
        }
    }
    req.open('post', 'login-process.php', true);
    req.send(new FormData(document.getElementById("login-form")));

    evt.preventDefault();
}

let adminUpdateModal;

function showAdminUpdateModal(admin) {
    document.getElementById("fname").value = admin['first_name'];
    document.getElementById("lname").value = admin['last_name'];
    document.getElementById("mobile").value = admin['mobile'];
    document.getElementById("aemail").value = admin['email'];
    adminUpdateModal = new bootstrap.Modal(document.getElementById("update-admin"));
    adminUpdateModal.show();
}

function updateAdmin() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    const mobile = document.getElementById("mobile");
    const email = document.getElementById("aemail");

    const form = new FormData();
    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                adminUpdateModal.hide();
                document.querySelector(".toast-body").innerHTML = "User profile updated successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-admin-process.php', true);
    req.send(form);
}

function changeAdminStatus(email, switchId) {
    const adminStatusCheckbox = document.getElementById(switchId);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === "success") {
                setTimeout(() => {
                    document.querySelector(".toast-body").innerHTML = email + "'s status updated";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                }, 100);
            } else {
                alert(txt)
            }
        }
    }

    req.open('get', 'change-admin-status-process.php?status=' + adminStatusCheckbox.checked + '&email=' + email, true);
    req.send();
}

function showAdminDeleteConfirmModal(email) {
    let modal = new bootstrap.Modal(document.getElementById("delete-confirm-modal"));
    modal.show();

    document.getElementById('modal-confirm-btn').addEventListener('click', () => {
        modal.hide();
        const req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "success") {
                    document.querySelector(".toast-body").innerHTML = email + "'s admin account deleted successfully";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);

                }
            }
        }
        req.open('get', 'delete-admin-account-process.php?email=' + email, true);
        req.send();
    })
}

function searchAdmins(page) {
    const txt = document.getElementById("admin-search");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('card-body').innerHTML = req.responseText;
        }
    }

    req.open('get', 'search-admins-process.php?txt=' + txt.value + '&page=' + page, true);
    req.send();
}

function registerAdmin(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('register-btn').classList.remove('d-none');
            document.getElementById('loading-btn').classList.add('d-none');

            let txt = req.responseText;

            if (txt == "success") {
                document.getElementById("register_form_err").innerHTML = "";
                document.getElementById('admin-register-form').reset();

                document.querySelector(".toast-body").innerHTML = "Accounted created successfully & email sent.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            } else {
                document.getElementById("register_form_err").innerHTML = txt;
            }
        } else {
            document.getElementById('register-btn').classList.add('d-none');
            document.getElementById('loading-btn').classList.remove('d-none');
        }
    }

    req.open('post', 'register-admin-process.php', true);
    req.send(new FormData(document.getElementById('admin-register-form')));

    evt.preventDefault();
}

function updateAdminProfileImg() {
    const file = document.getElementById('profile-img').files[0];
    document.getElementById('admin-profile-img-tag').src = URL.createObjectURL(file);

    const form = new FormData();
    form.append('file', file);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt == 'success') {
                document.querySelector(".toast-body").innerHTML = "Profile image updated successfully.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            }
        }
    }

    req.open('post', 'update-admin-profile-img-process.php', true);
    req.send(form);
}

function resetAdminPassword(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                document.getElementById('admin-reset-pass-form').reset();
                document.querySelector(".toast-body").innerHTML = "Admin password reset successfully.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById('err-msg2').innerHTML = txt;
            }
        }
    }

    req.open('post', 'reset-password-process.php', true)
    req.send(new FormData(document.getElementById('admin-reset-pass-form')));

    evt.preventDefault();
}

function sendForgotPasswordEmail(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById("loading-btn").classList.add('d-none');
            document.getElementById("send-btn").classList.remove('d-none');

            let txt = req.responseText;
            console.log(txt)
            if (txt == "success") {
                document.getElementById("err-msg-fp").innerHTML = "";
                document.querySelector("#send-btn button").innerHTML = "Email Sent";
                document.querySelector("#send-btn button").disabled = true;
            } else {
                document.getElementById("err-msg-fp").innerHTML = txt;
            }
        } else {
            document.getElementById("loading-btn").classList.remove('d-none');
            document.getElementById("send-btn").classList.add('d-none');
        }
    }

    req.open('post', 'send-forgot-pass-process.php', true);
    req.send(new FormData(document.getElementById('fp-form')));

    evt.preventDefault();
}

function forgotAdminPassword(evt, vc) {
    let form = new FormData(document.getElementById('pass-reset-form'));
    form.append('vc', vc);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;

            if (txt === 'success') {
                document.querySelector(".toast-body").innerHTML = "Admin password reset successful";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location = 'login.php';
                }, 1000)
            } else {
                document.getElementById('pass-err').innerHTML = txt;
            }
        }
    }
    req.open('post', 'reset-password-fp-process.php', true);
    req.send(form);

    evt.preventDefault();
}

function searchTeachers(page) {
    const txt = document.getElementById("teacher-search");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('card-body').innerHTML = req.responseText;
        }
    }

    req.open('get', 'search-teachers-process.php?txt=' + txt.value + '&page=' + page, true);
    req.send();
}

function changeTeacherStatus(email, switchId) {
    const teacherStatusCheckbox = document.getElementById(switchId);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === "success") {
                setTimeout(() => {
                    document.querySelector(".toast-body").innerHTML = email + "'s status updated";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                }, 100);
            } else {
                alert(txt)
            }
        }
    }

    req.open('get', 'change-teacher-status-process.php?status=' + teacherStatusCheckbox.checked + '&email=' + email, true);
    req.send();
}

let updateTeacherModal;

function showTeacherUpdateModal(teacher) {
    document.getElementById("fname").value = teacher['first_name'];
    document.getElementById("lname").value = teacher['last_name'];
    document.getElementById("mobile").value = teacher['mobile'];
    document.getElementById("aemail").value = teacher['email'];
    updateTeacherModal = new bootstrap.Modal(document.getElementById("update-teacher"));
    updateTeacherModal.show();

}

function showTeacherDeleteConfirmModal(email) {
    let modal = new bootstrap.Modal(document.getElementById("delete-confirm-modal"));
    modal.show();

    document.getElementById('modal-confirm-btn').addEventListener('click', () => {
        modal.hide();
        const req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "success") {
                    document.querySelector(".toast-body").innerHTML = email + "'s teacher account deleted successfully";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);

                } else {
                    alert("error");
                }
            }
        }
        req.open('get', 'delete-teacher-account-process.php?email=' + email, true);
        req.send();
    })
}

function updateTeacher() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    const mobile = document.getElementById("mobile");
    const email = document.getElementById("aemail");

    const form = new FormData();
    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                updateTeacherModal.hide();
                document.querySelector(".toast-body").innerHTML = "User profile updated successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-teacher-process.php', true);
    req.send(form);
}

let teacherEmail;
let manageSubjectsModal;

function showTeachersSubjectModal(email) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('subjects-modal-table').innerHTML = req.responseText;
            teacherEmail = email;
            manageSubjectsModal = new bootstrap.Modal(document.getElementById('manage-subjects'));
            manageSubjectsModal.show();
        }
    }
    req.open('get', 'load-teachers-subjects-process.php?email=' + email, true);
    req.send();
}

let assignNewSubjectModal;

function showAssignNewSubjectModal() {
    document.getElementById('ans-email').value = teacherEmail;
    manageSubjectsModal.hide();
    document.getElementById('ans-err-msg').innerHTML = "";
    document.getElementById("ans-subject").value = 0;
    assignNewSubjectModal = new bootstrap.Modal(document.getElementById('assign-new-subject-modal'));
    assignNewSubjectModal.show();
}

function assignNewSubject(evt) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            if (req.responseText == 'success') {
                assignNewSubjectModal.hide();
                showTeachersSubjectModal(teacherEmail);
            } else {
                document.getElementById('ans-err-msg').innerHTML = req.responseText;
            }
        }
    }
    req.open('post', 'assign-new-subject-process.php', true);
    req.send(new FormData(document.getElementById("assign-new-subject-form")));

    evt.preventDefault();
}

function unassignTeachersSubject(subjectId, teacherEmail) {
    const form = new FormData();
    form.append('sid', subjectId);
    form.append('email', teacherEmail);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {

            if (req.responseText == 'success') {
                const req1 = new XMLHttpRequest();
                req1.onreadystatechange = () => {
                    if (req1.readyState === 4 && req1.status === 200) {
                        document.getElementById('subjects-modal-table').innerHTML = req1.responseText;
                    }
                }
                req1.open('get', 'load-teachers-subjects-process.php?email=' + teacherEmail, true);
                req1.send();
            }

        }
    }
    req.open('post', 'unassign-teachers-subject.php', true);
    req.send(form);

}

function registerTeacher(subList) {
    const email = document.getElementById('email');
    const cemail = document.getElementById('cemail');
    const fName = document.getElementById('fname');
    const lName = document.getElementById('lname');
    const mobile = document.getElementById('mobile');

    let selectedSubs = [];
    subList.forEach((subId) => {
        if (document.getElementById(subId).checked == 1) {
            selectedSubs.push(document.getElementById(subId).value);
        }
    })

    const form = new FormData();
    form.append("email", email.value);
    form.append("cemail", cemail.value);
    form.append("fname", fName.value);
    form.append("lname", lName.value);
    form.append("mobile", mobile.value);
    form.append("subList", JSON.stringify(selectedSubs));

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('register-btn').classList.remove('d-none');
            document.getElementById('loading-btn').classList.add('d-none');

            if (req.responseText === 'success') {
                document.getElementById("register_form_err").innerHTML = "";
                document.getElementById('teacher-register-form').reset();

                document.querySelector(".toast-body").innerHTML = "Accounted created successfully & email sent.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            } else {
                document.getElementById("register_form_err").innerHTML = txt;
            }

        } else {
            document.getElementById('register-btn').classList.add('d-none');
            document.getElementById('loading-btn').classList.remove('d-none');
        }
    }

    req.open('post', 'register-teacher-process.php', true);
    req.send(form);
}

function changeAcademicStatus(email, switchId) {
    const academicStatusCheckbox = document.getElementById(switchId);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === "success") {
                setTimeout(() => {
                    document.querySelector(".toast-body").innerHTML = email + "'s status updated";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                }, 100);
            } else {
                alert(txt)
            }
        }
    }

    req.open('get', 'change-academic-status-process.php?status=' + academicStatusCheckbox.checked + '&email=' + email, true);
    req.send();
}

let academicUpdateModal;

function showAcademicUpdateModal(academic) {
    document.getElementById("fname").value = academic['first_name'];
    document.getElementById("lname").value = academic['last_name'];
    document.getElementById("mobile").value = academic['mobile'];
    document.getElementById("aemail").value = academic['email'];
    academicUpdateModal = new bootstrap.Modal(document.getElementById("update-academic"));
    academicUpdateModal.show();
}

function updateAcademic() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    const mobile = document.getElementById("mobile");
    const email = document.getElementById("aemail");

    const form = new FormData();
    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                academicUpdateModal.hide();
                document.querySelector(".toast-body").innerHTML = "User profile updated successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-academic-process.php', true);
    req.send(form);
}

function showAcademicDeleteConfirmModal(email) {
    let modal = new bootstrap.Modal(document.getElementById("delete-confirm-modal"));
    modal.show();

    document.getElementById('modal-confirm-btn').addEventListener('click', () => {
        modal.hide();
        const req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "success") {
                    document.querySelector(".toast-body").innerHTML = email + "'s academic account deleted successfully";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);

                }
            }
        }
        req.open('get', 'delete-academic-account-process.php?email=' + email, true);
        req.send();
    })
}


function searchAcademics(page) {
    const txt = document.getElementById("academic-search");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('card-body').innerHTML = req.responseText;
        }
    }

    req.open('get', 'search-academics-process.php?txt=' + txt.value + '&page=' + page, true);
    req.send();
}

function registerAcademic(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('register-btn').classList.remove('d-none');
            document.getElementById('loading-btn').classList.add('d-none');

            let txt = req.responseText;

            if (txt == "success") {
                document.getElementById("register_form_err").innerHTML = "";
                document.getElementById('academic-register-form').reset();

                document.querySelector(".toast-body").innerHTML = "Accounted created successfully & email sent.";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            } else {
                document.getElementById("register_form_err").innerHTML = txt;
            }
        } else {
            document.getElementById('register-btn').classList.add('d-none');
            document.getElementById('loading-btn').classList.remove('d-none');
        }
    }

    req.open('post', 'register-academic-process.php', true);
    req.send(new FormData(document.getElementById('academic-register-form')));

    evt.preventDefault();
}

function changeStudentStatus(email, switchId) {
    const studentStatusCheckbox = document.getElementById(switchId);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt === "success") {
                setTimeout(() => {
                    document.querySelector(".toast-body").innerHTML = email + "'s status updated";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                }, 100);
            } else {
                alert(txt)
            }
        }
    }

    req.open('get', 'change-student-status-process.php?status=' + studentStatusCheckbox.checked + '&email=' + email, true);
    req.send();
}

let studentUpdateModal;

function showStudentUpdateModal(student) {
    document.getElementById("fname").value = student['first_name'];
    document.getElementById("lname").value = student['last_name'];
    document.getElementById("mobile").value = student['mobile'];
    document.getElementById("aemail").value = student['email'];
    document.getElementById("batch").value = student['batch_id'];

    if (student['payment_status'] == 0) {
        document.getElementById("payment-status-not-paid").checked = true;
    } else if (student['payment_status'] == 1) {
        document.getElementById("payment-status-paid").checked = true;
    }

    studentUpdateModal = new bootstrap.Modal(document.getElementById("update-student"));
    studentUpdateModal.show();
}

function updateStudent() {
    const fname = document.getElementById("fname");
    const lname = document.getElementById("lname");
    const mobile = document.getElementById("mobile");
    const email = document.getElementById("aemail");
    const batch = document.getElementById("batch");

    let payment_status;
    if (document.getElementById("payment-status-paid").checked) {
        payment_status = 1;
    } else if (document.getElementById("payment-status-not-paid").checked) {
        payment_status = 0;
    }

    const form = new FormData();
    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);
    form.append('email', email.value);
    form.append('batch', batch.value);
    form.append('payment_status', payment_status);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                studentUpdateModal.hide();
                document.querySelector(".toast-body").innerHTML = "Student profile updated successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-student-process.php', true);
    req.send(form);
}

function showStudentDeleteConfirmModal(email) {
    let modal = new bootstrap.Modal(document.getElementById("delete-confirm-modal"));
    modal.show();

    document.getElementById('modal-confirm-btn').addEventListener('click', () => {
        modal.hide();
        const req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "success") {
                    document.querySelector(".toast-body").innerHTML = email + "'s student account deleted successfully";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);

                }
            }
        }
        req.open('get', 'delete-student-account-process.php?email=' + email, true);
        req.send();
    })
}

function searchStudents(page) {
    const txt = document.getElementById("student-search");

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('card-body').innerHTML = req.responseText;
        }
    }

    req.open('get', 'search-students-process.php?txt=' + txt.value + '&page=' + page, true);
    req.send();
}


let updateSubjectModal;

function showSubjectUpdateModal(subject) {

    document.getElementById("sub-id").value = subject['id'];
    document.getElementById("sub-name").value = subject['subject_name'];
    document.getElementById("year").value = subject['year_id'];

    updateSubjectModal = new bootstrap.Modal(document.getElementById("update-subject"));
    updateSubjectModal.show();

}

function updateSubject() {

    const subId = document.getElementById("sub-id");
    const subName = document.getElementById("sub-name");
    const yearId = document.getElementById("year")

    const form = new FormData();
    form.append('sub-id', subId.value);
    form.append('sub-name', subName.value);
    form.append('year-id', yearId.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                updateSubjectModal.hide();
                document.querySelector(".toast-body").innerHTML = "Subject updated successfully!";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                document.getElementById("err-msg").innerHTML = txt;
            }
        }
    }
    req.open('post', 'update-subject-process.php', true);
    req.send(form);
}

function showSubjectDeleteConfirmModal(id) {
    let modal = new bootstrap.Modal(document.getElementById("delete-confirm-modal"));
    modal.show();

    document.getElementById('modal-confirm-btn').addEventListener('click', () => {
        modal.hide();
        const req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "success") {
                    document.querySelector(".toast-body").innerHTML = "Subject deleted successfully";
                    new bootstrap.Toast(document.getElementById('confirm-toast')).show();

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);

                }
            }
        }
        req.open('get', 'delete-subject-process.php?subId=' + id, true);
        req.send();
    })
}

function registerSubject(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById('register-btn').classList.remove('d-none');
            document.getElementById('loading-btn').classList.add('d-none');

            let txt = req.responseText;

            if (txt == "success") {
                document.getElementById("register_form_err").innerHTML = "";
                document.getElementById('subject-register-form').reset();

                document.querySelector(".toast-body").innerHTML = "New subject created successfully";
                new bootstrap.Toast(document.getElementById('confirm-toast')).show();
            } else {
                document.getElementById("register_form_err").innerHTML = txt;
            }
        } else {
            document.getElementById('register-btn').classList.add('d-none');
            document.getElementById('loading-btn').classList.remove('d-none');
        }
    }

    req.open('post', 'register-subject-process.php', true);
    req.send(new FormData(document.getElementById('subject-register-form')));

    evt.preventDefault();
}