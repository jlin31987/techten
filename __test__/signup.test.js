const { signUp } = require('../signup');

describe('User Signup', () => {

    test('should sign up successfully with valid credentials', () => {
        const result = signUp('testuser', 'testuser@example.com', 'password123', 'password123');
        expect(result.success).toBe(true);
        expect(result.message).toBe('User registered successfully');
    });

    test('should fail if email is invalid', () => {
        const result = signUp('testuser', 'invalid-email', 'password123', 'password123');
        expect(result.success).toBe(false);
        expect(result.message).toBe('Invalid email format');
    });

    test('should fail if passwords do not match', () => {
        const result = signUp('testuser', 'testuser@example.com', 'password123', 'password321');
        expect(result.success).toBe(false);
        expect(result.message).toBe('Passwords do not match');
    });
});
