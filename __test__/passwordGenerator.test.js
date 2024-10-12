const { generatePassword } = require('../generate_password');

describe('Password Generator', () => {

    test('should generate a password of the correct length', () => {
        const password = generatePassword(12, 'true', 'true', 'true', 'true');
        expect(password.length).toBe(12);
    });

    test('should include uppercase letters when selected', () => {
        const password = generatePassword(10, 'true', 'false', 'false', 'false');
        expect(/[A-Z]/.test(password)).toBe(true);
    });

    test('should include numbers when selected', () => {
        const password = generatePassword(10, 'false', 'false', 'true', 'false');
        expect(/[0-9]/.test(password)).toBe(true);
    });
});
