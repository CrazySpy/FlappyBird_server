# FlappyBird_server

Install
-----
1. Configure the Laravel.
2. Input yiban oauth2 configuration.
3. Generate the rsa private key and public key:

    ``openssl genrsa -out key/rsa_1024_priv.pem 1024``

    ``openssl rsa -pubout -in key/rsa_1024_priv.pem -out key/rsa_1024_pub.pem``