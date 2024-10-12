const { savePassword } = require('../savePassword');

describe('Save Password', () => {

    test('should successfully save a password with valid input', () => {
        const result = savePassword('example.com', 'password123');
        expect(result).toBe(true);
    });

    test('should fail if the website field is empty', () => {
        const result = savePassword('', 'password123');
        expect(result).toBe(false);
    });

    test('should fail if the password field is empty', () => {
        const result = savePassword('example.com', '');
        expect(result).toBe(false);
    });
});
