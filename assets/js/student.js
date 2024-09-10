/*----------------------------------------
 Student
 ----------------------------------------*/

function studentLogin(evt) {
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

function sendForgotPasswordEmail(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById("loading-btn").classList.add('d-none');
            document.getElementById("send-btn").classList.remove('d-none');

            let txt = req.responseText;
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

function forgotStudentPassword(evt, vc) {
    let form = new FormData(document.getElementById('pass-reset-form'));
    form.append('vc', vc);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;

            if (txt === 'success') {
                document.querySelector(".toast-body").innerHTML = "Student password reset successful";
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

function updateStudentProfileImg() {
    const file = document.getElementById('profile-img').files[0];
    document.getElementById('student-profile-img-tag').src = URL.createObjectURL(file);

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

    req.open('post', 'update-student-profile-img-process.php', true);
    req.send(form);
}

function updateStudent() {
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

function resetStudentPassword(evt) {
    const req = new XMLHttpRequest();

    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                document.getElementById('student-reset-pass-form').reset();
                document.querySelector(".toast-body").innerHTML = "Student password reset successfully.";
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
    req.send(new FormData(document.getElementById('student-reset-pass-form')));

    evt.preventDefault();
}

function uploadAssignment(assId) {
    const file = document.getElementById('assignment-upload').files[0];

    const form = new FormData();
    form.append('file', file);
    form.append("assId", assId);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            const txt = req.responseText;
            if (txt == 'uploaded') {
                document.querySelector(".toast-body").innerHTML = "Assignment Uploaded Successfully!";
            } else if (txt == 're uploaded') {
                document.querySelector(".toast-body").innerHTML = "Assignment Re-Uploaded Successfully!";
            }
            new bootstrap.Toast(document.getElementById('confirm-toast')).show();

            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    }

    req.open('post', 'upload-assignment-process.php', true);
    req.send(form);
}