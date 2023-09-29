function deleteEventConfirmation(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "/holidays/del/" + id),
                Swal.fire({
                    icon: "success",
                    title: "ลบข้อมูลเรียบร้อย!",
                });
        }
    });
}
function resetConfirmationUserPassword(id) {
    Swal.fire({
        title: "คุณต้องการรีเซ็ตรหัสผ่าน ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "/admin/reset/" + id),
                Swal.fire({
                    icon: "success",
                    title: "รีเซ็ตรหัสผ่านเรียบร้อย!",
                });
        }
    });
}
function deleteUser(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "/admin/delete/" + id),
                Swal.fire({
                    icon: "success",
                    title: "ลบข้อมูลเรียบร้อย!",
                });
        }
    });
}
function deleteConfirmationApplication(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "/admin/application-del/" + id),
                Swal.fire({
                    icon: "success",
                    title: "ลบข้อมูลเรียบร้อย!",
                });
        }
    });
}
function cancelConfirmationBarcode(id) {
    Swal.fire({
        title: "คุณต้องการยกเลิก ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการยกเลิก!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "/product/barcode-cancel/" + id),
                Swal.fire({
                    icon: "success",
                    title: "ยกเลิกข้อมูลเรียบร้อย!",
                });
        }
    });
}
function delConfirmationCheckoutShipment(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            window.location.href = "/checkout/shipment/del/" + id;
        }
    });
}
function delConfirmationCheckoutShipmentItem(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            window.location.href = "/checkout/shipment-item/del/" + id;
        }
    });
}

// manage shop
function deletShop(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "/admin/shop-delete/" + id),
                Swal.fire({
                    icon: "success",
                    title: "ลบข้อมูลเรียบร้อย!",
                });
        }
    });
}

function deletlevel(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "admin/delete/level/" + id),
                Swal.fire({
                    icon: "success",
                    title: "ลบข้อมูลเรียบร้อย!",
                });
        }
    });
}

function deletrole(id) {
    Swal.fire({
        title: "คุณต้องการลบ ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ดำเนินการลบ!",
        cancelButtonText: "ยกเลิก",
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            (window.location.href = "user-role/delete/" + id),
                Swal.fire({
                    icon: "success",
                    title: "ลบข้อมูลเรียบร้อย!",
                });
        }
    });
}

function changeprice() {
    Swal.fire({
        title: "คุณต้องการแก้ไขราคา ใช่ไหม?",
        icon: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่",
        cancelButtonText: "ยกเลิก",
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            document.getElementById("soform").submit();
        }
    });
}

