U22561154
Yi-Rou Hung 

PRACTICAL ASSIGNMENT 3:
- It is necessary to perform client-side validation to ensure that the user provides a piece of valid and complete information before submitting the form. It can reduce the likelihood to get errors and make sure the data inputted is properly formatted. Validating the password to ensure that the users choose a strong password makes it more difficult for attackers to crack it. It adds additional layers of security.
- SHA-256 is highly secure and is resistant to various attacks, including collision attacks, presage attacks, and length extension attacks. The performance is relatively fast and efficient. It is also compatible with a wide range of OS and platforms. It provides better security for password hashing. It takes an input of any length and uses it to create a 256-bit fixed-length hash value.
- I generated the API key by first calling the random_bytes() function to generate 8 random bytes. Then I used the bin2hex() to convert the binary data returned into a hexadecimal string. So the resulting string will be 16 characters long. It is then stored in the variable $api_key.
