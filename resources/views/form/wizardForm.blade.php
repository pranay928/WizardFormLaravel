<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wizard Form</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .tab {
            display: none;
        }
    </style>
</head>

<body>

    <form id="wizard" action="{{ route('submit') }}" method="post">
        @csrf
        <!-- Step 1 -->
        <div class="tab">
            <label for="fname">First name</label>
            <input type="text" id="fname" name="fname" required>
            <label for="lname">Last name</label>
            <input type="text" id="lname" name="lname">
            <p></p>
        </div>

        <!-- Step 2 -->
        <div class="tab">
            <label for="dd">Day</label>
            <input type="text" id="dd" name="dd">
            <label for="mm">Month</label>
            <input type="text" id="mm" name="mm">
            <label for="yyyy">Year</label>
            <input type="text" id="yyyy" name="yyyy">
            <p></p>
        </div>

        <!-- Step 3 -->
        <div class="tab">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            <label for="password">Password</label>
            <input type="text" id="password" name="password">
            <p></p>
        </div>

        <!-- Buttons -->
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
    </form>

    <script>
        let currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            let page = document.getElementsByClassName('tab');
            page[n].style.display = "block";
            document.getElementById('prevBtn').style.display = (n === 0) ? "none" : "inline";
            document.getElementById('nextBtn').innerHTML = (n === page.length - 1) ? "Submit" : "Next";
        }

        function nextPrev(n) {
            if (n == 1 && !validate()) return false;

            let page = document.getElementsByClassName('tab');
            page[currentTab].style.display = "none";
            currentTab += n;

            if (currentTab >= page.length) {
                submitForm();
                return false;
            }
            showTab(currentTab);
        }

        function validate() {
            let page = document.getElementsByClassName('tab');
            let inputs = page[currentTab].getElementsByTagName('input');
            let para = page[currentTab].getElementsByTagName('p');
            let valid = true;
            let errorMsg = "";

            for (let i = 0; i < inputs.length; i++) {
                let value = inputs[i].value.trim();
                let name = inputs[i].name;

                if (value === "") {
                    valid = false;
                    errorMsg = "Please fill out all fields.";
                    break;
                }

                // Name validation (only letters)
                if ((name === "fname" || name === "lname") && !/^[A-Za-z]+$/.test(value)) {
                    valid = false;
                    errorMsg = "Name must contain only letters.";
                    break;
                }

                // Date fields (only numbers)
                if ((name === "dd" || name === "mm" || name === "yyyy") && !/^[0-9]+$/.test(value)) {
                    valid = false;
                    errorMsg = "Date fields must contain only numbers.";
                    break;
                }

                // Email validation
                if (name === "email" && !/^\S+@\S+\.\S+$/.test(value)) {
                    valid = false;
                    errorMsg = "Please enter a valid email address.";
                    break;
                }

                // Password (optional: min length)
                if (name === "password" && value.length < 6) {
                    valid = false;
                    errorMsg = "Password must be at least 6 characters.";
                    break;
                }
            }

            para[0].innerHTML = valid ? "" : errorMsg;
            return valid;
        }


        function submitForm() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('submit') }}",
                method: "POST",
                data: $("#wizard").serialize(),
                success: function(response) {
                    alert("Form submitted successfully!");
                    console.log(response);
                    currentTab = 0;
                    showTab(currentTab);
                    $('#wizard')[0].reset();
                },
                error: function(err) {
                    alert("Error submitting form");
                    console.log(err);
                    currentTab = 0;
                    showTab(currentTab);
                }
            });
        }
    </script>


</body>

</html>