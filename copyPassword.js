function copyToClipboard(password) {
    if (!password) {
        alert("Nothing to copy! Please generate or enter a password first.");
        return false;
    }

    try {
        const tempInput = document.createElement("input");
        document.body.appendChild(tempInput);
        tempInput.value = password;
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        return true;
    } catch (err) {
        console.error("Failed to copy password: ", err);
        return false;
    }
}

module.exports = { copyToClipboard };
