function IBANValidation(iban) {
    var letter1;
    var letter2;
    var num1;
    var num2;
    var temp;

    iban = iban.replaceAll(' ', '');

    if (iban.length != 24) {
        return false;
    }

    // 2 letter becomes its numerical equivalent
    letter1 = iban.substring(0, 1);
    letter2 = iban.substring(1, 2);
    num1 = convertLetterNumIBAN(letter1);
    num2 = convertLetterNumIBAN(letter2);

    // Mutation of the chain with the account number
    temp = String(iban.substring(4, 24)) + "" + String(num1) + "" + String(num2) + "" + String(iban.substring(2, 4));

    //Calculation of residue
    residu = mod97(temp);
    if (residu == 1) {
        return true;
    }
    else {
        return false;
    }
}
function mod97(digit_string) {
    var m = 0;
    for (var i = 0; i < digit_string.length; ++i)
        m = (m * 10 + parseInt(digit_string.charAt(i))) % 97;
    return m;
}
function convertLetterNumIBAN(letter) {
    letter = letter.toUpperCase();
    letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return letters.search(letter) + 10;
}