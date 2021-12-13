const validatePhpone = () => {
    let regex = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
    let phone = document.forms[0]["phone"].value;
     if(!regex.test(phone)) {
        alert("Некорректно заполненно поле с телефонным номером!");
        return false;
    }else {
        return true;
    }
}