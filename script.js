document.addEventListener("DOMContentLoaded", () => {
    const passwordInput = document.getElementById("generatedPassword");
    const lengthSlider = document.getElementById("passwordLength");
    const lengthDisplay = document.getElementById("lengthDisplay");
    const generateBtn = document.getElementById("generateBtn");
    const copyBtn = document.getElementById("copyBtn");

    lengthSlider.addEventListener("input", () => {
        lengthDisplay.textContent = `Length: ${lengthSlider.value}`;
    });

    generateBtn.addEventListener("click", () => {
        const length = lengthSlider.value;
        const uppercase = document.getElementById("includeUppercase").checked;
        const lowercase = document.getElementById("includeLowercase").checked;
        const numbers = document.getElementById("includeNumbers").checked;
        const symbols = document.getElementById("includeSymbols").checked;

        generatePassword(length, uppercase, lowercase, numbers, symbols);
    });

    function generatePassword(length, uppercase, lowercase, numbers, symbols) {
        const queryString = `length=${length}&uppercase=${uppercase}&lowercase=${lowercase}&numbers=${numbers}&symbols=${symbols}`;

        fetch(`generate_password.php?${queryString}`, {
            method: 'GET',
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            passwordInput.value = data.password;
        })
        .catch(error => {
            console.error('Error fetching password:', error);
        });
    }

    copyBtn.addEventListener("click", () => {
        if (passwordInput.value === "") {
            alert("Nothing to copy! Please generate a password first.");
            return;
        }

        if (navigator.clipboard) {
            navigator.clipboard.writeText(passwordInput.value)
                .then(() => {
                    showCopySuccess();
                })
                .catch(err => {
                    console.error("Failed to copy password: ", err);
                });
        } else {
            passwordInput.select();
            passwordInput.setSelectionRange(0, 99999); 

            try {
                document.execCommand("copy");
                showCopySuccess();
            } catch (err) {
                console.error("Fallback: Unable to copy", err);
            }
        }
    });

    function showCopySuccess() {
        copyBtn.textContent = "✔";
        copyBtn.style.backgroundColor = "#4CAF50";

        setTimeout(() => {
            copyBtn.textContent = "Copy";
            copyBtn.style.backgroundColor = "#bbd1ea";
        }, 2000);
    }
});