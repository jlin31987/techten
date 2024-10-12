function savePassword(website, password) {
    if (!website || !password) {
        alert("Website and password cannot be empty!");
        return false;
    }

    // Simulate saving to a database
    console.log(`Password saved for ${website}`);
    return true;
}

module.exports = { savePassword };
