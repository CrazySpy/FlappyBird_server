function encrypt(data)
{
    var encrypt = new JSEncrypt();
    encrypt.setPublicKey($("#pubkey").val());
    var encrypted = encrypt.encrypt(data);
    return encodeURI(encrypted).replace(/\+/g, '%2B');
}