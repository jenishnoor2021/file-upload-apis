var token = $("#token").val();
var base_url = $("#base_url").val();

// add contact

$(document).ready(function (e) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    fetchAllBranches();
    $("#image").change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $("#blah").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
        $("#blah").css("display", "block");
    });
    $("#image_edit").change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $("#blah_edit").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
        $("#blah_edit").css("display", "block");
    });

    $("form[name='addbranch']").validate({
        rules: {
            school_name: {
                required: true,
            },
            branch: {
                required: true,
            },
            address: {
                required: true,
            },
            mobile: {
                required: true,
                // digits: true,
            },
            website: {
                required: true,
            },
            image: {
                required: true,
            },
        },
        submitHandler: function (form) {
            addmodlesubmit();
        },
    });
    $("form[name='editbranch']").validate({
        rules: {
            school_name: {
                required: true,
            },
            branch: {
                required: true,
            },
            address: {
                required: true,
            },
            mobile: {
                required: true,
                // digits: true,
            },
            website: {
                required: true,
            },
        },
        submitHandler: function (form) {
            editmodlesubmit();
        },
    });
});

function addmodlesubmit() {
    var formData = new FormData($("#branchForm")[0]);
    $.ajax({
        type: "POST",
        url: "/admin/add-branch",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            $("#add_branch_modal").modal("hide");
            document.getElementById("branchForm").reset();
            window.location.reload();
            // Swal.fire({
            //     icon: "success",
            //     title: "Success!",
            //     text: "Add Data successfully.",
            //     confirmButtonText: "OK",
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         fetchAllBranches();
            //     }
            // });
        },
        error: function (data) {
            console.log(data);
        },
    });
}

$(document).on("click", "#getEditButton", function (e) {
    var id = $(this).attr("data-id");
    $.ajax({
        url: base_url + "/admin/edit-branch",
        type: "GET",
        data: {
            id: id,
            _token: token,
        },
        dataType: "json",
        success: function (res) {
            if (res.flag == 1) {
                $("#branch_edit_modal").modal("show");
                $("#id").val(res.data.id);
                $("#school_name").val(res.data.school_name);
                $("#branch").val(res.data.branch);
                $("#address").val(res.data.address);
                $("#mobile").val(res.data.mobile);
                $("#website").val(res.data.website);
                $("#avatar").html(
                    `<img src="${res.data.image}" width="70" class="img-fluid img-thumbnail">`
                );
            } else {
            }
        },
    });
});

function editmodlesubmit() {
    var editformData = new FormData($("#editbranchForm")[0]);
    $.ajax({
        url: base_url + "/admin/update-branch",
        type: "POST",
        data: editformData,
        // cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            $("#branch_edit_modal").modal("hide");
            window.location.reload();
            // Swal.fire({
            //     icon: "success",
            //     title: "Updated!",
            //     text: "Branch Updated successfully.",
            //     confirmButtonText: "OK",
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         fetchAllBranches();
            //     }
            // });
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function fetchAllBranches() {
    $.ajax({
        url: "/admin/fetchall",
        method: "get",
        success: function (response) {
            $("#show_all_branches").html(response);
            $("table").DataTable({
                order: [0, "desc"],
            });
        },
    });
}
