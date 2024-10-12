const { savePassword } = require('../savePassword');

describe('Save Password', () => {
    test('should successfully save the password', () => {
        const result = savePassword('example.com', 'password123');
        expect(result).toBe(true);
    });

    test('should fail to save if website name is empty', () => {
        const result = savePassword('', 'password123');
        expect(result).toBe(false);
    });
});
