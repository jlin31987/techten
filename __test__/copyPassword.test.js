const { copyToClipboard } = require('../copyPassword');

describe('Copy Password', () => {

    test('should copy the password to clipboard when password is present', () => {
        document.execCommand = jest.fn(); 
        const password = 'testPassword123';
        const result = copyToClipboard(password);
        expect(result).toBe(true);
        expect(document.execCommand).toHaveBeenCalledWith('copy');
    });

    test('should not copy if password is empty', () => {
        const result = copyToClipboard('');
        expect(result).toBe(false);
    });

    test('should return false if copy fails', () => {
        document.execCommand = jest.fn(() => { throw new Error('Copy failed'); }); 
        const result = copyToClipboard('testPassword123');
        expect(result).toBe(false);
    });
});
