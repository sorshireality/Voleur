$(function() {
    $('#new_button_token').click(function () {
        localStorage.clear();
        window.close();
    });


    function createTable()
    {

        var table = document.getElementsByTagName('table')[0];


        for(let index in Array) {
            var newRow = table.insertRow(table.rows.length);
            var cel1 = newRow.insertCell(0);
            var cel2 = newRow.insertCell(1);
            var cel3 = newRow.insertCell(2);
            var cel4 = newRow.insertCell(3);
            var cel5 = newRow.insertCell(4);
            for (let elem in Array[index]) {

                if (elem == "username"){
                    cel1.innerHTML = Array[index][elem];
                }
                if (elem == "amount"){
                    cel2.innerHTML = Array[index][elem];
                }
                if (elem == "currency"){
                    cel3.innerHTML = Array[index][elem];
                }
                if (elem == "message"){
                    cel4.innerHTML = Array[index][elem];
                }
                if (elem == "time"){
                    cel5.innerHTML = Array[index][elem];
                }
            }
        }
    }

    // let timerId = setInterval(() => createTable(), 2000);

});

