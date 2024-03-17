$(document).ready(function () {
    $('#flamesForm').submit(function (e) {
        // Disable default event
        e.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        const resetDisplay = () => {
            // Reset FLAMES text design
            $(`.letter`).css('color', 'white');
            $(`.letter .meaning`).css('max-width', "0px");
        }

        const displayResult = (result) => {
            // Animate the results
            // NOTE: Its important that the id of the meaning that I
            //       want to display matches the dictionary the PHP returns

            // Set the other letters to black and hide their meanings
            $(`.letter`).css('color', 'rgba(0, 0, 0)');
            $(`.letter .meaning`).css('max-width', "0px");

            // Show the result of the forms
            $(`#${result} .meaning`).css('max-width', "400px");
            $(`#${result}`).css('color', "white");
        }

        $.ajax({
            url: 'flames.php',
            method: 'POST',
            dataType: 'json',
            data: formData,
            success: function (res) {
                console.log(res);

                // Reset Display if there are invalid inputs
                if (res['my_name'].length == "" || res['their_name'].length == "") {
                    resetDisplay();
                    return;
                }

                // Change FLAMES text to the result
                displayResult(res['result']);
            },
            error: function (xhr, status, error) {
                // On error, handle the error
                console.error(error);
            }
        });
    });
});
