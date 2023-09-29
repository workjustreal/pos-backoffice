 $(function() {
            $(".date").datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });
        });

        function showAmphoes() {
            let selChangwat = document.querySelector("#selChangwat");
            let url = "../../api/amphoes?changwat=" + selChangwat.value;
            // if(selChangwat.value == "") return;
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    let selAmphoe = document.querySelector("#selAmphoe");
                    selAmphoe.innerHTML = '<option value="">เลือกเขต/อำเภอ</option>';
                    for (let item of result) {
                        let option = document.createElement("option");
                        option.text = item;
                        option.value = item;
                        selAmphoe.appendChild(option);
                    }
                    showTambons();
                });
        }
        function showTambons() {
            let selChangwat = document.querySelector("#selChangwat");
            let selAmphoe = document.querySelector("#selAmphoe");
            let url = "../../api/tambons?changwat=" + selChangwat.value + "&amphoe=" + selAmphoe.value;
            // if(selChangwat.value == "") return;
            // if(selAmphoe.value == "") return;
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    let selTambon = document.querySelector("#selTambon");
                    selTambon.innerHTML = '<option value="">เลือกแขวง/ตำบล</option>';
                    for (let item of result) {
                        let option = document.createElement("option");
                        option.text = item;
                        option.value = item;
                        selTambon.appendChild(option);
                    }
                    showZipcode();
                });
        }
        function showZipcode() {
            let selChangwat = document.querySelector("#selChangwat");
            let selAmphoe = document.querySelector("#selAmphoe");
            let selTambon = document.querySelector("#selTambon");
            let url = "../../api/zipcodes?changwat=" + selChangwat.value + "&amphoe=" + selAmphoe.value + "&tambon=" + selTambon.value;
            // if(selChangwat.value == "") return;
            // if(selAmphoe.value == "") return;
            // if(selTambon.value == "") return;
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    let txtZipcode = document.querySelector("#txtZipcode");
                    txtZipcode.value = "";
                    for (let item of result) {
                        txtZipcode.value = item;
                        break;
                    }
                });
        }