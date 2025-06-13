/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }

    const tableList = document.querySelector("#datatables");
    const deleteForm = document.querySelector(".delete-form");
    tableList.addEventListener("click", (e) => {
        // console.log(e);
        if (e.target.classList.contains("delete-action")) {
            e.preventDefault();
            Swal.fire({
                title: "Bạn có chắc chắn muốn xoá?",
                text: "Nếu xoá không thể khôi phục lại được!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ok, xoá nó đi!",
            }).then((result) => {
                if (result.isConfirmed) {
                    const action = e.target.href;
                    deleteForm.action = action;
                    deleteForm.submit();
                }
            });
        }
    });
});

// let table = new DataTable("#datatable");

$(document).ready(function () {
    $("#datatables").DataTable({});
});
