function generatePassword(length, uppercase, lowercase, numbers, symbols) {
    let chars = '';
    if (uppercase === 'true') chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (lowercase === 'true') chars += 'abcdefghijklmnopqrstuvwxyz';
    if (numbers === 'true') chars += '0123456789';
    if (symbols === 'true') chars += '!@#$%^&*()-_=+[]{}<>?';

    if (chars === '') {
        chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}<>?';
    }

    let password = '';
    for (let i = 0; i < length; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return password;
}

module.exports = { generatePassword };
