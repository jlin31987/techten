function signUp(username, email, password, confirmPassword) {
    // Validate email format (basic example)
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        return { success: false, message: 'Invalid email format' };
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        return { success: false, message: 'Passwords do not match' };
    }

    // If everything is fine, return success
    return { success: true, message: 'User registered successfully' };
}

module.exports = { signUp };
